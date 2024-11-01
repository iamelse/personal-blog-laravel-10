<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Services\ImageManagementService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class ProfileController extends Controller
{
    public function __construct(
        protected ImageManagementService $imageManagementService
    ) {}

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

    public function destroyProfilePicture() : RedirectResponse
    {
        $user = Auth::user();

        try {
            if ($user->image_profile) {
                $this->imageManagementService->destroyImage($user->image_profile);

                activity('profile_management')
                    ->causedBy($user)
                    ->log("Deleted profile picture for user: {$user->name}");
            }

            $user->image_profile = null;
            $user->save();

            return redirect()->route('profile.index')->with('success', 'Profile picture deleted successfully.');

        } catch (\Exception $e) {
            return redirect()->route('profile.index')->with('error', 'Failed to delete profile picture. Please try again.');
        }
    }
}
