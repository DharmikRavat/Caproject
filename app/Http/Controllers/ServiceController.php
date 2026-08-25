<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::latest()->get();
        return view('admin.services.index', compact('services'));
    }

    public function create()
    {
        return view('admin.services.form', ['service' => new Service(), 'route' => route('admin.services.store')]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|unique:services,slug',
            'category' => 'required|string|max:255',
            'short_description' => 'nullable|string',
            'description' => 'required|string',
            'icon' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,svg|max:2048',
            'featured' => 'boolean',
            'is_active' => 'boolean',
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('services', 'public');
        }

        $validated['slug'] = $validated['slug'] ?? Str::slug($validated['title']);
        Service::create($validated);

        return redirect()->route('admin.services.index')->with('success', 'Service created successfully.');
    }

    public function show(Service $service)
    {
        return redirect()->route('service.show', $service->slug);
    }

    public function edit(Service $service)
    {
        return view('admin.services.form', ['service' => $service, 'route' => route('admin.services.update', $service)]);
    }

    public function update(Request $request, Service $service)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|unique:services,slug,' . $service->id,
            'category' => 'required|string|max:255',
            'short_description' => 'nullable|string',
            'description' => 'required|string',
            'icon' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,svg|max:2048',
            'featured' => 'boolean',
            'is_active' => 'boolean',
        ]);

        if ($request->hasFile('image')) {
            if ($service->image) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete($service->image);
            }
            $validated['image'] = $request->file('image')->store('services', 'public');
        }

        $validated['slug'] = $validated['slug'] ?? Str::slug($validated['title']);
        $service->update($validated);

        return redirect()->route('admin.services.index')->with('success', 'Service updated successfully.');
    }

    public function destroy(Service $service)
    {
        if ($service->image) {
            \Illuminate\Support\Facades\Storage::disk('public')->delete($service->image);
        }
        $service->delete();
        return redirect()->route('admin.services.index')->with('success', 'Service deleted successfully.');
    }
}
