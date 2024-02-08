<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Home\DashboardController;
use App\Http\Controllers\Home\PermissionController;
use App\Http\Controllers\Home\RoleController;
use App\Http\Controllers\Home\PostCategoryController;
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

Route::get('/article', function () {
    return view('frontend.article');
});

Route::get('/a-post', function () {
    return view('frontend.a-post');
});

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login')->middleware('guest');
Route::post('/authenticate', [LoginController::class, 'authenticate'])->name('authenticate')->middleware('guest');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::group(['middleware' => ['auth']], function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::prefix('post-category')->group(function () {
        Route::get('/', [PostCategoryController::class, 'index'])->name('post.category.index');
        Route::get('/search', [PostCategoryController::class, 'index'])->name('post.category.search');
        Route::get('/create', [PostCategoryController::class, 'create'])->name('post.category.create');
        Route::post('/store', [PostCategoryController::class, 'store'])->name('post.category.store');
        Route::get('/edit/{postCategory}', [PostCategoryController::class, 'edit'])->name('post.category.edit');
    });

    Route::prefix('role')->group(function () {
        Route::get('/', [RoleController::class, 'index'])->name('role.index');
        Route::get('/search', [RoleController::class, 'index'])->name('role.search');
        Route::get('/show/{role}', [RoleController::class, 'show'])->name('role.show');
        Route::post('/show/{role}/store/permission', [RoleController::class, 'updateRolePermissions'])->name('role.store.permissions');
    });

    Route::prefix('permission')->group(function () {
        Route::get('/', [PermissionController::class, 'index'])->name('permission.index');
        Route::get('/create', [PermissionController::class, 'create'])->name('permission.create');
        Route::post('/store', [PermissionController::class, 'store'])->name('permission.store');
    });
});
