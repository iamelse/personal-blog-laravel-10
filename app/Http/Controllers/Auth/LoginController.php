<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        $title = "Login";
        
        return view('auth.login', [
            'title' => $title
        ]);
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $request->session()->regenerate();

            // Log the activity
            activity('login')
                ->causedBy($user)
                ->log("{$user->name} logged in to the CMS.");

            return redirect()->route('dashboard')
                ->withSuccess('You have successfully logged in!');
        }

        return back()->withErrors([
            'email' => 'Your provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        $user = Auth::user();

        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Log the logout activity
        if ($user) {
            activity('logout')
                ->causedBy($user)
                ->log("{$user->name} logged out.");
        }

        return redirect()->route('login')
            ->withSuccess('You have logged out successfully!');
    }
}
