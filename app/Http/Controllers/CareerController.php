<?php

namespace App\Http\Controllers;

use App\Models\Career;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CareerController extends Controller
{
    public function index()
    {
        $careers = Career::latest()->get();
        return view('admin.careers.index', compact('careers'));
    }

    public function create()
    {
        return view('admin.careers.form', ['career' => new Career(), 'route' => route('admin.careers.store')]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|unique:careers,slug',
            'location' => 'nullable|string|max:255',
            'type' => 'nullable|string|max:255',
            'experience' => 'nullable|string|max:255',
            'summary' => 'nullable|string',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:4096',
            'is_active' => 'boolean',
        ]);

        $validated['slug'] = $validated['slug'] ?? Str::slug($validated['title']);
        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('careers', 'public');
        }
        $validated['is_active'] = $request->has('is_active');
        Career::create($validated);

        return redirect()->route('admin.careers.index')->with('success', 'Career opportunity created successfully.');
    }

    public function edit(Career $career)
    {
        return view('admin.careers.form', ['career' => $career, 'route' => route('admin.careers.update', $career)]);
    }

    public function update(Request $request, Career $career)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|unique:careers,slug,' . $career->id,
            'location' => 'nullable|string|max:255',
            'type' => 'nullable|string|max:255',
            'experience' => 'nullable|string|max:255',
            'summary' => 'nullable|string',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:4096',
            'is_active' => 'boolean',
        ]);

        $validated['slug'] = $validated['slug'] ?? Str::slug($validated['title']);
        if ($request->hasFile('image')) {
            if ($career->image) {
                Storage::disk('public')->delete($career->image);
            }
            $validated['image'] = $request->file('image')->store('careers', 'public');
        }
        $validated['is_active'] = $request->has('is_active');
        $career->update($validated);

        return redirect()->route('admin.careers.index')->with('success', 'Career opportunity updated successfully.');
    }

    public function destroy(Career $career)
    {
        if ($career->image) {
            Storage::disk('public')->delete($career->image);
        }
        $career->delete();
        return redirect()->route('admin.careers.index')->with('success', 'Career opportunity deleted successfully.');
    }
}
