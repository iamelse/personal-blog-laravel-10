<?php

namespace App\Http\Controllers\Backend\Resume;

use App\Http\Controllers\Controller;
use App\Http\Requests\TechnicalSkillStoreRequest;
use App\Models\TechnicalSkill;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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

        activity('technical_skill_management')
            ->causedBy(Auth::user())
            ->log('Accessed technical skill index.');

        return view('backend.resume.skills.technical.index', [
            'title' => 'Technical Skill',
            'technicalSkills' => $technicalSkills,
            'perPage' => $perPage,
            'q' => $q,
        ]);
    }

    public function create(): View
    {
        activity('technical_skill_management')
            ->causedBy(Auth::user())
            ->log('Accessed create technical skill page.');

        return view('backend.resume.skills.technical.create', [
            'title' => 'New Technical Skill',
        ]);
    }

    public function store(TechnicalSkillStoreRequest $request): RedirectResponse
    {
        $technicalSkill = TechnicalSkill::create([
            'name' => $request->technical_skill_name,
            'level' => $request->level,
        ]);

        activity('technical_skill_management')
            ->causedBy(Auth::user())
            ->log("Created technical skill: {$technicalSkill->name} ({$technicalSkill->level})");

        return redirect()->route('skill.technical.index')->with('success', 'Technical skill created successfully');
    }

    public function edit(TechnicalSkill $technicalSkill): View
    {
        activity('technical_skill_management')
            ->causedBy(Auth::user())
            ->log("Accessed edit page for technical skill: {$technicalSkill->name}");

        return view('backend.resume.skills.technical.edit', [
            'title' => 'Edit Technical Skill',
            'technicalSkill' => $technicalSkill,
        ]);
    }

    public function update(Request $request, TechnicalSkill $technicalSkill): RedirectResponse
    {
        $technicalSkill->update([
            'name' => $request->technical_skill_name,
            'level' => $request->level,
        ]);

        activity('technical_skill_management')
            ->causedBy(Auth::user())
            ->log("Updated technical skill: {$technicalSkill->name} to level {$technicalSkill->level}");

        return redirect()->route('skill.technical.index')->with('success', 'Technical skill updated successfully');
    }

    public function destroy(TechnicalSkill $technicalSkill): RedirectResponse
    {
        activity('technical_skill_management')
            ->causedBy(Auth::user())
            ->log("Deleted technical skill: {$technicalSkill->name}");

        $technicalSkill->delete();

        return redirect()->route('skill.technical.index')->with('success', 'Technical skill deleted successfully');
    }
}
