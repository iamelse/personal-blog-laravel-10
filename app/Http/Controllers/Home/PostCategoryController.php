<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\PostCategory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

class PostCategoryController extends Controller
{
    private function generateUniqueSlug(String $name): String
    {
        $slug = Str::slug($name);
        $counter = 1;

        while (PostCategory::where('slug', $slug)->exists()) {
            $slug = Str::slug($name) . '-' . $counter++;
        }

        return $slug;
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

        return view('dashboard.post_category.index', [
            'title' => 'Post Category',
            'postCategories' => $postCategories,
            'perPage' => $perPage,
            'q' => $q,
        ]);
    }

    public function create(): View 
    {
        $categoryId = uniqid();

        return view('dashboard.post_category.create', [
            'title' => 'New Category',
            'categoryId' => $categoryId
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'category_name' => 'required|string|max:255'
        ]);

        PostCategory::create([
            'name' => $request->category_name,
            'slug' => $this->generateUniqueSlug($request->category_name)
        ]);

        return redirect()->route('post.category.index')->with('success', 'Post category created successfully');
    }

    public function edit(PostCategory $postCategory): View 
    {
        return view('dashboard.post_category.edit', [
            'title' => 'Edit Category',
            'postCategory' => $postCategory
        ]);
    }

    public function update(Request $request, PostCategory $postCategory): RedirectResponse
    {
        $request->validate([
            'category_name' => 'required|string|max:255'
        ]);

        $postCategory->update([
            'name' => $request->category_name,
            'slug' => $this->generateUniqueSlug($request->category_name)
        ]);

        return redirect()->route('post.category.index')->with('success', 'Post category updated successfully');
    }

    public function destroy(PostCategory $postCategory): RedirectResponse
    {
        $postCategory->delete();

        return redirect()->route('post.category.index')->with('success', 'Post category deleted successfully');
    }
}
