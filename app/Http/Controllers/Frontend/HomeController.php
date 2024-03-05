<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Home;
use Illuminate\Http\Request;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        $home = Home::first();
        
        return view('frontend.home.index', [
            'title' => 'Home',
            'home' => $home
        ]);
    }
}
