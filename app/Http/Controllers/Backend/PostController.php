<?php

namespace App\Http\Controllers\Backend;

use App\Enums\EnumUserRole;
use App\Enums\PostStatus;
use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\PostCategory;
use App\Services\ImageManagementService;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\View\View;

class PostController extends Controller
{
    protected $imageManagementService;

    public function __construct(ImageManagementService $imageManagementService)
    {
        $this->imageManagementService = $imageManagementService;
    }
    
    public function checkSlug(Request $request): JsonResponse
    {
        $slug = SlugService::createSlug(Post::class, 'slug', $request->title);

        return response()->json(['slug' => $slug]);
    }

    public function index(Request $request): View
    {
        $filters = [
            'q' => $request->input('q', ''),
            'perPage' => $request->input('limit', 10),
            'category_id' => $request->input('category_id', null),
            'columns' => ['title', 'slug']
        ];
        
        $posts = $this->_getFilteredPosts($filters);
        $categories = PostCategory::all();

        activity('post_management')
            ->causedBy(Auth::user())
            ->log('Accessed posts index.');

        return view('backend.article.index', [
            'title' => 'Post',
            'posts' => $posts,
            'categories' => $categories,
            'perPage' => $filters['perPage'],
            'q' => $filters['q'],
            'category_id' => $filters['category_id'],
        ]);
    }

    public function create(): View 
    {
        activity('post_management')
            ->causedBy(Auth::user())
            ->log('Accessed create post page.');

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
            'post_category_id' => 'required|exists:post_categories,id',
            'cover' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'content' => 'required',
            'published_at' => 'nullable|date|after:now'
        ]);

        $imagePath = null;

        if ($request->hasFile('cover')) {
            $file = $request->file('cover');

            $imagePath = $this->imageManagementService->uploadImage($file, [
                'disk' => env('FILESYSTEM_DISK'),
                'folder' => 'uploads/posts/covers',
            ]);
        }

        $status = $request->published_at && $request->published_at > now()
            ? PostStatus::SCHEDULED
            : PostStatus::PUBLISHED;

        $post = Post::create([
            'post_category_id' => $request->post_category_id,
            'user_id' => auth()->user()->id,
            'title' => $request->title,
            'slug' => $request->slug,
            'cover' => $imagePath,
            'body' => $request->content,
            'published_at' => $request->published_at,
            'status' => $status,
        ]);

        activity('post_management')
            ->causedBy(Auth::user())
            ->log("Created post: {$post->title}");

        return redirect()->route('post.index')->with('success', 'Post created successfully');
    }

    public function edit(Post $post): View 
    {
        $this->_authorizePost($post);

        activity('post_management')
            ->causedBy(Auth::user())
            ->log("Accessed edit page for post: {$post->title}");

        return view('backend.article.edit', [
            'title' => 'Edit Post',
            'post' => $post,
            'categories' => PostCategory::all()
        ]);
    }

    public function update(Request $request, Post $post): RedirectResponse
    {
        $this->_authorizePost($post);

        $request->validate([
            'title' => 'required|string|max:255',
            'post_category_id' => 'required|exists:post_categories,id',
            'slug' => 'required|string|max:255|unique:posts,slug,' . $post->id,
            'cover' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'content' => 'required'
        ]);

        $data = [
            'post_category_id' => $request->post_category_id,
            'title' => $request->title,
            'slug' => $request->slug,
            'body' => $request->content,
        ];

        if ($request->hasFile('cover')) {
            $file = $request->file('cover');
            $imagePath = $this->imageManagementService->uploadImage($file, [
                'currentImagePath' => $post->cover ?? null,
                'disk' => env('FILESYSTEM_DISK'),
                'folder' => 'uploads/posts/covers',
            ]);
            
            $data['cover'] = $imagePath;
        }

        $post->update($data);

        activity('post_management')
            ->causedBy(Auth::user())
            ->log("Updated post: {$post->title}");

        return redirect()->route('post.index')->with('success', 'Post updated successfully');
    }

    public function destroy(Post $post): RedirectResponse
    {
        $this->_authorizePost($post);

        $this->imageManagementService->destroyImage($post->cover);

        activity('post_management')
            ->causedBy(Auth::user())
            ->log("Deleted post: {$post->title}");

        $post->delete();

        return redirect()->route('post.index')->with('success', 'Post deleted successfully');
    }

    private function _getFilteredPosts($filters)
    {
        $user = Auth::user();

        if ($user->roles[0]->name === "Master") {
            return Post::filter($filters);
        } else {
            return Post::where('user_id', $user->id)->filter($filters);
        }
    }

    private function _authorizePost(Post $post): void
    {
        if (!Auth::user()->roles[0]->name === EnumUserRole::MASTER->value && $post->user_id !== Auth::id()) {
            abort(404, 'Not found.');
        }
    }
}
