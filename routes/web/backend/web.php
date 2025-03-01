<?php

use App\Http\Controllers\Web\BackEnd\DashboardController;
use App\Http\Controllers\Web\BackEnd\RoleController;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->middleware('is.auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('be.dashboard.index');

    Route::get('/role', [RoleController::class, 'index'])->name('be.role.and.permission.index');
});