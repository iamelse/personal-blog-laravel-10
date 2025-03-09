<?php

namespace App\Http\Controllers\Web\BackEnd;

use App\Http\Controllers\Controller;
use App\Http\Requests\Web\UserProfile\UpdatePasswordRequest;
use App\Http\Requests\Web\UserProfile\UpdateUserProfileRequest;
use App\Models\User;
use App\Services\ImageManagementService;
use FFI\Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;

class UserProfileController extends Controller
{
    public function __construct(
        protected ImageManagementService $imageManagementService
    ) {}
    
    public function edit(): View
    {
        $user = Auth::user();

        return view('pages.profile.edit', [
            'title' => 'Profile | ' .  Auth::user()->name,
            'user' => $user
        ]);
    }

    public function update(UpdateUserProfileRequest $request)
    {
        try {
            $user = User::findOrfail(Auth::user()->id);

            $user->update([
                'name' => $request->name,
                'username' => $request->username,
                'email' => $request->email,
                'image' => $this->_handleImageUpload($request, $user)
            ]);

            return redirect()->route('be.user.profile.edit', $user->username)
                ->with('success', 'Profile updated successfully.');
        } catch (Exception $exception) {
            Log::error('User update failed: ' . $exception->getMessage());

            return redirect()->route('be.user.profile.edit', $user->username ?? $request->username)
                ->with('error', 'Failed to update profile. Please try again.');
        }
    }

    public function updatePassword(UpdatePasswordRequest $request)
    {
        try {
            $user = User::findOrfail(Auth::user()->id);

            if (!$user) {
                return back()->with('error', 'Unauthorized action.');
            }

            // Check if the current password is correct
            if (!Hash::check($request->current_password, $user->password)) {
                return back()->withErrors(['current_password' => 'Current password is incorrect.'])->withInput();
            }

            // Update password inside a transaction (optional, but ensures atomicity)
            DB::transaction(function () use ($user, $request) {
                $user->update([
                    'password' => Hash::make($request->new_password),
                ]);
            });

            return back()->with('success', 'Password updated successfully.');
        } catch (Exception $exception) {
            Log::error('Password update failed: ' . $exception->getMessage());

            return back()->with('error', 'Failed to update password. Please try again.');
        }
    }

    private function _handleImageUpload($request, $user)
    {
        $imagePath = null;

        if ($request->has('remove_image') && $request->remove_image == 1) {
            $this->imageManagementService->destroyImage($user->image);
    
            $user->image = null;
            return null;
        }

        if ($request->hasFile('image')) {
            $image = $request->file('image');

            $imagePath = $this->imageManagementService->uploadImage($image, [
                'currentImagePath' => $user->image,
                'disk' => env('FILESYSTEM_DISK'),
                'folder' => 'uploads/user_profiles'
            ]);

            $user->image = $imagePath;
        }

        return $imagePath;
    }
}
