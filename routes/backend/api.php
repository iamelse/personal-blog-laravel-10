<?php

use App\Http\Controllers\Backend\PostCategoryController;
use App\Http\Controllers\Backend\PostController;
use App\Http\Controllers\Backend\ProjectController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::prefix('post-category')->group(function () {
    Route::put('/update-category-visibility', [PostCategoryController::class, 'updateVisibility'])->name('api.post.category.updateVisibility');
});

Route::get('/post/check-slug', [PostController::class, 'checkSlug'])->name('api.post.check.slug');

Route::get('/post-category/check-slug', [PostCategoryController::class, 'checkSlug'])->name('api.post.category.check.slug');

Route::get('/project/check-slug', [ProjectController::class, 'checkSlug'])->name('api.backend.project.check.slug');