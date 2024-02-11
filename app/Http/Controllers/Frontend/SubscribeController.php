<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SubscribeController extends Controller
{
    public function index(): View
    {
        return view('frontend.subscribe.index', [
            'title' => 'Subscribe',
        ]);
    }
}
