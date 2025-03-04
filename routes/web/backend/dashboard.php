<?php

use App\Http\Controllers\Web\BackEnd\DashboardController;
use Illuminate\Support\Facades\Route;

Route::get('/dashboard', [DashboardController::class, 'index'])->name('be.dashboard.index');