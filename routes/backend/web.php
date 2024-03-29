<?php

use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\PermissionController;
use App\Http\Controllers\Backend\RoleController;
use App\Http\Controllers\Backend\PostCategoryController;
use App\Http\Controllers\Backend\PostController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['auth']], function () {
    Route::prefix('backend')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        Route::prefix('post-category')->group(function () {
            Route::get('/', [PostCategoryController::class, 'index'])->name('post.category.index');
            Route::get('/search', [PostCategoryController::class, 'index'])->name('post.category.search');
            Route::get('/create', [PostCategoryController::class, 'create'])->name('post.category.create');
            Route::post('/store', [PostCategoryController::class, 'store'])->name('post.category.store');
            Route::get('/edit/{postCategory}', [PostCategoryController::class, 'edit'])->name('post.category.edit');
            Route::put('/update/{postCategory}', [PostCategoryController::class, 'update'])->name('post.category.update');
            Route::delete('/destroy/{postCategory}', [PostCategoryController::class, 'destroy'])->name('post.category.destroy');
        });

        Route::prefix('post')->group(function () {
            Route::get('/', [PostController::class, 'index'])->name('post.index');
            Route::get('/search', [PostController::class, 'index'])->name('post.search');
            Route::get('/create', [PostController::class, 'create'])->name('post.create');
            Route::post('/store', [PostController::class, 'store'])->name('post.store');
            Route::get('/edit/{post}', [PostController::class, 'edit'])->name('post.edit');
            Route::put('/update/{post}', [PostController::class, 'update'])->name('post.update');
            Route::delete('/destroy/{post}', [PostController::class, 'destroy'])->name('post.destroy');
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
});