<?php

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Carbon\Carbon;

Route::get('/refresh-database', function () {
    Artisan::call('migrate:fresh --seed');

    return response()->json([
        'message' => 'Database refreshed successfully!',
    ]);
});