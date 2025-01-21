<?php

use App\Http\Controllers\Frontend\AboutController;
use App\Http\Controllers\Frontend\ArticleController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\ProjectController;
use App\Http\Controllers\Frontend\ResumeController;
use App\Http\Controllers\Frontend\SubscribeController;
use Illuminate\Support\Facades\Route;

Route::middleware(['check.initial.setup'])->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('home.index');

    Route::get('/about', [AboutController::class, 'index'])->name('about.index');

    Route::prefix('project')->group(function () {
        Route::get('/', [ProjectController::class, 'index'])->name('project.index');
        Route::get('/{slug}', [ProjectController::class, 'show'])->name('project.show');
    });

    Route::get('/resume', [ResumeController::class, 'index'])->name('resume.index');

    Route::get('/subscribe', [SubscribeController::class, 'index'])->name('subscribe.index');

    Route::prefix('article')->group(function () {
        Route::get('/search', [ArticleController::class, 'searchAnArticle'])->name('article.search');
        Route::get('/', [ArticleController::class, 'index'])->name('article.index');
        Route::get('/archived', [ArticleController::class, 'archived'])->name('article.archived');
        Route::get('/{slug}', [ArticleController::class, 'show'])->middleware(['post.visitor.counter', 'track.visitor'])->name('article.show');
    });
});