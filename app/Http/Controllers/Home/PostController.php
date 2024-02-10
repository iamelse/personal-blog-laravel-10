<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PostController extends Controller
{
    private function generateUniqueSlug(String $name): String
    {
        $slug = Str::slug($name);
        $counter = 1;

        while (Post::where('slug', $slug)->exists()) {
            $slug = Str::slug($name) . '-' . $counter++;
        }

        return $slug;
    }

    public function index(Request $request): View
    {
        $perPage = $request->input('limit', 10);
        $q = $request->input('q', '');
        $columns = ['name', 'slug'];

        $posts = Post::with('category')->when($q, function ($query) use ($q, $columns) {
            $query->where(function ($subquery) use ($q, $columns) {
                foreach ($columns as $column) {
                    $subquery->orWhere($column, 'LIKE', "%$q%");
                }
            });
        })->paginate($perPage);

        return view('dashboard.article.index', [
            'title' => 'Post',
            'posts' => $posts,
            'perPage' => $perPage,
            'q' => $q,
        ]);
    }

    public function create(): View 
    {
        return view('dashboard.article.create', [
            'title' => 'New Post'
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'title' => 'required|string|max:255'
        ]);

        $post = Post::create([
            'title' => $request->title,
            'slug' => $this->generateUniqueSlug($request->title)
        ]);

        return redirect()->route('post.index')->with('success', 'Post created successfully');
    }

    public function edit(Post $post): View 
    {
        return view('dashboard.article.edit', [
            'title' => 'Edit Post',
            'post' => $post
        ]);
    }

    public function update(Request $request, Post $post): RedirectResponse
    {
        $request->validate([
            'title' => 'required|string|max:255'
        ]);

        $post->update([
            'title' => $request->title,
            'slug' => $this->generateUniqueSlug($request->title)
        ]);

        return redirect()->route('post.index')->with('success', 'Post updated successfully');
    }

    public function destroy(Post $post): RedirectResponse
    {
        $post->delete();

        return redirect()->route('post.index')->with('success', 'Post deleted successfully');
    }
}
