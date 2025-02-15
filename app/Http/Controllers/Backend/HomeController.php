<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\HomeUpdateRequest;
use App\Models\Home;
use App\Services\ImageManagementService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        $home = Home::first();
        $user = Auth::user();

        activity('backend_home_index')
            ->causedBy($user)
            ->log("Accessed the CMS home.");

        return view('backend.home.index', [
            'title' => 'Home',
            'home' => $home
        ]);
    }

    public function update(HomeUpdateRequest $request): RedirectResponse
    {
        Home::updateOrCreate([], [
            'body' => $request->content
        ]);

        $user = Auth::user();

        activity('home_update')
            ->causedBy($user)
            ->withProperties(['content' => $request->content])
            ->log("Updated the home content.");

        return redirect()->route('backend.home.index')->with('success', 'Home updated successfully');
    }

    public function updateImage(HomeUpdateRequest $request, ImageManagementService $imageManagementService): RedirectResponse
    {
        $home = Home::first();
        $user = Auth::user();

        if ($request->hasFile('imageInput')) {
            $file = $request->file('imageInput');
            
            $imagePath = $imageManagementService->uploadImage($file, [
                'currentImagePath' => $home->image ?? null,
                'disk' => env('FILESYSTEM_DISK'),
                'folder' => 'uploads/home'
            ]);
    
            Home::updateOrCreate([], [
                'image' => $imagePath,
                'url' => null,
            ]);
    
            activity('home_image_update')
                ->causedBy($user)
                ->withProperties(['image_path' => $imagePath])
                ->log("Updated the home image.");
        }

        return redirect()->route('backend.home.index')->with('success', 'Home updated successfully');
    }
}