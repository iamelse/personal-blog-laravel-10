<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\PostCategory;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\View\View;

class PostController extends Controller
{
    public function checkSlug(Request $request): JsonResponse
    {
        $slug = SlugService::createSlug(Post::class, 'slug', $request->title);

        return response()->json(['slug' => $slug]);
    }

    public function index(Request $request): View
    {
        $perPage = $request->input('limit', 10);
        $q = $request->input('q', '');
        $categoryFilter = $request->input('category_id', null);
        $columns = ['title', 'slug'];

        $query = Post::with('category')
            ->orderBy('created_at', 'desc')
            ->when($categoryFilter, function ($query) use ($categoryFilter) {
                $query->where('post_category_id', $categoryFilter);
            })
            ->when($q, function ($query) use ($q, $columns) {
                $query->where(function ($subquery) use ($q, $columns) {
                    foreach ($columns as $column) {
                        $subquery->orWhere($column, 'LIKE', "%$q%");
                    }
                });
            });

        $posts = $query->paginate($perPage);

        $categories = PostCategory::all();

        return view('backend.article.index', [
            'title' => 'Post',
            'posts' => $posts,
            'categories' => $categories,
            'perPage' => $perPage,
            'q' => $q,
            'categoryFilter' => $categoryFilter,
        ]);
    }

    public function create(): View 
    {
        return view('backend.article.create', [
            'title' => 'New Post',
            'categories' => PostCategory::all()
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:posts',
            'post_category_id' => 'required',
            'cover' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'content' => 'required'
        ]);

        if ($request->hasFile('cover')) {
            $file = $request->file('cover');
            $fileName = time() . '.' . $file->getClientOriginalExtension();

            $postDirectory = 'uploads/posts';
            $file->move(public_path($postDirectory), $fileName);

            $post = Post::create([
                'post_category_id' => $request->post_category_id,
                'user_id' => auth()->user()->id,
                'title' => $request->title,
                'slug' => $request->slug,
                'cover' => $postDirectory . '/' . $fileName,
                'body' => $request->content
            ]);

            return redirect()->route('post.index')->with('success', 'Post created successfully');
        }

        return redirect()->route('post.index')->with('error', 'Post create failed');
    }

    public function edit(Post $post): View 
    {
        return view('backend.article.edit', [
            'title' => 'Edit Post',
            'post' => $post,
            'categories' => PostCategory::all()
        ]);
    }

    public function update(Request $request, Post $post): RedirectResponse
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'post_category_id' => 'required',
            'slug' => 'required|string|max:255|unique:posts,slug,' . $post->id,
            'cover' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'content' => 'required'
        ]);

        if ($request->hasFile('cover')) {
            $file = $request->file('cover');
            $fileName = time() . '.' . $file->getClientOriginalExtension();

            $postDirectory = 'uploads/posts';
            $file->move(public_path($postDirectory), $fileName);

            if (!empty($post->cover)) {
                $oldCoverPath = public_path($post->cover);
                if (File::exists($oldCoverPath)) {
                    File::delete($oldCoverPath);
                }
            }

            $post->update([
                'post_category_id' => $request->post_category_id,
                'user_id' => auth()->user()->id,
                'title' => $request->title,
                'slug' => $request->slug,
                'cover' => $postDirectory . '/' . $fileName,
                'body' => $request->content
            ]);
        } else {
            $post->update([
                'post_category_id' => $request->post_category_id,
                'title' => $request->title,
                'slug' => $request->slug,
                'body' => $request->content
            ]);
        }

        return redirect()->route('post.index')->with('success', 'Post updated successfully');
    }

    public function destroy(Post $post): RedirectResponse
    {
        if (!empty($post->cover)) {
            $coverPath = public_path($post->cover);
            if (File::exists($coverPath)) {
                File::delete($coverPath);
            }
        }

        $post->delete();

        return redirect()->route('post.index')->with('success', 'Post deleted successfully');
    }
}
