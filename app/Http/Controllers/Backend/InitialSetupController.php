<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

class InitialSetupController extends Controller
{
    public function showInitialSetupPage()
    {
        return view('welcome');
    }

    public function runInitialMigrations()
    {
        try {
            Artisan::call('migrate:fresh', ['--force' => true]);
            return response()->json([
                'success' => true
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ]);
        }
    }

    public function runInitialSeeder()
    {
        try {
            Artisan::call('db:seed', ['--force' => true, '--class' => 'InitialSeeder']);
            return response()->json([
                'success' => true
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ]);
        }
    }
}
