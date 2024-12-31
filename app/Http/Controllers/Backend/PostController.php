<?php

namespace App\Http\Controllers\Backend;

use App\Enums\EnumUserRole;
use App\Http\Controllers\Controller;
use App\Http\Requests\PostStoreRequest;
use App\Http\Requests\PostUpdateRequest;
use App\Models\Post;
use App\Models\PostCategory;
use App\Repositories\PostRepository;
use App\Services\ImageManagementService;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;

class PostController extends Controller
{
    public function __construct(
        protected ImageManagementService $imageManagementService,
        protected PostRepository $postRepository
    ) {}
    
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
        
        $posts = $this->postRepository->getFilteredPosts($filters);
        $categories = PostCategory::all();

        activity('post_management')
            ->causedBy(Auth::user())
            ->log('Accessed posts index.');

        return view('backend.article.index', [
            'title' => 'Post',
            'posts' => $posts,
            'categories' => $categories,
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

    public function store(PostStoreRequest $request): RedirectResponse
    {
        try {
            $post = $this->postRepository->store($request);

            activity('post_management')
                ->causedBy(Auth::user())
                ->log("Created post: {$post->title}");

            return redirect()->route('post.index')->with('success', 'Post created successfully');
        } catch (\Exception $e) {
            return redirect()->route('post.index')->with('error', 'Failed to create post: ' . $e->getMessage());
        }
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

    public function update(PostUpdateRequest $request, Post $post): RedirectResponse
    {
        try {
            $this->_authorizePost($post);

            $post = $this->postRepository->update($request, $post->id);
            
            activity('post_management')
                ->causedBy(Auth::user())
                ->log("Updated post: {$post->title}");
    
            return redirect()->route('post.index')->with('success', 'Post updated successfully');
        } catch (\Exception $e) {
            return redirect()->route('post.index')->with('error', 'Failed to update post: ' . $e->getMessage());
        }
    }

    public function destroy(Post $post): RedirectResponse
    {
        try {
            $this->_authorizePost($post);

            $this->imageManagementService->destroyImage($post->cover);

            activity('post_management')
                ->causedBy(Auth::user())
                ->log("Deleted post: {$post->title}");

            $this->postRepository->destroy($post->id);

            return redirect()->route('post.index')->with('success', 'Post deleted successfully');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect()->route('post.index')->with('error', 'Failed to delete post: ' . $e->getMessage());
        }
    }

    public function massDestroy(Request $request)
    {
        $request->validate([
            'ids' => 'required|array',
            'ids.*' => 'integer',
        ]);

        try {
            $posts = Post::whereIn('id', $request->ids)->get();

            foreach ($posts as $post) {
                $this->_authorizePost($post);

                $this->imageManagementService->destroyImage($post->cover);

                activity('post_management')
                    ->causedBy(Auth::user())
                    ->log("Deleted post: {$post->title}");
            }

            Post::whereIn('id', $request->ids)->delete();

            return redirect()->back()->with('success', 'Selected posts deleted successfully.');
        } catch (\Exception $e) {
            Log::error("Mass delete failed: " . $e->getMessage());

            return redirect()->back()->with('error', 'An error occurred while trying to delete selected posts.');
        }
    }

    private function _authorizePost(Post $post): void
    {
        /** Checks whether the authenticated user is either a MASTER role or the owner of the specified post. */
        if (!Auth::user()->roles[0]->name === EnumUserRole::MASTER->value && $post->user_id !== Auth::id()) {
            /** If not, it prevents access by aborting the request with a 404 status. */
            abort(404, 'Not found.');
        }
    }
}
