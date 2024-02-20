<?php

namespace App\Http\Controllers\Backend\Resume;

use App\Http\Controllers\Controller;
use App\Models\LanguageSkill;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
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

        return view('backend.resume.skills.language.index', [
            'title' => 'Language Skill',
            'languageSkills' => $languageSkills,
            'perPage' => $perPage,
            'q' => $q,
        ]);
    }

    public function create(): View 
    {
        return view('backend.resume.skills.language.create', [
            'title' => 'New Language Skill',
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'language_skill_name' => 'required|string|max:255',
            'level' => 'required|string|in:Beginner,Intermediate,Advanced|max:255',
        ]);

        LanguageSkill::create([
            'name' => $request->language_skill_name,
            'level' => $request->level
        ]);

        return redirect()->route('skill.language.index')->with('success', 'Language skill created successfully');
    }

    public function edit(LanguageSkill $languageSkill): View 
    {
        return view('backend.resume.skills.language.edit', [
            'title' => 'Edit Language Skill',
            'languageSkill' => $languageSkill,
        ]);
    }

    public function update(Request $request, LanguageSkill $languageSkill): RedirectResponse
    {
        $request->validate([
            'language_skill_name' => 'required|string|max:255',
            'level' => 'required|string|in:Beginner,Intermediate,Advanced|max:255',
        ]);

        $languageSkill->update([
            'name' => $request->language_skill_name,
            'level' => $request->level
        ]);

        return redirect()->route('skill.language.index')->with('success', 'Language skill updated successfully');
    }

    public function destroy(LanguageSkill $languageSkill): RedirectResponse
    {
        $languageSkill->delete();

        return redirect()->route('skill.language.index')->with('success', 'Language skill deleted successfully');
    }
}
