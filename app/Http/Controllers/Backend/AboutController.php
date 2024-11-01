<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\AboutUpdateRequest;
use App\Models\About;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AboutController extends Controller
{
    public function index(): View
    {
        $about = About::first();
        $user = Auth::user();

        activity('backend_home_index')
            ->causedBy($user)
            ->log("Accessed the CMS about.");

        return view('backend.about.index', [
            'title' => 'About',
            'about' => $about
        ]);
    }

    public function update(AboutUpdateRequest $request): RedirectResponse
    {
        About::updateOrCreate(
            [],
            ['body' => $request->content]
        );

        $user = Auth::user();

        activity('about_update')
            ->causedBy($user)
            ->withProperties(['content' => $request->content])
            ->log("Updated the about content.");

        return redirect()->route('backend.about.index')->with('success', 'About updated successfully');
    }
}