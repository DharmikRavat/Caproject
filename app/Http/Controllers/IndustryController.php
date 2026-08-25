<?php

namespace App\Http\Controllers;

use App\Models\Industry;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class IndustryController extends Controller
{
    public function index()
    {
        $industries = Industry::latest()->get();
        return view('admin.industries.index', compact('industries'));
    }

    public function create()
    {
        return view('admin.industries.form', ['industry' => new Industry(), 'route' => route('admin.industries.store')]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|unique:industries,slug',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,svg|max:2048',
            'icon' => 'nullable|string|max:255',
            'is_active' => 'boolean',
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('industries', 'public');
        }

        $validated['slug'] = $validated['slug'] ?? Str::slug($validated['name']);
        Industry::create($validated);

        return redirect()->route('admin.industries.index')->with('success', 'Industry added successfully.');
    }

    public function edit(Industry $industry)
    {
        return view('admin.industries.form', ['industry' => $industry, 'route' => route('admin.industries.update', $industry)]);
    }

    public function update(Request $request, Industry $industry)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|unique:industries,slug,' . $industry->id,
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,svg|max:2048',
            'icon' => 'nullable|string|max:255',
            'is_active' => 'boolean',
        ]);

        if ($request->hasFile('image')) {
            if ($industry->image) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete($industry->image);
            }
            $validated['image'] = $request->file('image')->store('industries', 'public');
        }

        $validated['slug'] = $validated['slug'] ?? Str::slug($validated['name']);
        $industry->update($validated);

        return redirect()->route('admin.industries.index')->with('success', 'Industry updated successfully.');
    }

    public function destroy(Industry $industry)
    {
        if ($industry->image) {
            \Illuminate\Support\Facades\Storage::disk('public')->delete($industry->image);
        }
        $industry->delete();
        return redirect()->route('admin.industries.index')->with('success', 'Industry deleted successfully.');
    }
}
