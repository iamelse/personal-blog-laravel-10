<?php

use App\Http\Controllers\Backend\PostCategoryController;
use App\Http\Controllers\Backend\PostController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/post/check-slug', [PostController::class, 'checkSlug'])->name('api.post.check.slug');

Route::get('/post-category/check-slug', [PostCategoryController::class, 'checkSlug'])->name('api.post.category.check.slug');