<?php

namespace App\Http\Controllers\Backend;

use App\Enums\PostStatus;
use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Services\PostViewAnalyticsServices;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class DashboardController extends Controller
{
    protected $postAnalyticsServices;

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


        return view('backend.dashboard', [
            'title' => 'Dashboard',
            'totalPostViews' => $totalPostViews,
            'historycalPostViews' => $historycalPostViews,
            'totalPosts' => Post::all(),
            'draftedPosts' => Post::where('status', PostStatus::DRAFT)->get(),
            'publishedPosts' => Post::where('status', PostStatus::PUBLISHED)->get(),
            'scheduledPosts' => Post::where('status', PostStatus::SCHEDULED)->get(),
            'historycalVisitorCountries' => $this->_getTopVisitorCountries()
        ]);
    }

    private function _getTopVisitorCountries()
    {
        $topCountries = DB::table('visitor_statistics')
            ->select('country', DB::raw('DATE(created_at) as visit_date'), DB::raw('COUNT(*) as total_visits'))
            ->groupBy('country', 'visit_date')
            ->orderBy('total_visits', 'desc')
            ->limit(3)
            ->get();

        $countries = [];
        $visits = [];
        foreach ($topCountries as $country) {
            $countries[] = $country->country;
            $visits[] = $country->total_visits;
        }

        return [
            'labels' => $countries,
            'series' => $visits,
        ];
    }
}
