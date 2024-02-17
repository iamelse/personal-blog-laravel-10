<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Experience;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ResumeController extends Controller
{
    public function index(): View
    {
        $experiences = Experience::orderByRaw('end_date IS NULL DESC, end_date DESC')->get();
        
        return view('frontend.resume.index', [
            'title' => 'Resume',
            'experiences' => $experiences
        ]);
    }
}
