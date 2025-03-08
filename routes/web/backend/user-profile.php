<?php

use App\Http\Controllers\Web\BackEnd\UserProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/profile/{user}', [UserProfileController::class, 'edit'])->name('be.user.profile.edit');
Route::put('/profile/{user}', [UserProfileController::class, 'update'])->name('be.user.profile.update');

Route::put('/profile/{user}/password', [UserProfileController::class, 'updatePassword'])->name('be.user.profile.update.password');