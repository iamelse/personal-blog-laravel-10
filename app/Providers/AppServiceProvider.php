<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //$this->app->bind(PostRepository::class, EloquentPostRepository::class);
        //$this->app->bind(PostCategoryRepository::class, EloquentPostCategoryRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        DB::whenQueryingForLongerThan(1000, function($connection) {
            Log::warning(
                "Long running queries detected.",
                $connection->getQueryLog()
            );
        });
        
        Paginator::useBootstrapFive();
        Paginator::useBootstrapFour();
    }
}
