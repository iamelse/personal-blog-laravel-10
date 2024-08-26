<?php

namespace App\Services;

use App\Enums\PostStatus;
use App\Models\Post;
use App\Models\PostView;
use Illuminate\Support\Facades\DB;

class PostViewAnalyticsServices
{
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
    public function getViewsHistoriesForWeek()
    {
        $startDate = now()->subDays(6)->toDateString();
        $endDate = now()->toDateString();
        $currentDate = now()->toDateString();

        $dates = [];
        for ($date = $startDate; $date <= $endDate; $date = date('Y-m-d', strtotime($date . ' +1 day'))) {
            $dates[] = $date;
        }

        $data = PostView::select(DB::raw('view_date, SUM(view_count) as total_views'))
                    ->whereBetween('view_date', [$startDate, $endDate])
                    ->groupBy('view_date')
                    ->orderBy('view_date', 'asc')
                    ->get()
                    ->keyBy('view_date');

        $result = [];
        foreach ($dates as $date) {
            $isToday = ($date === $currentDate);
            $result[$date] = [
                'view_date' => $date,
                'label' => $isToday ? 'Today' : $this->_formatDateLabel($date),
                'total_views' => $data->has($date) ? $data[$date]->total_views : 0,
                'colors' => $isToday ? '#349454' : '#435EBE'
            ];
        }

        return collect($result)->sortBy('view_date');
    }

    public function mostViewedPost()
    {
        $startOfDay = now()->startOfDay();
        $endOfDay = now()->endOfDay();

        $mostViewedPosts = Post::select('posts.*', DB::raw('SUM(post_views.view_count) as total_views'))
                                ->join('post_views', 'posts.id', '=', 'post_views.post_id')
                                ->whereBetween('post_views.created_at', [$startOfDay, $endOfDay])
                                ->where('status', PostStatus::PUBLISHED)
                                ->groupBy('posts.id')
                                ->orderBy('total_views', 'desc')
                                ->limit(10)
                                ->get();

        return $mostViewedPosts;
    }

    private function _formatDateLabel($date)
    {
        return date('M j, Y', strtotime($date));
    }
}