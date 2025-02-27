<?php

use App\Http\Controllers\Web\Auth\LoginController;
use App\Http\Controllers\Web\FrontEnd\AboutController;
use App\Http\Controllers\Web\FrontEnd\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('fe.home.index');
Route::get('/about', [AboutController::class, 'index'])->name('fe.about.index');


Route::prefix('auth')->group(function () {

    Route::get('/login', [LoginController::class, 'index'])->name('auth.login')->middleware('is.guest');
    Route::post('/login', [LoginController::class, 'login'])->name('auth.do.login')->middleware('is.guest');

    Route::post('/logout', [LoginController::class, 'logout'])->name('auth.logout')->middleware('is.auth');

    // Forgot Password Routes
    //Route::get('/forgot-password', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('auth.password.request');
    //Route::post('/forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('auth.password.email');

    // Reset Password Routes
    //Route::get('/reset-password/{token}', [ResetPasswordController::class, 'showResetForm'])->name('auth.password.reset');
    //Route::post('/reset-password', [ResetPasswordController::class, 'reset'])->name('auth.password.update');
});


include __DIR__ . '/web/backend/web.php';