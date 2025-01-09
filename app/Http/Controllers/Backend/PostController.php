<?php

namespace App\Http\Controllers\Backend;

use App\Enums\EnumUserRole;
use App\Enums\PostStatus;
use App\Http\Controllers\Controller;
use App\Http\Requests\PostStoreRequest;
use App\Http\Requests\PostUpdateRequest;
use App\Models\Post;
use App\Models\PostCategory;
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
        
        $posts = $this->getFilteredPosts($filters);
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
            // Prepare the data for the post
            $data = [
                'post_category_id' => $request->post_category_id,
                'title' => $request->title,
                'slug' => $request->slug,
                'body' => $request->content,
                'user_id' => Auth::user()->id,
                'published_at' => $request->published_at,
                'status' => $this->determineStatus($request),
            ];

            // If a cover image is uploaded, handle it
            if ($request->hasFile('cover')) {
                $file = $request->file('cover');
                $imagePath = $this->imageManagementService->uploadImage($file, [
                    'disk' => env('FILESYSTEM_DISK'),
                    'folder' => 'uploads/posts/covers',
                ]);
                $data['cover'] = $imagePath; // Assign the uploaded image path
            }

            // Assuming you are saving the post now:
            Post::create($data);  // Save the post to the database

            // Log the post creation activity
            activity('post_management')
                ->causedBy(Auth::user())
                ->log("Created post: {$request->title}");

            // Redirect with success message
            return redirect()->route('post.index')->with('success', 'Post created successfully');
            
        } catch (\Exception $e) {
            // Log the exception for debugging purposes
            Log::error('Error creating post: ' . $e->getMessage(), [
                'exception' => $e,
                'request' => $request->all(),
            ]);

            // Redirect with error message
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
            // Authorize the user to update the post
            $this->_authorizePost($post);

            // Prepare the data for the post update
            $data = [
                'post_category_id' => $request->post_category_id,
                'title' => $request->title,
                'slug' => $request->slug,
                'body' => $request->content,
                'published_at' => $request->published_at,
                'status' => $this->determineStatus($request),
            ];

            // If a new cover image is uploaded, handle it
            if ($request->hasFile('cover')) {
                // Delete the old cover image if it exists
                if ($post->cover) {
                    $this->imageManagementService->destroyImage($post->cover);
                }

                // Upload the new cover image
                $file = $request->file('cover');
                $imagePath = $this->imageManagementService->uploadImage($file, [
                    'disk' => env('FILESYSTEM_DISK'),
                    'folder' => 'uploads/posts/covers',
                ]);

                // Assign the new image path to the post data
                $data['cover'] = $imagePath;
            }

            // Update the post in the database
            $post->update($data);

            // Log the activity
            activity('post_management')
                ->causedBy(Auth::user())
                ->log("Updated post: {$post->title}");

            // Redirect with success message
            return redirect()->route('post.index')->with('success', 'Post updated successfully');
            
        } catch (\Exception $e) {
            // Log the exception for debugging purposes
            Log::error('Error updating post: ' . $e->getMessage(), [
                'exception' => $e,
                'request' => $request->all(),
            ]);

            // Redirect with error message
            return redirect()->route('post.index')->with('error', 'Failed to update post: ' . $e->getMessage());
        }
    }

    public function destroy(Post $post): RedirectResponse
    {
        try {
            $post = Post::findOrFail($post->id);

            $this->_authorizePost($post);
            
            $post->delete();

            $this->imageManagementService->destroyImage($post->cover);

            activity('post_management')
                ->causedBy(Auth::user())
                ->log("Deleted post: {$post->title}");

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

    private function getFilteredPosts(array $filters)
    {
        $user = Auth::user();

        if ($user->roles[0]->name === "Master") {
            return Post::filter($filters);
        } else {
            return Post::where('user_id', $user->id)->filter($filters);
        }
    }

    private function determineStatus($request): string
    {
        return $request->published_at && $request->published_at > now()
            ? PostStatus::SCHEDULED->value
            : PostStatus::PUBLISHED->value;
    }
}
