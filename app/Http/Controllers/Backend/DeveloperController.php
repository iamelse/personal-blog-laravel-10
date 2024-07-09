<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Artisan;
use Illuminate\View\View;

class DeveloperController extends Controller
{
    public function index(): View
    {
        return view('backend.developer.index',[
            'title' => 'Developer'
        ]);
    }

    public function cacheRoutes(): RedirectResponse
    {
        Artisan::call('route:cache');
        return redirect()->back()->with('success', 'Routes have been cached!');
    }

    public function databaseMigrateFreshAndSeed(): RedirectResponse
    {
        Artisan::call('migrate:fresh', ['--seed' => true]);
        return redirect()->back()->with('success', 'Database has been reset and seeded with dummy data!');
    }
}
