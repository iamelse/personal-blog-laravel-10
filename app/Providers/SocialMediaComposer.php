<?php

namespace App\Providers;

use App\Models\SocialMedia;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class SocialMediaComposer extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        View::composer('frontend.partials.footer', function ($view) {
            $socialMedias = SocialMedia::all();
            $view->with('socialMedias', $socialMedias);
        });
    }
}
