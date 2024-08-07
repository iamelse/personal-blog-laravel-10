<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProjectController extends Controller
{
    public function checkSlug(Request $request): JsonResponse
    {
        $slug = SlugService::createSlug(Project::class, 'slug', $request->title);

        return response()->json(['slug' => $slug]);
    }

    public function index(Request $request): View
    {
        $perPage = $request->input('limit', 10);
        $q = $request->input('q', '');
        $columns = ['title', 'slug'];

        $query = Project::orderBy('created_at', 'desc')
            ->when($q, function ($query) use ($q, $columns) {
                $query->where(function ($subquery) use ($q, $columns) {
                    foreach ($columns as $column) {
                        $subquery->orWhere($column, 'LIKE', "%$q%");
                    }
                });
            });

        $projects = $query->paginate($perPage);

        return view('backend.project.index', [
            'title' => 'Project',
            'projects' => $projects,
            'perPage' => $perPage,
            'q' => $q,
        ]);
    }

    public function create(): View 
    {
        return view('backend.project.create', [
            'title' => 'New Project',
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:projects',
            'content' => 'required'
        ]);

        Project::create([
            'title' => $request->title,
            'slug' => $request->slug,
            'desc' => $request->content
        ]);

        return redirect()->route('backend.project.index')->with('success', 'Project created successfully');
    }

    public function edit(Project $project): View 
    {
        return view('backend.project.edit', [
            'title' => 'Edit Project',
            'project' => $project
        ]);
    }

    public function update(Request $request, Project $project): RedirectResponse
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:projects,slug,' . $project->id,
            'content' => 'required'
        ]);

        $project->update([
            'title' => $request->title,
            'slug' => $request->slug,
            'desc' => $request->content
        ]);

        return redirect()->route('backend.project.index')->with('success', 'Project updated successfully');
    }

    public function destroy(Project $project): RedirectResponse
    {
        $project->delete();

        return redirect()->route('backend.project.index')->with('success', 'Project deleted successfully');
    }
}
