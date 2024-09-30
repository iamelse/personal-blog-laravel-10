<?php

namespace App\Http\Controllers\Backend;

use App\Enums\PostStatus;
use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Services\PostViewAnalyticsServices;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class DashboardController extends Controller
{
    protected $postAnalyticsServices;
    protected $topLimit = 5;

    public function __construct(PostViewAnalyticsServices $postAnalyticsServices)
    {
        $this->postAnalyticsServices = $postAnalyticsServices;
    }

    public function index(): View
    {
        $totalPostViews = [
            'today' => $this->postAnalyticsServices->getViewsForToday(),
            'week' => $this->postAnalyticsServices->getViewsForWeek(),
            'month' => $this->postAnalyticsServices->getViewsForMonth(),
            'year' => $this->postAnalyticsServices->getViewsForYear(),
        ];

        $historycalPostViews = [
            'week' => $this->postAnalyticsServices->getViewsHistoriesForWeek()
        ];

        $mostViewedPosts = $this->postAnalyticsServices->mostViewedPost();

        return view('backend.dashboard.index', [
            'title' => 'Dashboard',
            'totalPostViews' => $totalPostViews,
            'historycalPostViews' => $historycalPostViews,
            'totalPosts' => Post::all(),
            'draftedPosts' => Post::where('status', PostStatus::DRAFT)->get(),
            'publishedPosts' => Post::where('status', PostStatus::PUBLISHED)->get(),
            'scheduledPosts' => Post::where('status', PostStatus::SCHEDULED)->get(),
            'mostViewedPosts' => $mostViewedPosts,
            'historycalVisitorCountries' => $this->_getTopVisitorCountries(),
            'historycalVisitorBrowsers' => $this->_getTopVisitorBrowsers(),
            'historycalVisitorDevices' => $this->_getTopVisitorDevices(),
            'historycalVisitorOS' => $this->_getTopVisitorOperatingSystems(),
        ]);
    }

    private function _getTopVisitorCountries()
    {
        $today = Carbon::today();
        $topCountries = DB::table('visitor_statistics')
            ->select('country', DB::raw('DATE(created_at) as visit_date'), DB::raw('COUNT(*) as total_visits'))
            ->whereDate('created_at', $today)
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

    private function _getTopVisitorBrowsers()
    {
        $today = Carbon::today();
        $topBrowsers = DB::table('visitor_statistics')
            ->select('browser', DB::raw('DATE(created_at) as visit_date'), DB::raw('COUNT(*) as total_visits'))
            ->whereDate('created_at', $today)
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

    private function _getTopVisitorDevices()
    {
        $today = Carbon::today();
        $topDevices = DB::table('visitor_statistics')
            ->select('device', DB::raw('DATE(created_at) as visit_date'), DB::raw('COUNT(*) as total_visits'))
            ->whereDate('created_at', $today)
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

    private function _getTopVisitorOperatingSystems()
    {
        $today = Carbon::today();
        $topOperatingSystems = DB::table('visitor_statistics')
            ->select('os', DB::raw('DATE(created_at) as visit_date'), DB::raw('COUNT(*) as total_visits'))
            ->whereDate('created_at', $today)
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

    private function _generateColors($count)
    {
        $colors = [];

        for ($i = 0; $i < $count; $i++) {
            $colors[] = $this->_randomColor();
        }

        return $colors;
    }

    private function _randomColor()
    {
        return sprintf('#%06X', mt_rand(0, 0xFFFFFF));
    }
}
