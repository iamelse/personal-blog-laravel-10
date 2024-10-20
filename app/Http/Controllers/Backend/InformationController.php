<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class InformationController extends Controller
{
    public function index(): View
    {
        $title = 'Information';

        activity('information_management')
            ->causedBy(Auth::user())
            ->log('Accessed the information page.');

        return view('backend.information.index', [
            'title' => $title
        ]);
    }
}
