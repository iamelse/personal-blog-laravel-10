<?php 

namespace App\Repositories;

use App\Http\Requests\PostCategoryStoreRequest;
use App\Http\Requests\PostCategoryUpdateRequest;
use App\Models\PostCategory;

interface PostCategoryRepository
{
    public function getFilteredPostCategories(array $filters);
    public function store(PostCategoryStoreRequest $request): ?PostCategory;
    public function update(PostCategoryUpdateRequest $request, int $id): ?PostCategory;
    public function destroy(int $id): ?PostCategory;
}