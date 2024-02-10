<?php

use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('frontend.home');
});

Route::get('/about', function () {
    return view('frontend.about');
});

Route::get('/project', function () {
    return view('frontend.project');
});

Route::get('/resume', function () {
    return view('frontend.resume');
});

Route::get('/subscribe', function () {
    return view('frontend.subscribe');
});

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login')->middleware('guest');
Route::post('/authenticate', [LoginController::class, 'authenticate'])->name('authenticate')->middleware('guest');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

include __DIR__.'/backend/web.php';
include __DIR__.'/frontend/web.php';
