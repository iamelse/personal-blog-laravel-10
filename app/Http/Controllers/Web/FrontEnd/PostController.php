<?php

namespace App\Http\Controllers\Web\FrontEnd;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PostController extends Controller
{
    public function index(): View
    {
        return view('pages.frontend.post.index', [
            'title' => 'Post'
        ]);
    }
}
