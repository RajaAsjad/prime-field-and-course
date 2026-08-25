<?php

namespace App\Providers;

use App\Models\NavigationLink;
use App\Models\SiteSetting;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::composer([
            'layouts.app',
            'partials.header',
            'partials.footer',
            'partials.site-brand',
            'partials.brand-logo',
            'pages.content.*',
        ], function ($view) {
            $view->with('siteSettings', SiteSetting::getSettings());
        });

        View::composer(['partials.header', 'partials.footer'], function ($view) {
            $view->with('navigationLinks', NavigationLink::grouped());
        });
    }
}
