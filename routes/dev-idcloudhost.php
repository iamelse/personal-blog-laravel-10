<?php

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Carbon\Carbon;

Route::get('/refresh-database', function () {
    $startTime = Carbon::now(); // Start time for execution tracking

    // Get a list of all tables before migration
    $oldTables = Schema::getAllTables();
    
    // Run migration fresh with seed
    Artisan::call('migrate:fresh --seed');

    // Get a list of tables after migration
    $newTables = Schema::getAllTables();
    
    // Get the tables that were created (difference between old and new)
    $createdTables = array_diff(array_column($newTables, 'name'), array_column($oldTables, 'name'));

    $executionTime = $startTime->diffInSeconds(Carbon::now()); // Calculate execution time

    return response()->json([
        'message' => 'Database refreshed successfully!',
        'execution_time' => $executionTime . ' seconds',
        'tables_created' => $createdTables,
    ]);
});