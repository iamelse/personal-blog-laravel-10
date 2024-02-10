<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ArticleController extends Controller
{
    public function index(): View
    {
        $posts = Post::orderBy('created_at', 'DESC')->paginate(10);

        return view('frontend.article.index', [
            'title' => 'My Article',
            'posts' => $posts
        ]);
    }

    public function show($slug): View
    {
        $post = Post::where('slug', $slug)->firstOrFail();

        return view('frontend.article.show', [
            'title' => $post->title,
            'post' => $post
        ]);
    }
}
