<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\About;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AboutController extends Controller
{
    public function index(): View
    {
        $about = About::first();
        
        return view('frontend.about.index', [
            'title' => 'About',
            'about' => $about
        ]);
    }
}
