<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\SiteSetting;

class ViewServiceProvider extends ServiceProvider
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
        View::composer('*', function ($view) {
            $settings = SiteSetting::first();
            $view->with('siteSettings', $settings);
            
            // Share footer services (limited to 6)
            $footerServices = \App\Models\Service::where('is_active', true)
                ->orderBy('order')
                ->orderBy('created_at', 'desc')
                ->limit(6)
                ->get();
            $view->with('footerServices', $footerServices);
        });
    }
}
