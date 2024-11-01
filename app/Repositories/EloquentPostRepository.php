<?php

namespace App\Repositories;

use App\Enums\PostStatus;
use App\Http\Requests\PostStoreRequest;
use App\Http\Requests\PostUpdateRequest;
use App\Models\Post;
use App\Services\ImageManagementService;
use Illuminate\Support\Facades\Auth;

class EloquentPostRepository implements PostRepository
{
    protected $imageManagementService;

    public function __construct(ImageManagementService $imageManagementService)
    {
        $this->imageManagementService = $imageManagementService;
    }

    public function getFilteredPosts(array $filters)
    {
        $user = Auth::user();

        if ($user->roles[0]->name === "Master") {
            return Post::filter($filters);
        } else {
            return Post::where('user_id', $user->id)->filter($filters);
        }
    }

    public function store(PostStoreRequest $request): Post
    {
        $data = $this->prepareData($request);
        return Post::create($data);
    }

    public function update(PostUpdateRequest $request, int $id): Post
    {
        $post = Post::findOrFail($id);

        $data = $this->prepareData($request, $post);
        $post->update($data);

        return $post;
    }

    public function destroy(int $id): Post
    {
        $post = Post::findOrFail($id);
        $post->delete();
        return $post;
    }

    protected function prepareData($request, Post $post = null): array
    {
        $data = [
            'post_category_id' => $request->post_category_id,
            'title' => $request->title,
            'slug' => $request->slug,
            'body' => $request->content,
            'published_at' => $request->published_at,
            'status' => $this->determineStatus($request),
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

        return $data;
    }

    protected function determineStatus($request): string
    {
        return $request->published_at && $request->published_at > now()
            ? PostStatus::SCHEDULED->value
            : PostStatus::PUBLISHED->value;
    }
}