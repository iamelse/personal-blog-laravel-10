<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\PostCategory;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ArticleController extends Controller
{
    public function searchAnArticle(Request $request)
    {
        $query = $request->input('query');
        $categorySlug = $request->input('category');

        $postsQuery = Post::query();

        if ($query) {
            $postsQuery->where('title', 'LIKE', '%' . $query . '%');
        }

        if ($categorySlug) {
            $category = PostCategory::where('slug', $categorySlug)->first();

            if ($category) {
                $postsQuery->where('post_category_id', $category->id);
            }
        }

        $posts = $postsQuery->paginate(10);
        $postCategories = PostCategory::all();
        $title = $query ? 'Looking for "' . $query . '" in articles' : 'All Articles';

        return view('frontend.article.index', [
            'posts' => $posts,
            'postCategories' => $postCategories,
            'title' => $title
        ]);
    }

    public function index(): View
    {
        $posts = Post::orderBy('created_at', 'DESC')->paginate(10);
        $postCategories = PostCategory::all();

        return view('frontend.article.index', [
            'title' => 'My Article',
            'postCategories' => $postCategories,
            'posts' => $posts
        ]);
    }

    public function show($slug): View
    {
        $post = Post::with('author', 'category')->where('slug', $slug)->firstOrFail();
        $relatedPosts = Post::where('post_category_id', $post->post_category_id)
                            ->where('slug', '!=', $post->slug)
                            ->inRandomOrder()
                            ->limit(4)
                            ->get();

        return view('frontend.article.show', [
            'title' => $post->title,
            'post' => $post,
            'relatedPosts' => $relatedPosts
        ]);
    }
}
