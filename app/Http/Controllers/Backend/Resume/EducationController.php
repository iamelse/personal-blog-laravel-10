<?php

namespace App\Http\Controllers\Backend\Resume;

use App\Http\Controllers\Controller;
use App\Models\Education;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class EducationController extends Controller
{
    public function index(Request $request): View
    {
        $perPage = $request->input('limit', 10);
        $q = $request->input('q', '');
        $columns = ['major', 'school_name', 'degree'];

        $educations = Education::when($q, function ($query) use ($q, $columns) {
            $query->where(function ($subquery) use ($q, $columns) {
                foreach ($columns as $column) {
                    $subquery->orWhere($column, 'LIKE', "%$q%");
                }
            });
        })
        ->orderByRaw('end_date IS NULL DESC, end_date DESC')
        ->paginate($perPage);

        activity('education_management')
            ->causedBy(Auth::user())
            ->log('Accessed education index.');

        return view('backend.resume.education.index', [
            'title' => 'Education',
            'educations' => $educations,
            'perPage' => $perPage,
            'q' => $q,
        ]);
    }

    public function create(): View
    {
        activity('education_management')
            ->causedBy(Auth::user())
            ->log('Accessed create education page.');

        return view('backend.resume.education.create', [
            'title' => 'New Education'
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'school_logo_size' => 'nullable|string',
            'school_logo' => 'required|image|mimes:jpeg,png,jpg,gif',
            'major' => 'required|string',
            'degree' => 'required|string',
            'school_name' => 'required|string',
            'desc' => 'required|string',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after:start_date',
        ]);

        if ($request->hasFile('school_logo')) {
            $file = $request->file('school_logo');
            $fileName = time() . '.' . $file->getClientOriginalExtension();

            $educationDirectory = 'uploads/educations/school_logos';
            $file->move(public_path($educationDirectory), $fileName);

            $education = Education::create([
                'school_logo_size' => $request->school_logo_size ?? 2.5,
                'school_logo' => $educationDirectory . '/' . $fileName,
                'major' => $request->major,
                'degree' => $request->degree,
                'school_name' => $request->school_name,
                'desc' => $request->desc,
                'start_date' => Carbon::parse($request->start_date)->format('Y-m-d H:i:s'),
                'end_date' => $request->is_still_work_here ? null : ($request->end_date ? Carbon::parse($request->end_date)->format('Y-m-d H:i:s') : null),
            ]);

            activity('education_management')
                ->causedBy(Auth::user())
                ->log("Created education: {$request->degree} in {$request->major} at {$request->school_name}");

            return redirect()->route('education.index')->with('success', 'Education created successfully');
        }

        return redirect()->route('education.index')->with('error', 'Education create failed');
    }

    public function edit(Education $education): View
    {
        activity('education_management')
            ->causedBy(Auth::user())
            ->log("Accessed edit page for education: {$education->degree} in {$education->major}");

        return view('backend.resume.education.edit', [
            'title' => 'Edit Education',
            'education' => $education
        ]);
    }

    public function update(Request $request, Education $education): RedirectResponse
    {
        $request->validate([
            'school_logo_size' => 'nullable|string',
            'school_logo' => 'nullable|image|mimes:jpeg,png,jpg,gif',
            'major' => 'required|string',
            'degree' => 'required|string',
            'school_name' => 'required|string',
            'desc' => 'required|string',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after:start_date',
        ]);

        $data = [
            'school_logo_size' => $request->school_logo_size ?? 2.5,
            'major' => $request->major,
            'degree' => $request->degree,
            'school_name' => $request->school_name,
            'desc' => $request->desc,
            'start_date' => Carbon::parse($request->start_date)->format('Y-m-d H:i:s'),
            'end_date' => $request->is_still_work_here ? null : ($request->end_date ? Carbon::parse($request->end_date)->format('Y-m-d H:i:s') : null),
        ];

        if ($request->hasFile('school_logo')) {
            $file = $request->file('school_logo');
            $fileName = time() . '.' . $file->getClientOriginalExtension();

            $educationDirectory = 'uploads/educations/school_logos';
            $file->move(public_path($educationDirectory), $fileName);

            if (!empty($education->school_logo)) {
                $oldSchoolLogoPath = public_path($education->school_logo);
                File::delete($oldSchoolLogoPath);
            }

            $data['school_logo'] = $educationDirectory . '/' . $fileName;
        }

        $education->update($data);

        activity('education_management')
            ->causedBy(Auth::user())
            ->log("Updated education: {$education->degree} in {$education->major}");

        return redirect()->route('education.index')->with('success', 'Education updated successfully');
    }

    public function destroy(Education $education): RedirectResponse
    {
        if (!empty($education->school_logo)) {
            $schoolLogo = public_path($education->school_logo);
            if (File::exists($schoolLogo)) {
                File::delete($schoolLogo);
            }
        }

        $educationTitle = "{$education->degree} in {$education->major}"; // Store title for logging
        $education->delete();

        activity('education_management')
            ->causedBy(Auth::user())
            ->log("Deleted education: {$educationTitle}");

        return redirect()->route('education.index')->with('success', 'Education deleted successfully');
    }
}
