<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\SocialMedia\StoreRequest;
use App\Http\Requests\SocialMedia\UpdateRequest;
use App\Models\SocialMedia;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class SocialMediaController extends Controller
{
    public function index(): View
    {
        $socialMedias = SocialMedia::all();

        return view('backend.social_media.index', [
            'title' => 'Social Media',
            'socialMedias' => $socialMedias,
        ]);
    }

    public function create(): View
    {
        return view('backend.social_media.create', [
            'title' => 'Create Social Media',
        ]);
    }

    public function store(StoreRequest $request)
    {
        SocialMedia::create($request->all());

        return redirect()->route('social.media.index')->with('success', 'Social Media created successfully.');
    }

    public function edit(SocialMedia $socialMedia): View
    {
        return view('backend.social_media.edit', [
            'title' => 'Edit Social Media',
            'socialMedia' => $socialMedia,
        ]);
    }

    public function update(UpdateRequest $request, SocialMedia $socialMedia)
    {
        $socialMedia->update($request->all());

        return redirect()->route('social.media.index')->with('success', 'Social Media updated successfully.');
    }

    public function destroy(SocialMedia $socialMedia)
    {
        SocialMedia::findOrFail($socialMedia->id);

        $socialMedia->delete();

        return redirect()->route('social.media.index')->with('success', 'Social Media deleted successfully.');
    }
}
