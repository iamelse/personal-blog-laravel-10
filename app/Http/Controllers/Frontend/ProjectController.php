<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProjectController extends Controller
{
    public function index(): View
    {
        $projects = Project::all();

        return view('frontend.project.index', [
            'title' => 'Project',
            'projects' => $projects
        ]);
    }

    public function show($slug): View
    {
        $project = Project::where('slug', $slug)->firstOrFail();

        return view('frontend.project.show', [
            'title' => $project->title,
            'project' => $project,
        ]);
    }
}
