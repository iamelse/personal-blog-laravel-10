<?php

use App\Http\Controllers\Web\Auth\LoginController;
use App\Http\Controllers\Web\DashboardController;
use App\Http\Controllers\Web\FrontEnd\AboutController;
use App\Http\Controllers\Web\FrontEnd\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('fe.home.index');
Route::get('/about', [AboutController::class, 'index'])->name('fe.about.index');

Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');
