<?php

namespace App\Services;

use App\Enums\EnumUserRole;
use App\Enums\PostStatus;
use App\Models\Post;
use App\Models\PostView;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PostViewAnalyticsServices
{
    protected $topLimit = 5;
    
    /**
     * Get total views for a given period.
     *
     * @param string $startDate
     * @param string $endDate
     * @return int
     */
    public function getTotalViewsForPeriod(string $startDate, string $endDate): int
    {
        return PostView::whereBetween('view_date', [$startDate, $endDate])
                       ->sum('view_count');
    }

    /**
     * Get total views for today.
     *
     * @return int
     */
    public function getViewsForToday(): int
    {
        $today = now()->startOfDay()->toDateString();
        return $this->getTotalViewsForPeriod($today, $today);
    }

    /**
     * Get total views for the current week.
     *
     * @return int
     */
    public function getViewsForWeek(): int
    {
        $startOfWeek = now()->startOfWeek()->toDateString();
        $endOfWeek = now()->endOfWeek()->toDateString();
        return $this->getTotalViewsForPeriod($startOfWeek, $endOfWeek);
    }

    /**
     * Get total views for the current month.
     *
     * @return int
     */
    public function getViewsForMonth(): int
    {
        $startOfMonth = now()->startOfMonth()->toDateString();
        $endOfMonth = now()->endOfMonth()->toDateString();
        return $this->getTotalViewsForPeriod($startOfMonth, $endOfMonth);
    }

    /**
     * Get total views for the current year.
     *
     * @return int
     */
    public function getViewsForYear(): int
    {
        $startOfYear = now()->startOfYear()->toDateString();
        $endOfYear = now()->endOfYear()->toDateString();
        return $this->getTotalViewsForPeriod($startOfYear, $endOfYear);
    }

    /**
     * Get historical views data for the last 7 days.
     *
     * @return \Illuminate\Support\Collection
     */
    public function getViewsHistoriesForWeek($params = [])
    {
        $endDate = isset($params['end_date']) ? Carbon::parse($params['end_date'])->toDateString() : Carbon::today()->toDateString();

        if (isset($params['start_date'])) {
            $startDate = Carbon::parse($params['start_date'])->toDateString();
        } else {
            $subDays = isset($params['subdays']) ? $params['subdays'] : 6;
            $startDate = Carbon::parse($endDate)->subDays($subDays)->toDateString();
        }

        $dates = [];
        for ($d = $startDate; $d <= $endDate; $d = date('Y-m-d', strtotime($d . ' +1 day'))) {
            $dates[] = $d;
        }


        $user = Auth::user();
        $postUserId = $params['post_user_id'] ?? null;

        $query = PostView::select(DB::raw('view_date, post_id, SUM(view_count) as total_views'))
                    ->with('post')
                    ->join('posts as p', 'post_views.post_id', '=', 'p.id')
                    ->whereBetween('view_date', [$startDate, $endDate])
                    ->groupBy('view_date', 'post_id')
                    ->orderBy('view_date', 'asc');

        if ($user->roles->first()->name == EnumUserRole::MASTER->value) {
            if ($postUserId && $postUserId !== null) {
                $query->where('p.user_id', $postUserId);
            }
        } else {
            $query->where('p.user_id', $user->id);
        }

        $data = $query->get()->groupBy('view_date');

        $result = [];
        foreach ($dates as $d) {
            $dailyData = $data->get($d, collect());
            $totalViews = $dailyData->sum('total_views');

            $postDetails = $dailyData->map(function ($item) {
                return [
                    'post_id' => $item->post_id,
                    'user_id' => Auth::user()->id,
                    'post_user_id' => $item->post->user_id,
                    'total_views' => $item->total_views,
                ];
            })->toArray();

            $result[$d] = [
                'view_date' => $d,
                'label' => $this->_formatDateLabel($d),
                'total_views' => $totalViews,
                'post_details' => $postDetails,
                'colors' => '#435EBE'
            ];
        }

        // Return the result sorted by view_date
        return collect($result)->sortBy('view_date');
    }

    public function mostViewedPost($user, $params = [])
    {
        $postUserId = $params['post_user_id'] ?? null;

        $query = Post::with(['views' => function($query) use ($params) {
                                    $query->whereBetween('view_date', [$params['start_date'], $params['end_date']]);
                                }])
                                ->select('posts.*', DB::raw('SUM(post_views.view_count) as total_views'))
                                ->join('post_views', 'posts.id', '=', 'post_views.post_id')
                                ->whereBetween('post_views.view_date', [$params['start_date'], $params['end_date']])
                                ->where('status', PostStatus::PUBLISHED)
                                ->groupBy('posts.id')
                                ->orderBy('total_views', 'desc');

        if ($user->roles->first()->name == EnumUserRole::MASTER->value) {
            if ($postUserId && $postUserId !== null) {
                $query->where('posts.user_id', $postUserId);
            }
        } else {
            $query->where('posts.user_id', $user->id);
        }

        $mostViewedPosts = $query->limit(10)->get();

        return $mostViewedPosts;
    }

    public function getTopVisitorCountries($params = [])
    {
        $topCountries = DB::table('visitor_statistics')
            ->select('country', DB::raw('DATE(created_at) as visit_date'), DB::raw('COUNT(*) as total_visits'))
            ->whereBetween('date', [$params['start_date'], $params['end_date']])
            ->groupBy('country', 'visit_date')
            ->orderBy('total_visits', 'desc')
            ->limit($this->topLimit)
            ->get();

        $countries = [];
        $visits = [];
        $colors = $this->_generateColors(count($topCountries));

        foreach ($topCountries as $country) {
            $countries[] = $country->country;
            $visits[] = $country->total_visits;
        }
        
        return [
            'colors' => $colors,
            'labels' => $countries,
            'series' => $visits,
        ];
    }

    public function getTopVisitorBrowsers($params = [])
    {
        $topBrowsers = DB::table('visitor_statistics')
            ->select('browser', DB::raw('DATE(created_at) as visit_date'), DB::raw('COUNT(*) as total_visits'))
            ->whereBetween('date', [$params['start_date'], $params['end_date']])
            ->groupBy('browser', 'visit_date')
            ->orderBy('total_visits', 'desc')
            ->limit($this->topLimit)
            ->get();

        $browsers = [];
        $visits = [];
        $colors = $this->_generateColors(count($topBrowsers));

        foreach ($topBrowsers as $browser) {
            $browsers[] = $browser->browser;
            $visits[] = $browser->total_visits;
        }
        
        return [
            'colors' => $colors,
            'labels' => $browsers,
            'series' => $visits,
        ];
    }

    public function getTopVisitorDevices($params = [])
    {
        $topDevices = DB::table('visitor_statistics')
            ->select('device', DB::raw('DATE(created_at) as visit_date'), DB::raw('COUNT(*) as total_visits'))
            ->whereBetween('date', [$params['start_date'], $params['end_date']])
            ->groupBy('device', 'visit_date')
            ->orderBy('total_visits', 'desc')
            ->limit($this->topLimit)
            ->get();

        $devices = [];
        $visits = [];
        $colors = $this->_generateColors(count($topDevices));

        foreach ($topDevices as $device) {
            $devices[] = $device->device;
            $visits[] = $device->total_visits;
        }

        return [
            'colors' => $colors,
            'labels' => $devices,
            'series' => $visits,
        ];
    }

    public function getTopVisitorOperatingSystems($params = [])
    {
        $topOperatingSystems = DB::table('visitor_statistics')
            ->select('os', DB::raw('DATE(created_at) as visit_date'), DB::raw('COUNT(*) as total_visits'))
            ->whereBetween('date', [$params['start_date'], $params['end_date']])
            ->groupBy('os', 'visit_date')
            ->orderBy('total_visits', 'desc')
            ->limit($this->topLimit)
            ->get();

        $operatingSystems = [];
        $visits = [];
        $colors = $this->_generateColors(count($topOperatingSystems));

        foreach ($topOperatingSystems as $os) {
            $operatingSystems[] = $os->os;
            $visits[] = $os->total_visits;
        }

        return [
            'colors' => $colors,
            'labels' => $operatingSystems,
            'series' => $visits,
        ];
    }

    public function _formatDateLabel($date)
    {
        return date('M j, Y', strtotime($date));
    }

    public function _generateColors($count)
    {
        $colors = [];

        for ($i = 0; $i < $count; $i++) {
            $colors[] = $this->_randomColor();
        }

        return $colors;
    }

    public function _randomColor()
    {
        return sprintf('#%06X', mt_rand(0, 0xFFFFFF));
    }
}