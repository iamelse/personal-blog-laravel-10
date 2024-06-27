<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\PostCategory;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

class PostCategoryController extends Controller
{
    public function checkSlug(Request $request): JsonResponse
    {
        $slug = SlugService::createSlug(PostCategory::class, 'slug', $request->name);

        return response()->json(['slug' => $slug]);
    }
    
    public function index(Request $request): View
    {
        $perPage = $request->input('limit', 10);
        $q = $request->input('q', '');
        $columns = ['name', 'slug'];

        $postCategories = PostCategory::when($q, function ($query) use ($q, $columns) {
            $query->where(function ($subquery) use ($q, $columns) {
                foreach ($columns as $column) {
                    $subquery->orWhere($column, 'LIKE', "%$q%");
                }
            });
        })->paginate($perPage);

        return view('backend.post_category.index', [
            'title' => 'Post Category',
            'postCategories' => $postCategories,
            'perPage' => $perPage,
            'q' => $q,
        ]);
    }

    public function create(): View 
    {
        $categoryId = uniqid();

        return view('backend.post_category.create', [
            'title' => 'New Category',
            'categoryId' => $categoryId
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'category_name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:post_categories',
        ]);

        PostCategory::create([
            'name' => $request->category_name,
            'slug' => $request->slug
        ]);

        return redirect()->route('post.category.index')->with('success', 'Post category created successfully');
    }

    public function edit(PostCategory $postCategory): View 
    {
        return view('backend.post_category.edit', [
            'title' => 'Edit Category',
            'postCategory' => $postCategory
        ]);
    }

    public function update(Request $request, PostCategory $postCategory): RedirectResponse
    {
        $request->validate([
            'category_name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:post_categories,slug,' . $postCategory->id,
        ]);

        $postCategory->update([
            'name' => $request->category_name,
            'slug' => $request->slug
        ]);

        return redirect()->route('post.category.index')->with('success', 'Post category updated successfully');
    }

    public function destroy(PostCategory $postCategory): RedirectResponse
    {
        $postCategory->delete();

        return redirect()->route('post.category.index')->with('success', 'Post category deleted successfully');
    }

    public function updateVisibility(Request $request)
    {
        $categoryId = $request->input('categoryId');
        $isChecked = $request->input('isChecked');

        $category = PostCategory::find($categoryId);

        if ($category) {
            $category->update([
                'show_in_homepage' => $isChecked
            ]);
            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false], 404);
    }

}
