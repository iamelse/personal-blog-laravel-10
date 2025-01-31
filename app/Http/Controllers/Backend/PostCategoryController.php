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
        $filters = [
            'perPage' => $request->input('limit', 10),
            'q' => $request->input('q', ''),
            'columns' => ['name', 'slug']
        ];

        $postCategories = $this->getFilteredPostCategories($filters);

        activity('post_category_management')
            ->causedBy(Auth::user())
            ->log('Accessed post categories index.');

        return view('backend.post_category.index', [
            'title' => 'Post Category',
            'postCategories' => $postCategories
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
        try {
            PostCategory::create([
                'name' => $request->category_name,
                'slug' => $request->slug,
            ]);

            activity('post_category_management')
                ->causedBy(Auth::user())
                ->log("Created post category: {$request->name}");

            return redirect()->route('post.category.index')->with('success', 'Post category created successfully');
        } catch (\Exception $e) {
            return redirect()->route('post.category.index')->with('error', 'Failed to create post category: ' . $e->getMessage());
        }
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
        try {
            $postCategory->update([
                'name' => $request->category_name,
                'slug' => $request->slug,
            ]);

            activity('post_category_management')
                ->causedBy(Auth::user())
                ->log("Updated post category: {$postCategory->name}");

            return redirect()->route('post.category.index')->with('success', 'Post category updated successfully');
        } catch (\Exception $e) {

            return redirect()->route('post.category.index')->with('error', 'Failed to update post category: ' . $e->getMessage());
        }
    }

    public function destroy(PostCategory $postCategory): RedirectResponse
    {
        try {
            $postCategory->delete();

            activity('post_category_management')
                ->causedBy(Auth::user())
                ->log("Deleted post category: {$postCategory->name}");

            return redirect()->route('post.category.index')->with('success', 'Post category deleted successfully');
        } catch (\Exception $e) {
            return redirect()->route('post.index')->with('error', 'Failed to delete post category: ' . $e->getMessage());
        }
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

    public function getFilteredPostCategories(array $filters)
    {
        $user = Auth::user();

        if ($user->roles[0]->name === "Master") {
            return PostCategory::filter($filters);
        } else {
            return PostCategory::where('user_id', $user->id)->filter($filters);
        }
    }
}
