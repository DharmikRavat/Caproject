<?php

namespace App\Http\Controllers;

use App\Models\Testimonial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TestimonialController extends Controller
{
    public function index()
    {
        $testimonials = Testimonial::latest()->get();
        return view('admin.testimonials.index', compact('testimonials'));
    }

    public function create()
    {
        return view('admin.testimonials.form', ['testimonial' => new Testimonial(), 'route' => route('admin.testimonials.store')]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'author' => 'required|string|max:255',
            'author_image' => 'nullable|image|mimes:jpeg,png,jpg,svg|max:2048',
            'rating' => 'required|integer|min:1|max:5',
            'content' => 'required|string',
            'is_active' => 'boolean',
        ]);

        if ($request->hasFile('author_image')) {
            $validated['author_image'] = $request->file('author_image')->store('testimonials', 'public');
        }

        Testimonial::create($validated);
        return redirect()->route('admin.testimonials.index')->with('success', 'Testimonial added successfully.');
    }

    public function edit(Testimonial $testimonial)
    {
        return view('admin.testimonials.form', ['testimonial' => $testimonial, 'route' => route('admin.testimonials.update', $testimonial)]);
    }

    public function update(Request $request, Testimonial $testimonial)
    {
        $validated = $request->validate([
            'author' => 'required|string|max:255',
            'author_image' => 'nullable|image|mimes:jpeg,png,jpg,svg|max:2048',
            'rating' => 'required|integer|min:1|max:5',
            'content' => 'required|string',
            'is_active' => 'boolean',
        ]);

        if ($request->hasFile('author_image')) {
            if ($testimonial->author_image) {
                Storage::disk('public')->delete($testimonial->author_image);
            }
            $validated['author_image'] = $request->file('author_image')->store('testimonials', 'public');
        }

        $testimonial->update($validated);
        return redirect()->route('admin.testimonials.index')->with('success', 'Testimonial updated successfully.');
    }

    public function destroy(Testimonial $testimonial)
    {
        if ($testimonial->author_image) {
            Storage::disk('public')->delete($testimonial->author_image);
        }
        $testimonial->delete();
        return redirect()->route('admin.testimonials.index')->with('success', 'Testimonial deleted successfully.');
    }
}
