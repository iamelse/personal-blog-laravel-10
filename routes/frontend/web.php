<?php

use App\Http\Controllers\Frontend\ArticleController;
use Illuminate\Support\Facades\Route;

Route::prefix('article')->group(function () {
    Route::get('/', [ArticleController::class, 'index'])->name('article.index');
    Route::get('/{slug}', [ArticleController::class, 'show'])->name('article.show');
});