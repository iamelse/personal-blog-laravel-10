<?php

use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\PermissionController;
use App\Http\Controllers\Backend\RoleController;
use App\Http\Controllers\Backend\PostCategoryController;
use App\Http\Controllers\Backend\PostController;
use App\Http\Controllers\Backend\ProfileController;
use App\Http\Controllers\Backend\Resume\EducationController;
use App\Http\Controllers\Backend\Resume\ExperienceController;
use App\Http\Controllers\Backend\Resume\TechnicalSkillController;
use App\Http\Controllers\Backend\UserController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['auth']], function () {
    Route::prefix('backend')->group(function () {
        Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
        Route::put('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
        Route::put('/profile/update-password', [ProfileController::class, 'updatePassword'])->name('profile.update.password');

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
            Route::get('/', [PostController::class, 'index'])->middleware(['can:view_posts'])->name('post.index');
            Route::get('/search', [PostController::class, 'index'])->middleware(['can:view_posts'])->name('post.search');
            Route::get('/create', [PostController::class, 'create'])->middleware(['can:create_posts'])->name('post.create');
            Route::post('/store', [PostController::class, 'store'])->middleware(['can:create_posts'])->name('post.store');
            Route::get('/edit/{post}', [PostController::class, 'edit'])->middleware(['can:edit_posts'])->name('post.edit');
            Route::put('/update/{post}', [PostController::class, 'update'])->middleware(['can:edit_posts'])->name('post.update');
            Route::delete('/destroy/{post}', [PostController::class, 'destroy'])->middleware(['can:destroy_posts'])->name('post.destroy');
        });

        Route::prefix('resume')->group(function () {
            Route::prefix('education')->group(function () {
                Route::get('/', [EducationController::class, 'index'])->name('education.index');
                Route::get('/search', [EducationController::class, 'index'])->name('education.search');
                Route::get('/create', [EducationController::class, 'create'])->name('education.create');
                Route::post('/store', [EducationController::class, 'store'])->name('education.store');
                Route::get('/edit/{education}', [EducationController::class, 'edit'])->name('education.edit');
                Route::put('/update/{education}', [EducationController::class, 'update'])->name('education.update');
                Route::delete('/destroy/{education}', [EducationController::class, 'destroy'])->name('education.destroy');
            });
        });

        Route::prefix('resume')->group(function () {
            Route::prefix('experience')->group(function () {
                Route::get('/', [ExperienceController::class, 'index'])->name('experience.index');
                Route::get('/search', [ExperienceController::class, 'index'])->name('experience.search');
                Route::get('/create', [ExperienceController::class, 'create'])->name('experience.create');
                Route::post('/store', [ExperienceController::class, 'store'])->name('experience.store');
                Route::get('/edit/{experience}', [ExperienceController::class, 'edit'])->name('experience.edit');
                Route::put('/update/{experience}', [ExperienceController::class, 'update'])->name('experience.update');
                Route::delete('/destroy/{experience}', [ExperienceController::class, 'destroy'])->name('experience.destroy');
            });
        });

        Route::prefix('resume')->group(function () {
            Route::prefix('skill')->group(function () {
                Route::prefix('technical')->group(function () { 
                    Route::get('/', [TechnicalSkillController::class, 'index'])->name('skill.technical.index');
                    Route::get('/search', [TechnicalSkillController::class, 'index'])->name('skill.technical.search');
                    Route::get('/create', [TechnicalSkillController::class, 'create'])->name('skill.technical.create');
                    Route::post('/store', [TechnicalSkillController::class, 'store'])->name('skill.technical.store');
                    Route::get('/edit/{technicalSkill}', [TechnicalSkillController::class, 'edit'])->name('skill.technical.edit');
                    Route::put('/update/{technicalSkill}', [TechnicalSkillController::class, 'update'])->name('skill.technical.update');
                    Route::delete('/destroy/{technicalSkill}', [TechnicalSkillController::class, 'destroy'])->name('skill.technical.destroy');
                });
            });
        });

        Route::prefix('role')->group(function () {
            Route::get('/', [RoleController::class, 'index'])->middleware(['can:view_roles'])->name('role.index');
            Route::get('/search', [RoleController::class, 'index'])->middleware(['can:view_roles'])->name('role.search');
            Route::get('/show/{role}', [RoleController::class, 'show'])->middleware(['can:view_detail_roles'])->name('role.show');
            Route::post('/show/{role}/store/permission', [RoleController::class, 'updateRolePermissions'])->middleware(['can:view_detail_roles'])->name('role.store.permissions');
        });

        Route::prefix('permission')->group(function () {
            Route::get('/', [PermissionController::class, 'index'])->name('permission.index');
            Route::get('/create', [PermissionController::class, 'create'])->name('permission.create');
            Route::post('/store', [PermissionController::class, 'store'])->name('permission.store');
        });

        Route::prefix('user')->group(function () {
            Route::get('/', [UserController::class, 'index'])->name('user.index');
            Route::get('/search', [UserController::class, 'index'])->name('user.search');
            Route::get('/create', [UserController::class, 'create'])->name('user.create');
            Route::post('/store', [UserController::class, 'store'])->name('user.store');
            Route::get('/edit/{user}', [UserController::class, 'edit'])->name('user.edit');
            Route::put('/update/{user}', [UserController::class, 'update'])->name('user.update');
            Route::delete('/destroy/{user}', [UserController::class, 'destroy'])->name('user.destroy');
        });
    });
});