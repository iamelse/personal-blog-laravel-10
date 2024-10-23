<?php

namespace App\Http\Controllers\Backend;

use App\Enums\EnumUserRole;
use App\Enums\PostStatus;
use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\User;
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
            'subdays' => $request->query('subdays', 6),
            'post_user_id' => $request->query('post_user_id', null)
        ];

        $historycalPostViews = [
            'week' => $this->postAnalyticsServices->getViewsHistoriesForWeek($params)
        ];

        $users = User::all();
        $user = Auth::user();

        activity('dashboard')
            ->causedBy($user)
            ->log("Accessed the dashboard.");
            
        return view('backend.dashboard.index', [
            'title' => 'Dashboard',
            'historycalPostViews' => $historycalPostViews,
            'totalPosts' => $this->_allPosts($user),
            'draftedPosts' => $this->_allDraftedPosts($user),
            'publishedPosts' => $this->_allPublishedPosts($user),
            'scheduledPosts' => $this->_allScheduledPosts($user),
            'mostViewedPosts' => $this->postAnalyticsServices->mostViewedPost($user, $params),
            'historycalVisitorCountries' => $this->postAnalyticsServices->getTopVisitorCountries($params),
            'historycalVisitorBrowsers' => $this->postAnalyticsServices->getTopVisitorBrowsers($params),
            'historycalVisitorDevices' => $this->postAnalyticsServices->getTopVisitorDevices($params),
            'historycalVisitorOS' => $this->postAnalyticsServices->getTopVisitorOperatingSystems($params),
            'users' => $users
        ]);
    }

    private function _getPostsByUser($user, $status = null) {
        if ($user->roles[0]->name === EnumUserRole::MASTER->value) {
            $query = Post::query();
        } else {
            $query = Post::where('user_id', $user->id);
        }
    
        if ($status) {
            $query->where('status', $status);
        }
    
        return $query->get();
    }

    private function _allPosts($user) {
        return $this->_getPostsByUser($user);
    }
    
    private function _allScheduledPosts($user) {
        return $this->_getPostsByUser($user, PostStatus::SCHEDULED);
    }
    
    private function _allDraftedPosts($user) {
        return $this->_getPostsByUser($user, PostStatus::DRAFT);
    }
    
    private function _allPublishedPosts($user) {
        return $this->_getPostsByUser($user, PostStatus::PUBLISHED);
    }    
}
