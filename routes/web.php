<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Backend\InitialSetupController;
use Illuminate\Support\Facades\Artisan;
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

Route::get('/setup', [InitialSetupController::class, 'showInitialSetupPage'])->name('initial.setup');
Route::post('/setup/migrate', [InitialSetupController::class, 'runInitialMigrations'])->name('initial.setup.migrate');
Route::post('/setup/seed', [InitialSetupController::class, 'runInitialSeeder'])->name('initial.setup.seed');

Route::get('/login', [LoginController::class, 'showLoginForm'])->middleware(['check.initial.setup'])->name('login')->middleware('guest');
Route::post('/authenticate', [LoginController::class, 'authenticate'])->name('authenticate')->middleware('guest');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'auth', 'can:go_to_laravel_filemanager'], 'as' => 'laravel-filemanager.'], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});

include __DIR__.'/backend/web.php';
include __DIR__.'/frontend/web.php';
