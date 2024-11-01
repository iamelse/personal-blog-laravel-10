<?php 

namespace App\Repositories;

use App\Http\Requests\PostStoreRequest;
use App\Http\Requests\PostUpdateRequest;
use App\Models\Post;

interface PostRepository
{
    public function getFilteredPosts(array $filters);
    public function store(PostStoreRequest $request): ?Post;
    public function update(PostUpdateRequest $request, int $id): ?Post;
    public function destroy(int $id): ?Post;
}