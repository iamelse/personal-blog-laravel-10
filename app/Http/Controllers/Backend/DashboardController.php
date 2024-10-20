<?php

namespace App\Http\Controllers\Backend;

use App\Enums\PostStatus;
use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Services\PostViewAnalyticsServices;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class DashboardController extends Controller
{
    protected $postAnalyticsServices;

    public function __construct(PostViewAnalyticsServices $postAnalyticsServices)
    {
        $this->postAnalyticsServices = $postAnalyticsServices;
    }

    public function index(Request $request): View
    {
        $params = [
            'start_date' => $request->query('start_date', Carbon::today()->subDays(6)->toDateString()), // Default: 1 week before today
            'end_date' => $request->query('end_date', Carbon::today()->toDateString()), // Default: today
            'subdays' => $request->query('subdays', 6)
        ];

        $totalPostViews = [
            'today' => $this->postAnalyticsServices->getViewsForToday(),
            'week' => $this->postAnalyticsServices->getViewsForWeek(),
            'month' => $this->postAnalyticsServices->getViewsForMonth(),
            'year' => $this->postAnalyticsServices->getViewsForYear(),
        ];

        $historycalPostViews = [
            'week' => $this->postAnalyticsServices->getViewsHistoriesForWeek($params)
        ];

        $user = Auth::user();

        activity('dashboard')
            ->causedBy($user)
            ->log("Accessed the dashboard.");

        return view('backend.dashboard.index', [
            'title' => 'Dashboard',
            'totalPostViews' => $totalPostViews,
            'historycalPostViews' => $historycalPostViews,
            'totalPosts' => Post::all(),
            'draftedPosts' => Post::where('status', PostStatus::DRAFT)->get(),
            'publishedPosts' => Post::where('status', PostStatus::PUBLISHED)->get(),
            'scheduledPosts' => Post::where('status', PostStatus::SCHEDULED)->get(),
            'mostViewedPosts' => $this->postAnalyticsServices->mostViewedPost($params),
            'historycalVisitorCountries' => $this->postAnalyticsServices->getTopVisitorCountries($params),
            'historycalVisitorBrowsers' => $this->postAnalyticsServices->getTopVisitorBrowsers($params),
            'historycalVisitorDevices' => $this->postAnalyticsServices->getTopVisitorDevices($params),
            'historycalVisitorOS' => $this->postAnalyticsServices->getTopVisitorOperatingSystems($params),
        ]);
    }
}
