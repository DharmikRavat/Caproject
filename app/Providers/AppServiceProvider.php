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
        \Illuminate\Pagination\Paginator::useBootstrapFive();

        $serviceCategories = [
            'business_registration' => 'Business Registration',
            'company_formation' => 'Company Formation',
            'audit_assurance' => 'Audit & Assurance',
            'direct_tax' => 'Direct Tax / Taxation',
            'corporate_laws' => 'Corporate Laws',
            'consultancy' => 'Consultancy',
            'nri_tax_allied_services' => 'NRI Tax & Allied Services',
        ];

        view()->composer('*', function ($view) {
            $view->with('siteSettings', \Illuminate\Support\Facades\Cache::rememberForever('site_settings', function() {
                return SiteSetting::pluck('value', 'key');
            }));
        });

        // Pass global categories and their services to the header for the Mega Menu
        view()->composer('components.frontend.header', function ($view) {
            $globalServiceCategories = \App\Models\ServiceCategory::with(['services' => function($q) {
                $q->where('status', true)->orderBy('sort_order');
            }])->whereNull('parent_id')
               ->where('status', true)
               ->orderBy('sort_order')
               ->get();

            $view->with('globalServiceCategories', $globalServiceCategories);
        });
    }
}
