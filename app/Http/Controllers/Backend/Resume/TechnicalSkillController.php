<?php

namespace App\Http\Controllers\Backend\Resume;

use App\Http\Controllers\Controller;
use App\Models\TechnicalSkill;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class TechnicalSkillController extends Controller
{
    public function index(Request $request): View
    {
        $perPage = $request->input('limit', 10);
        $q = $request->input('q', '');
        $columns = ['name', 'level'];

        $technicalSkills = TechnicalSkill::when($q, function ($query) use ($q, $columns) {
            $query->where(function ($subquery) use ($q, $columns) {
                foreach ($columns as $column) {
                    $subquery->orWhere($column, 'LIKE', "%$q%");
                }
            });
        })
        ->paginate($perPage);

        return view('backend.resume.skills.technical.index', [
            'title' => 'Technical Skill',
            'technicalSkills' => $technicalSkills,
            'perPage' => $perPage,
            'q' => $q,
        ]);
    }

    public function create(): View 
    {
        return view('backend.resume.skills.technical.create', [
            'title' => 'New Technical Skill',
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'technical_skill_name' => 'required|string|max:255',
            'level' => 'required|string|in:Beginner,Intermediate,Advanced|max:255',
        ]);

        TechnicalSkill::create([
            'name' => $request->technical_skill_name,
            'level' => $request->level
        ]);

        return redirect()->route('skill.technical.index')->with('success', 'Technical skill created successfully');
    }

    public function edit(TechnicalSkill $technicalSkill): View 
    {
        return view('backend.resume.skills.technical.edit', [
            'title' => 'Edit Technical Skill',
            'technicalSkill' => $technicalSkill,
        ]);
    }

    public function update(Request $request, TechnicalSkill $technicalSkill): RedirectResponse
    {
        $request->validate([
            'technical_skill_name' => 'required|string|max:255',
            'level' => 'required|string|in:Beginner,Intermediate,Advanced|max:255',
        ]);

        $technicalSkill->update([
            'name' => $request->technical_skill_name,
            'level' => $request->level
        ]);

        return redirect()->route('skill.technical.index')->with('success', 'Technical skill updated successfully');
    }

    public function destroy(TechnicalSkill $technicalSkill): RedirectResponse
    {
        $technicalSkill->delete();

        return redirect()->route('skill.technical.index')->with('success', 'Technical skill deleted successfully');
    }
}
