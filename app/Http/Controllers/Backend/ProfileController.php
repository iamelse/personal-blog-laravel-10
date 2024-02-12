<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class ProfileController extends Controller
{
    public function index(): View
    {
        return view('backend.profile',[
            'title' => 'My Profile',
            'user' => auth()->user()
        ]);
    }

    public function update(Request $request): RedirectResponse
    {
        $request->validate([
            'image_profile' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . Auth::id(),
        ]);

        $user = Auth::user();

        if ($request->hasFile('image_profile')) {
            $imageProfile = $request->file('image_profile');
            $imageProfileName = time() . '.' . $imageProfile->getClientOriginalExtension();
            $imageProfileDirectory = 'uploads/user_profiles';
            $imageProfile->move(public_path($imageProfileDirectory), $imageProfileName);
        
            if (!empty($user->image_profile)) {
                $oldImageProfilePath = public_path($user->image_profile);
                if (File::exists($oldImageProfilePath)) {
                    File::delete($oldImageProfilePath);
                }
            }
        
            $user->image_profile = $imageProfileDirectory . '/' . $imageProfileName;
            $user->name = $request->name;
            $user->username = $request->username;
            $user->email = $request->email;
            $user->save();
        } else {
            $user->name = $request->name;
            $user->username = $request->username;
            $user->email = $request->email;
            $user->save();
        }        

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

        return redirect()->route('profile.index')->with('success', 'Password updated successfully');
    }
}
