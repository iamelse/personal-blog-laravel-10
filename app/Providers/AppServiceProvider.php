<?php

namespace App\Providers;

use App\Repositories\EloquentPostCategoryRepository;
use App\Repositories\EloquentPostRepository;
use App\Repositories\PostCategoryRepository;
use App\Repositories\PostRepository;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(PostRepository::class, EloquentPostRepository::class);
        $this->app->bind(PostCategoryRepository::class, EloquentPostCategoryRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrapFive();
        Paginator::useBootstrapFour();
    }
}
