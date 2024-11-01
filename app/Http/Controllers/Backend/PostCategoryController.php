<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostCategoryStoreRequest;
use App\Http\Requests\PostCategoryUpdateRequest;
use App\Models\PostCategory;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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

        activity('post_category_management')
            ->causedBy(Auth::user())
            ->log('Accessed post categories index.');

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

        activity('post_category_management')
            ->causedBy(Auth::user())
            ->log('Accessed create post category page.');

        return view('backend.post_category.create', [
            'title' => 'New Category',
            'categoryId' => $categoryId
        ]);
    }

    public function store(PostCategoryStoreRequest $request): RedirectResponse
    {
        $postCategory = PostCategory::create([
            'name' => $request->category_name,
            'slug' => $request->slug
        ]);

        activity('post_category_management')
            ->causedBy(Auth::user())
            ->log("Created post category: {$postCategory->name}");

        return redirect()->route('post.category.index')->with('success', 'Post category created successfully');
    }

    public function edit(PostCategory $postCategory): View 
    {
        activity('post_category_management')
            ->causedBy(Auth::user())
            ->log("Accessed edit page for post category: {$postCategory->name}");

        return view('backend.post_category.edit', [
            'title' => 'Edit Category',
            'postCategory' => $postCategory
        ]);
    }

    public function update(PostCategoryUpdateRequest $request, PostCategory $postCategory): RedirectResponse
    {
        $postCategory->update([
            'name' => $request->category_name,
            'slug' => $request->slug
        ]);

        activity('post_category_management')
            ->causedBy(Auth::user())
            ->log("Updated post category: {$postCategory->name}");

        return redirect()->route('post.category.index')->with('success', 'Post category updated successfully');
    }

    public function destroy(PostCategory $postCategory): RedirectResponse
    {
        activity('post_category_management')
            ->causedBy(Auth::user())
            ->log("Deleted post category: {$postCategory->name}");

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

            activity('post_category_management')
                ->causedBy(Auth::user())
                ->log("Updated visibility for post category: {$category->name} to " . ($isChecked ? 'visible' : 'hidden'));

            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false], 404);
    }
}
