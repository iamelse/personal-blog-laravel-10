<?php

namespace App\Http\Controllers\Web\BackEnd;

use App\Http\Controllers\Controller;
use App\Http\Requests\Web\UserProfile\UpdatePasswordRequest;
use App\Http\Requests\Web\UserProfile\UpdateUserProfileRequest;
use App\Models\User;
use FFI\Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;

class UserProfileController extends Controller
{
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

            if (!$user) {
                return redirect()->route('be.user.profile.edit', $request->username)
                    ->with('error', 'Unauthorized action.');
            }

            $user->update([
                'name' => $request->name,
                'username' => $request->username,
                'email' => $request->email,
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
}
