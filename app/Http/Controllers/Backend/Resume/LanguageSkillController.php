<?php

namespace App\Http\Controllers\Backend\Resume;

use App\Http\Controllers\Controller;
use App\Http\Requests\LanguageSkillStoreRequest;
use App\Http\Requests\LanguageSkillUpdateRequest;
use App\Models\LanguageSkill;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class LanguageSkillController extends Controller
{
    public function index(Request $request): View
    {
        $perPage = $request->input('limit', 10);
        $q = $request->input('q', '');
        $columns = ['name', 'level'];

        $languageSkills = LanguageSkill::when($q, function ($query) use ($q, $columns) {
            $query->where(function ($subquery) use ($q, $columns) {
                foreach ($columns as $column) {
                    $subquery->orWhere($column, 'LIKE', "%$q%");
                }
            });
        })
        ->paginate($perPage);

        activity('language_skill_management')
            ->causedBy(Auth::user())
            ->log('Accessed language skill index.');

        return view('backend.resume.skills.language.index', [
            'title' => 'Language Skill',
            'languageSkills' => $languageSkills,
            'perPage' => $perPage,
            'q' => $q,
        ]);
    }

    public function create(): View
    {
        activity('language_skill_management')
            ->causedBy(Auth::user())
            ->log('Accessed create language skill page.');

        return view('backend.resume.skills.language.create', [
            'title' => 'New Language Skill',
        ]);
    }

    public function store(LanguageSkillStoreRequest $request): RedirectResponse
    {
        $languageSkill = LanguageSkill::create([
            'name' => $request->language_skill_name,
            'level' => $request->level,
        ]);

        activity('language_skill_management')
            ->causedBy(Auth::user())
            ->log("Created language skill: {$languageSkill->name} ({$languageSkill->level})");

        return redirect()->route('skill.language.index')->with('success', 'Language skill created successfully');
    }

    public function edit(LanguageSkill $languageSkill): View
    {
        activity('language_skill_management')
            ->causedBy(Auth::user())
            ->log("Accessed edit page for language skill: {$languageSkill->name}");

        return view('backend.resume.skills.language.edit', [
            'title' => 'Edit Language Skill',
            'languageSkill' => $languageSkill,
        ]);
    }

    public function update(LanguageSkillUpdateRequest $request, LanguageSkill $languageSkill): RedirectResponse
    {
        $languageSkill->update([
            'name' => $request->language_skill_name,
            'level' => $request->level,
        ]);

        activity('language_skill_management')
            ->causedBy(Auth::user())
            ->log("Updated language skill: {$languageSkill->name} to level {$languageSkill->level}");

        return redirect()->route('skill.language.index')->with('success', 'Language skill updated successfully');
    }

    public function destroy(LanguageSkill $languageSkill): RedirectResponse
    {
        activity('language_skill_management')
            ->causedBy(Auth::user())
            ->log("Deleted language skill: {$languageSkill->name}");

        $languageSkill->delete();

        return redirect()->route('skill.language.index')->with('success', 'Language skill deleted successfully');
    }
}
