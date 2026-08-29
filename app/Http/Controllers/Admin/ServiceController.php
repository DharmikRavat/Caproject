<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Service;
use App\Models\ServiceCategory;

class ServiceController extends Controller
{
    public function index(Request $request)
    {
        $query = Service::with('category');
        
        if ($request->has('category_id')) {
            $query->where('category_id', $request->category_id);
            $selectedCategory = \App\Models\ServiceCategory::find($request->category_id);
        } else {
            $selectedCategory = null;
        }
        
        $services = $query->paginate(20);
        return view('admin.services.index', compact('services', 'selectedCategory'));
    }

    public function create(Request $request)
    {
        $categories = \App\Models\ServiceCategory::all();
        $parentServices = Service::whereNull('parent_service_id')->get();
        $selectedCategoryId = $request->category_id;
        return view('admin.services.create', compact('categories', 'parentServices', 'selectedCategoryId'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'category_id' => 'required|exists:service_categories,id',
            'parent_service_id' => 'nullable|exists:services,id',
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:services',
            'short_description' => 'nullable|string',
            'description' => 'nullable|string',
            'sort_order' => 'integer',
            'status' => 'boolean',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'banner_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'header_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
            'icon' => 'nullable|string|max:100',
        ]);

        if ($request->hasFile('featured_image')) {
            $validated['featured_image'] = $request->file('featured_image')->store('services/featured', 'public');
        }

        if ($request->hasFile('banner_image')) {
            $validated['banner_image'] = $request->file('banner_image')->store('services/banners', 'public');
        }
        
        if ($request->hasFile('header_image')) {
            $validated['header_image'] = $request->file('header_image')->store('services/headers', 'public');
        }

        $validated['description'] = $validated['description'] ?? '';
        $validated['short_description'] = $validated['short_description'] ?? '';

        Service::create($validated);
        return redirect()->route('admin.services.index')->with('success', 'Service created successfully.');
    }

    public function edit(Service $service)
    {
        $categories = \App\Models\ServiceCategory::all();
        $parentServices = Service::where('id', '!=', $service->id)->get();
        return view('admin.services.edit', compact('service', 'categories', 'parentServices'));
    }

    public function update(Request $request, Service $service)
    {
        $validated = $request->validate([
            'category_id' => 'required|exists:service_categories,id',
            'parent_service_id' => 'nullable|exists:services,id',
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:services,slug,' . $service->id,
            'short_description' => 'nullable|string',
            'description' => 'nullable|string',
            'sort_order' => 'integer',
            'status' => 'boolean',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'banner_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'header_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
            'icon' => 'nullable|string|max:100',
        ]);

        if ($request->hasFile('featured_image')) {
            if ($service->featured_image) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete($service->featured_image);
            }
            $validated['featured_image'] = $request->file('featured_image')->store('services/featured', 'public');
        }

        if ($request->hasFile('banner_image')) {
            if ($service->banner_image) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete($service->banner_image);
            }
            $validated['banner_image'] = $request->file('banner_image')->store('services/banners', 'public');
        }
        
        if ($request->hasFile('header_image')) {
            if ($service->header_image) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete($service->header_image);
            }
            $validated['header_image'] = $request->file('header_image')->store('services/headers', 'public');
        }

        $validated['description'] = $validated['description'] ?? '';
        $validated['short_description'] = $validated['short_description'] ?? '';

        $service->update($validated);
        return redirect()->route('admin.services.index')->with('success', 'Service updated successfully.');
    }

    public function destroy(Service $service)
    {
        $service->delete();
        return redirect()->route('admin.services.index')->with('success', 'Service deleted successfully.');
    }

    public function content(Service $service)
    {
        $service->load(['sections', 'faqs', 'documents', 'processSteps']);
        return view('admin.services.content', compact('service'));
    }
}
