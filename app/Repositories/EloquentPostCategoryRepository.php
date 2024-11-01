<?php

namespace App\Repositories;

use App\Http\Requests\PostCategoryStoreRequest;
use App\Http\Requests\PostCategoryUpdateRequest;
use App\Models\PostCategory;
use Illuminate\Support\Facades\Auth;

class EloquentPostCategoryRepository implements PostCategoryRepository
{
    public function store(PostCategoryStoreRequest $request): PostCategory
    {
        $data = $this->prepareData($request);
        return PostCategory::create($data);
    }

    public function getFilteredPostCategories(array $filters)
    {
        $user = Auth::user();

        if ($user->roles[0]->name === "Master") {
            return PostCategory::filter($filters);
        } else {
            return PostCategory::where('user_id', $user->id)->filter($filters);
        }
    }

    public function update(PostCategoryUpdateRequest $request, int $id): PostCategory
    {
        $postCaPostCategory = PostCategory::findOrFail($id);

        $data = $this->prepareData($request, $postCaPostCategory);
        $postCaPostCategory->update($data);

        return $postCaPostCategory;
    }

    public function destroy(int $id): PostCategory
    {
        $postCaPostCategory = PostCategory::findOrFail($id);
        $postCaPostCategory->delete();
        return $postCaPostCategory;
    }

    protected function prepareData($request): array
    {
        $data = [
            'name' => $request->category_name,
            'slug' => $request->slug
        ];

        return $data;
    }
}