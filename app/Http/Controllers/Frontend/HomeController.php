<?php

namespace App\Http\Controllers\Frontend;

use App\Enums\PostStatus;
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
        
        //$postCategories = PostCategory::with('posts')
        //                            ->where('show_in_homepage', true)
        //                            ->whereHas('posts', function ($query) {
        //                                $query->where('status', PostStatus::PUBLISHED);
        //                            })
        //                            ->get();

        $postCategories = PostCategory::with(['posts' => function ($query) {
            $query->where('status', PostStatus::PUBLISHED);
        }])
        ->where('show_in_homepage', true)
        ->get();

        $postCategories->each(function ($category) {
            $category->posts_count = $category->posts->count();
        });
        $postCategories = $postCategories->sortByDesc('posts_count');
        $postCategories = $postCategories->take(4);

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
