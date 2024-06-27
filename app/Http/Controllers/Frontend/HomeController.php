<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Home;
use App\Models\PostCategory;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        $home = Home::first();
        $postCategories = PostCategory::withCount('posts')
                                    ->where('show_in_homepage', true)
                                    ->orderByDesc('posts_count')
                                    ->take(4)
                                    ->get();
        $projects = Project::latest('created_at')
                            ->take(2)
                            ->get();

        return view('frontend.home.index', [
            'title' => 'Home',
            'home' => $home,
            'postCategories' => $postCategories,
            'projects' => $projects
        ]);
    }
}
