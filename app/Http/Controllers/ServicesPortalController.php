<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\ServiceCategory;
use Illuminate\Http\Request;

class ServicesPortalController extends Controller
{
    public function index()
    {
        // Only fetch main (parent) categories
        $categories = ServiceCategory::with(['services' => function($query) {
            $query->where('status', true)->orderBy('sort_order');
        }])->where('status', true)->whereNull('parent_id')->orderBy('sort_order')->get();

        return view('services-portal.index', compact('categories'));
    }

    public function category($category_slug)
    {
        $category = ServiceCategory::with(['services' => function($query) {
            $query->where('status', true)->orderBy('sort_order');
        }])->where('slug', $category_slug)->where('status', true)->firstOrFail();

        return view('services-portal.category', compact('category'));
    }

    public function show($category_slug, $service_slug)
    {
        $category = ServiceCategory::where('slug', $category_slug)->where('status', true)->firstOrFail();
        
        $service = Service::with(['sections', 'faqs', 'documents', 'processSteps', 'children'])
            ->where('slug', $service_slug)
            ->where('category_id', $category->id)
            ->where('status', true)
            ->firstOrFail();

        $relatedServices = Service::where('category_id', $category->id)
            ->where('id', '!=', $service->id)
            ->where('status', true)
            ->inRandomOrder()
            ->take(4)
            ->get();

        return view('services-portal.show', compact('category', 'service', 'relatedServices'));
    }
}
