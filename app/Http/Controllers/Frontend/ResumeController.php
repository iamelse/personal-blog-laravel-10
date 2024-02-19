<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Education;
use App\Models\Experience;
use App\Models\TechnicalSkill;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ResumeController extends Controller
{
    public function index(): View
    {
        $experiences = Experience::orderByRaw('end_date IS NULL DESC, end_date DESC')->get();
        $educations =  Education::orderByRaw('end_date IS NULL DESC, end_date DESC')->get();
        $technicalSkills = TechnicalSkill::all();
        
        return view('frontend.resume.index', [
            'title' => 'Resume',
            'experiences' => $experiences,
            'educations' => $educations,
            'technicalSkills' => $technicalSkills
        ]);
    }
}
