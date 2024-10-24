<?php

namespace App\Http\Controllers\Backend;

use App\Enums\EnumFileSystemDisk;
use App\Http\Controllers\Controller;
use App\Services\ImageManagementService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class ProfileController extends Controller
{
    public function index(): View
    {
        activity('profile_management')
            ->causedBy(Auth::user())
            ->log('Accessed the profile page.');

        return view('backend.profile', [
            'title' => 'My Profile',
            'user' => auth()->user()
        ]);
    }

    public function update(Request $request, ImageManagementService $imageManagementService): RedirectResponse
    {
        $request->validate([
            'image_profile' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . Auth::id(),
        ]);

        $user = Auth::user();
        $currentImagePath = $user->image_profile;

        if ($request->hasFile('image_profile')) {
            $file = $request->file('image_profile');

            $imagePath = $imageManagementService->uploadImage($file, [
                'currentImagePath' => $currentImagePath,
                'disk' => env('FILESYSTEM_DISK'),
                'folder' => 'uploads/user_profiles'
            ]);
            
            $user->image_profile = $imagePath;
        }

        $user->name = $request->name;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->save();

        activity('profile_management')
            ->causedBy(Auth::user())
            ->log('Updated profile information.');

        return redirect()->route('profile.index')->with('success', 'Profile updated successfully');
    }

    public function updatePassword(Request $request): RedirectResponse
    {
        $request->validate([
            'current_password' => 'required|string',
            'new_password' => 'required|string|min:4|confirmed',
        ]);

        $user = Auth::user();

        if (!Hash::check($request->current_password, $user->password)) {
            return redirect()->back()->with('error', 'The current password is incorrect.');
        }

        $user->update([
            'password' => Hash::make($request->new_password),
        ]);

        activity('profile_management')
            ->causedBy(Auth::user())
            ->log('Updated profile password.');

        return redirect()->route('profile.index')->with('success', 'Password updated successfully');
    }
}
