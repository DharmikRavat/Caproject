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
        $serviceCategories = [
            'business_registration' => 'Business Registration',
            'company_formation' => 'Company Formation',
            'audit_assurance' => 'Audit & Assurance',
            'direct_tax' => 'Direct Tax / Taxation',
            'corporate_laws' => 'Corporate Laws',
            'consultancy' => 'Consultancy',
            'nri_tax_allied_services' => 'NRI Tax & Allied Services',
        ];

        view()->composer(['layouts.app', 'layouts.admin', 'components.frontend.header'], function ($view) {
            $view->with('siteSettings', \Illuminate\Support\Facades\Cache::rememberForever('site_settings', function() {
                return SiteSetting::pluck('value', 'key');
            }));
        });
    }
}
