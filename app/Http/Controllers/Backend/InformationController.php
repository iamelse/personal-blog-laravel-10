<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;

class InformationController extends Controller
{
    public function index(): View
    {
        $title = 'Information';

        return view('backend.information.index', [
            'title' => $title
        ]);
    }
}
