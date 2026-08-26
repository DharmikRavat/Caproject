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

        view()->composer(['layouts.app', 'layouts.admin', 'components.frontend.header'], function ($view) use ($serviceCategories) {
            $servicesGrouped = Service::where('is_active', true)
                ->orderBy('title')
                ->get()
                ->groupBy('category');

            // Sort grouped services according to the defined category order
            $orderedHeaderServices = collect();
            foreach (array_keys($serviceCategories) as $catKey) {
                if ($servicesGrouped->has($catKey)) {
                    $orderedHeaderServices->put($catKey, $servicesGrouped->get($catKey));
                }
            }
            // Put any remaining categories
            foreach ($servicesGrouped as $catKey => $services) {
                if (!$orderedHeaderServices->has($catKey)) {
                    $orderedHeaderServices->put($catKey, $services);
                }
            }

            $view->with('siteSettings', SiteSetting::pluck('value', 'key'))
                ->with('footerServices', Service::where('is_active', true)->latest()->take(6)->get())
                ->with('headerServices', $orderedHeaderServices)
                ->with('serviceCategories', $serviceCategories);
        });

        view()->share('serviceCategories', $serviceCategories);
    }
}
