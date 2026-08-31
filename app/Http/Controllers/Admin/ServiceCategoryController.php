<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ServiceCategory;

class ServiceCategoryController extends Controller
{
    public function index()
    {
        $categories = ServiceCategory::with('parent')->paginate(15);
        return view('admin.service-categories.index', compact('categories'));
    }

    public function create()
    {
        $categories = ServiceCategory::whereNull('parent_id')->get();
        return view('admin.service-categories.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:service_categories',
            'parent_id' => 'nullable|exists:service_categories,id',
            'short_description' => 'nullable|string',
            'description' => 'nullable|string',
            'sort_order' => 'integer',
            'status' => 'boolean',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'header_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
            'icon' => 'nullable|string|max:100',
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('services/categories', 'public');
        }
        
        if ($request->hasFile('header_image')) {
            $validated['header_image'] = $request->file('header_image')->store('services/categories/headers', 'public');
        }

        $validated['status'] = $request->has('status');

        ServiceCategory::create($validated);
        return redirect()->route('admin.service-categories.index')->with('success', 'Category created successfully.');
    }

    public function edit(ServiceCategory $serviceCategory)
    {
        $categories = ServiceCategory::whereNull('parent_id')->where('id', '!=', $serviceCategory->id)->get();
        return view('admin.service-categories.edit', compact('serviceCategory', 'categories'));
    }

    public function update(Request $request, ServiceCategory $serviceCategory)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:service_categories,slug,' . $serviceCategory->id,
            'parent_id' => 'nullable|exists:service_categories,id',
            'short_description' => 'nullable|string',
            'description' => 'nullable|string',
            'sort_order' => 'integer',
            'status' => 'boolean',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'header_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
            'icon' => 'nullable|string|max:100',
        ]);

        if ($request->hasFile('image')) {
            if ($serviceCategory->image) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete($serviceCategory->image);
            }
            $validated['image'] = $request->file('image')->store('services/categories', 'public');
        }

        if ($request->hasFile('header_image')) {
            if ($serviceCategory->header_image) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete($serviceCategory->header_image);
            }
            $validated['header_image'] = $request->file('header_image')->store('services/categories/headers', 'public');
        }

        $validated['status'] = $request->has('status');

        $serviceCategory->update($validated);
        return redirect()->route('admin.service-categories.index')->with('success', 'Category updated successfully.');
    }

    public function destroy(ServiceCategory $serviceCategory)
    {
        $serviceCategory->delete();
        return redirect()->route('admin.service-categories.index')->with('success', 'Category deleted successfully.');
    }
}
