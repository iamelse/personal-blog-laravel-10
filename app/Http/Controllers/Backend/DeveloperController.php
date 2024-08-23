<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;
use Illuminate\Support\Facades\File;

class DeveloperController extends Controller
{
    public function index(): View
    {
        $commands = [
            'php artisan migrate',
            'php artisan migrate:fresh',
            'php artisan migrate:fresh --seed',
            'php artisan db:seed',
            'php artisan db:seed --class=YourClassName'
        ];

        $path = database_path('seeders');
        $files = File::files($path);

        $seeders = array_map(function ($file) {
            return pathinfo($file, PATHINFO_FILENAME);
        }, $files);

        return view('backend.developer.index', [
            'title' => 'Developer',
            'commands' => $commands,
            'seeders' => $seeders
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

    public function factoryCodeRunner(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'code' => 'required|string'
        ]);

        $code = $validated['code'];

        Log::info('Received command', ['code' => $code]);

        switch ($code) {
            case 'php artisan migrate':
                Log::info('Executing command: migrate');
                Artisan::call('migrate');
                Log::info('Command executed successfully: migrate');
                break;

            case 'php artisan migrate:fresh':
                Log::info('Executing command: migrate:fresh');
                Artisan::call('migrate:fresh');
                Log::info('Command executed successfully: migrate:fresh');
                break;

            case 'php artisan migrate:fresh --seed':
                Log::info('Executing command: migrate:fresh --seed');
                Artisan::call('migrate:fresh', ['--seed' => true]);
                Log::info('Command executed successfully: migrate:fresh --seed');
                break;

            case 'php artisan db:seed':
                Log::info('Executing command: db:seed');
                Artisan::call('db:seed');
                Log::info('Command executed successfully: db:seed');
                break;

            default:
                if (preg_match('/^php artisan db:seed --class=([\w\\\]+)$/', $code, $matches)) {
                    $class = $matches[1];
                    Log::info('Executing command: db:seed --class', ['class' => $class]);
                    Artisan::call('db:seed', ['--class' => $class]);
                    Log::info('Command executed successfully: db:seed --class', ['class' => $class]);
                } else {
                    Log::error('Invalid command received', ['code' => $code]);
                    return redirect()->back()->withErrors(['Invalid command']);
                }
                break;
        }

        Log::info('Redirecting after command execution');
        return redirect()->back()->with('status', 'Command executed successfully');
    }
}
