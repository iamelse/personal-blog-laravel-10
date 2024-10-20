<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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

        activity('project_management')
            ->causedBy(Auth::user())
            ->log('Accessed project index.');

        return view('backend.project.index', [
            'title' => 'Project',
            'projects' => $projects,
            'perPage' => $perPage,
            'q' => $q,
        ]);
    }

    public function create(): View 
    {
        activity('project_management')
            ->causedBy(Auth::user())
            ->log('Accessed create project page.');

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

        $project = Project::create([
            'title' => $request->title,
            'slug' => $request->slug,
            'desc' => $request->content
        ]);

        activity('project_management')
            ->causedBy(Auth::user())
            ->log("Created project: {$project->title}");

        return redirect()->route('backend.project.index')->with('success', 'Project created successfully');
    }

    public function edit(Project $project): View 
    {
        activity('project_management')
            ->causedBy(Auth::user())
            ->log("Accessed edit page for project: {$project->title}");

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

        activity('project_management')
            ->causedBy(Auth::user())
            ->log("Updated project: {$project->title}");

        return redirect()->route('backend.project.index')->with('success', 'Project updated successfully');
    }

    public function destroy(Project $project): RedirectResponse
    {
        $projectTitle = $project->title;
        $project->delete();

        activity('project_management')
            ->causedBy(Auth::user())
            ->log("Deleted project: {$projectTitle}");

        return redirect()->route('backend.project.index')->with('success', 'Project deleted successfully');
    }
}
