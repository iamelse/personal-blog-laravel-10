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
        $data = [];
        $user = Auth::user();

        $radioValue = $request->input('radioType');

        switch ($radioValue) {
            case 'image':
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
                break;            

            case 'url':
                $imageManagementService->destroyImage($home->image);

                $data['url'] = $request->input('urlLink');

                Home::updateOrCreate([], [
                    'image' => null,
                    'url' => $data['url'],
                ]);

                activity('home_url_update')
                    ->causedBy($user)
                    ->withProperties(['url' => $data['url']])
                    ->log("Updated the home URL.");
                
                break;

            case 'removeImage':
                $imageManagementService->destroyImage($home->image);

                Home::updateOrCreate([], [
                    'image' => null,
                    'url' => null,
                ]);

                activity('home_image_remove')
                    ->causedBy($user)
                    ->log("Removed the home image.");

                break;

            default:
                break;
        }

        return redirect()->route('backend.home.index')->with('success', 'Home updated successfully');
    }
}