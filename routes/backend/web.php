<?php

use App\Http\Controllers\Backend\AboutController;
use App\Http\Controllers\Backend\LogActivityController;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\DeveloperController;
use App\Http\Controllers\Backend\HomeController;
use App\Http\Controllers\Backend\InformationController;
use App\Http\Controllers\Backend\RoleController;
use App\Http\Controllers\Backend\PostCategoryController;
use App\Http\Controllers\Backend\PostController;
use App\Http\Controllers\Backend\ProfileController;
use App\Http\Controllers\Backend\ProjectController;
use App\Http\Controllers\Backend\Resume\EducationController;
use App\Http\Controllers\Backend\Resume\ExperienceController;
use App\Http\Controllers\Backend\Resume\LanguageSkillController;
use App\Http\Controllers\Backend\Resume\TechnicalSkillController;
use App\Http\Controllers\Backend\SocialMediaController;
use App\Http\Controllers\Backend\UserController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['auth', 'share.notifications']], function () {
    Route::prefix('backend')->group(function () {
        Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
        Route::put('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
        Route::put('/profile/update-password', [ProfileController::class, 'updatePassword'])->name('profile.update.password');
        Route::delete('/profile/destroy/profile-picture', [ProfileController::class, 'destroyProfilePicture'])->name('profile.destroy.profile.picture');

        Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['can:view_dashboard'])->name('dashboard');

        Route::prefix('home')->group(function () { 
            Route::get('/', [HomeController::class, 'index'])->middleware(['can:view_home'])->name('backend.home.index');
            Route::put('/update', [HomeController::class, 'update'])->middleware(['can:update_home'])->name('backend.home.update');
            Route::put('/update/image', [HomeController::class, 'updateImage'])->middleware(['can:update_image_home'])->name('backend.home.update.image');
        });

        Route::prefix('about')->group(function () { 
            Route::get('/', [AboutController::class, 'index'])->middleware(['can:view_about'])->name('backend.about.index');
            Route::put('/update', [AboutController::class, 'update'])->middleware(['can:update_about'])->name('backend.about.update');
        });

        Route::prefix('project')->group(function () { 
            Route::get('/', [ProjectController::class, 'index'])->middleware(['can:view_projects'])->name('backend.project.index');
            Route::get('/search', [ProjectController::class, 'index'])->middleware(['can:view_projects'])->name('backend.project.search');
            Route::get('/create', [ProjectController::class, 'create'])->middleware(['can:create_projects'])->name('backend.project.create');
            Route::post('/store', [ProjectController::class, 'store'])->middleware(['can:create_projects'])->name('backend.project.store');
            Route::get('/edit/{project}', [ProjectController::class, 'edit'])->middleware(['can:edit_projects'])->name('backend.project.edit');
            Route::put('/update/{project}', [ProjectController::class, 'update'])->middleware(['can:edit_projects'])->name('backend.project.update');
            Route::delete('/destroy/{project}', [ProjectController::class, 'destroy'])->middleware(['can:destroy_projects'])->name('backend.project.destroy');
        });

        Route::prefix('post-category')->group(function () {
            Route::get('/', [PostCategoryController::class, 'index'])->middleware(['can:view_post_categories'])->name('post.category.index');
            Route::get('/search', [PostCategoryController::class, 'index'])->middleware(['can:view_post_categories'])->name('post.category.search');
            Route::get('/create', [PostCategoryController::class, 'create'])->middleware(['can:create_post_categories'])->name('post.category.create');
            Route::post('/store', [PostCategoryController::class, 'store'])->middleware(['can:create_post_categories'])->name('post.category.store');
            Route::get('/edit/{postCategory}', [PostCategoryController::class, 'edit'])->middleware(['can:edit_post_categories'])->name('post.category.edit');
            Route::put('/update/{postCategory}', [PostCategoryController::class, 'update'])->middleware(['can:edit_post_categories'])->name('post.category.update');
            Route::delete('/destroy/{postCategory}', [PostCategoryController::class, 'destroy'])->middleware(['can:destroy_post_categories'])->name('post.category.destroy');
        });

        Route::prefix('post')->group(function () {
            Route::get('/', [PostController::class, 'index'])->middleware(['can:view_posts'])->name('post.index');
            Route::get('/create', [PostController::class, 'create'])->middleware(['can:create_posts'])->name('post.create');
            Route::post('/store', [PostController::class, 'store'])->middleware(['can:create_posts'])->name('post.store');
            Route::get('/edit/{post}', [PostController::class, 'edit'])->middleware(['can:edit_posts'])->name('post.edit');
            Route::put('/update/{post}', [PostController::class, 'update'])->middleware(['can:edit_posts'])->name('post.update');
            Route::delete('/destroy/{post}', [PostController::class, 'destroy'])->middleware(['can:destroy_posts'])->name('post.destroy');
            Route::delete('/mass-destroy', [PostController::class, 'massDestroy'])->middleware(['can:mass_destroy_posts'])->name('post.mass.destroy');
        });

        Route::prefix('resume')->group(function () {
            Route::prefix('education')->group(function () {
                Route::get('/', [EducationController::class, 'index'])->middleware(['can:view_education'])->name('education.index');
                Route::get('/search', [EducationController::class, 'index'])->middleware(['can:view_education'])->name('education.search');
                Route::get('/create', [EducationController::class, 'create'])->middleware(['can:create_education'])->name('education.create');
                Route::post('/store', [EducationController::class, 'store'])->middleware(['can:create_education'])->name('education.store');
                Route::get('/edit/{education}', [EducationController::class, 'edit'])->middleware(['can:edit_education'])->name('education.edit');
                Route::put('/update/{education}', [EducationController::class, 'update'])->middleware(['can:edit_education'])->name('education.update');
                Route::delete('/destroy/{education}', [EducationController::class, 'destroy'])->middleware(['can:destroy_education'])->name('education.destroy');
            });
        
            Route::prefix('experience')->group(function () {
                Route::get('/', [ExperienceController::class, 'index'])->middleware(['can:view_experience'])->name('experience.index');
                Route::get('/search', [ExperienceController::class, 'index'])->middleware(['can:view_experience'])->name('experience.search');
                Route::get('/create', [ExperienceController::class, 'create'])->middleware(['can:create_experience'])->name('experience.create');
                Route::post('/store', [ExperienceController::class, 'store'])->middleware(['can:create_experience'])->name('experience.store');
                Route::get('/edit/{experience}', [ExperienceController::class, 'edit'])->middleware(['can:edit_experience'])->name('experience.edit');
                Route::put('/update/{experience}', [ExperienceController::class, 'update'])->middleware(['can:edit_experience'])->name('experience.update');
                Route::delete('/destroy/{experience}', [ExperienceController::class, 'destroy'])->middleware(['can:destroy_experience'])->name('experience.destroy');
            });
        
            Route::prefix('skill')->group(function () { 
                Route::prefix('technical')->group(function () { 
                    Route::get('/', [TechnicalSkillController::class, 'index'])->middleware(['can:view_technical_skills'])->name('skill.technical.index');
                    Route::get('/search', [TechnicalSkillController::class, 'index'])->middleware(['can:view_technical_skills'])->name('skill.technical.search');
                    Route::get('/create', [TechnicalSkillController::class, 'create'])->middleware(['can:create_technical_skills'])->name('skill.technical.create');
                    Route::post('/store', [TechnicalSkillController::class, 'store'])->middleware(['can:create_technical_skills'])->name('skill.technical.store');
                    Route::get('/edit/{technicalSkill}', [TechnicalSkillController::class, 'edit'])->middleware(['can:edit_technical_skills'])->name('skill.technical.edit');
                    Route::put('/update/{technicalSkill}', [TechnicalSkillController::class, 'update'])->middleware(['can:edit_technical_skills'])->name('skill.technical.update');
                    Route::delete('/destroy/{technicalSkill}', [TechnicalSkillController::class, 'destroy'])->middleware(['can:destroy_technical_skills'])->name('skill.technical.destroy');
                });
        
                Route::prefix('language')->group(function () { 
                    Route::get('/', [LanguageSkillController::class, 'index'])->middleware(['can:view_language_skills'])->name('skill.language.index');
                    Route::get('/search', [LanguageSkillController::class, 'index'])->middleware(['can:view_language_skills'])->name('skill.language.search');
                    Route::get('/create', [LanguageSkillController::class, 'create'])->middleware(['can:create_language_skills'])->name('skill.language.create');
                    Route::post('/store', [LanguageSkillController::class, 'store'])->middleware(['can:create_language_skills'])->name('skill.language.store');
                    Route::get('/edit/{languageSkill}', [LanguageSkillController::class, 'edit'])->middleware(['can:edit_language_skills'])->name('skill.language.edit');
                    Route::put('/update/{languageSkill}', [LanguageSkillController::class, 'update'])->middleware(['can:edit_language_skills'])->name('skill.language.update');
                    Route::delete('/destroy/{languageSkill}', [LanguageSkillController::class, 'destroy'])->middleware(['can:destroy_language_skills'])->name('skill.language.destroy');
                });
            });
        });

        Route::prefix('role')->group(function () {
            Route::get('/', [RoleController::class, 'index'])->middleware(['can:view_roles'])->name('role.index');
            Route::get('/search', [RoleController::class, 'index'])->middleware(['can:view_roles'])->name('role.search');
            Route::get('/show/{role}', [RoleController::class, 'show'])->middleware(['can:view_detail_roles'])->name('role.show');
            Route::post('/show/{role}/store/permission', [RoleController::class, 'updateRolePermissions'])->middleware(['can:view_detail_roles'])->name('role.store.permissions');
        });

        /**
        Route::prefix('permission')->group(function () {
            Route::get('/', [PermissionController::class, 'index'])->middleware(['can:view_permissions'])->name('permission.index');
            Route::get('/create', [PermissionController::class, 'create'])->middleware(['can:create_permissions'])->name('permission.create');
            Route::post('/store', [PermissionController::class, 'store'])->middleware(['can:create_permissions'])->name('permission.store');
        });
        */
        
        Route::prefix('user')->group(function () {
            Route::get('/', [UserController::class, 'index'])->middleware(['can:view_users'])->name('user.index');
            Route::get('/search', [UserController::class, 'index'])->middleware(['can:view_users'])->name('user.search');
            Route::get('/create', [UserController::class, 'create'])->middleware(['can:create_users'])->name('user.create');
            Route::post('/store', [UserController::class, 'store'])->middleware(['can:create_users'])->name('user.store');
            Route::get('/edit/{user}', [UserController::class, 'edit'])->middleware(['can:edit_users'])->name('user.edit');
            Route::put('/update/{user}', [UserController::class, 'update'])->middleware(['can:edit_users'])->name('user.update');
            Route::delete('/destroy/{user}', [UserController::class, 'destroy'])->middleware(['can:destroy_users'])->name('user.destroy');
        });

        Route::prefix('developer')->group(function () {
            Route::get('/', [DeveloperController::class, 'index'])->middleware(['can:view_developer'])->name('developer.index');
            Route::post('/cache/routes', [DeveloperController::class, 'cacheRoutes'])->middleware(['can:view_developer'])->name('cache.routes');
            Route::post('/migrate/fresh/seed', [DeveloperController::class, 'databaseMigrateFreshAndSeed'])->middleware(['can:view_developer'])->name('database.migrate.fresh.seed');
            Route::post('/factory/code/run', [DeveloperController::class, 'factoryCodeRunner'])->middleware(['can:view_developer'])->name('factory.code.runner');

            Route::get('/test-generate-sitemap', function () {
                Artisan::call('generate-sitemap');
                return response()->json(['message' => 'Sitemap generated successfully']);
            });
            
            Route::get('/optimize-clear', function(){
                Artisan::call('optimize:clear');
                Artisan::call('cache:clear');
                Artisan::call('view:clear');
                echo 'Cache cleared successfully!';
            });
        });

        Route::prefix('social-media')->group(function () {
            Route::get('/', [SocialMediaController::class, 'index'])->middleware(['can:view_social_media'])->name('social.media.index');
            Route::get('create', [SocialMediaController::class, 'create'])->middleware(['can:create_social_media'])->name('social.media.create');
            Route::post('store', [SocialMediaController::class, 'store'])->middleware(['can:create_social_media'])->name('social.media.store');
            Route::get('edit/{socialMedia}', [SocialMediaController::class, 'edit'])->middleware(['can:edit_social_media'])->name('social.media.edit');
            Route::put('update/{socialMedia}', [SocialMediaController::class, 'update'])->middleware(['can:edit_social_media'])->name('social.media.update');
            Route::delete('destroy/{socialMedia}', [SocialMediaController::class, 'destroy'])->middleware(['can:destroy_social_media'])->name('social.media.destroy');
        });

        Route::prefix('log-activity')->group(function () {
            Route::get('/', [LogActivityController::class, 'index'])->middleware(['can:view_log_activity'])->name('log.activity.index');
        });

        Route::prefix('details')->group(function () {
            Route::get('/information', [InformationController::class, 'index'])->middleware(['can:view_information'])->name('information.index');
        });

        Route::post('/notifications/{id}/mark-as-read', function ($id) {
            $notification = auth()->user()->notifications()->findOrFail($id);
            if ($notification->read_at === null) {
                $notification->markAsRead();
            }
        
            return response()->json(['success' => true]);
        })->name('notifications.mark.as.read');
    });
});