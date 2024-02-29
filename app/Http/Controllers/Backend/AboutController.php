<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\About;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AboutController extends Controller
{
    public function index(): View
    {
        $about = About::first();

        return view('backend.about.index',[
            'title' => 'About',
            'about' => $about
        ]);
    }

    public function update(Request $request): RedirectResponse
    {
        $request->validate([
            'content' => 'required',
        ]);

        About::updateOrCreate(
            [],
            ['body' => $request->content]
        );

        return redirect()->route('backend.about.index')->with('success', 'About updated successfully');
    }

}
