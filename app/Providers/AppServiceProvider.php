<?php

namespace App\Providers;

use App\Models\Service;
use App\Models\SiteSetting;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer(['layouts.app', 'layouts.admin'], function ($view) {
            $view->with('siteSettings', SiteSetting::pluck('value', 'key'))
                ->with('footerServices', Service::where('is_active', true)->latest()->take(6)->get())
                ->with('headerServices', Service::where('is_active', true)->latest()->get()->groupBy('category'));
        });
    }
}
