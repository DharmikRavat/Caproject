<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Testimonial;
use Illuminate\Http\Request;

class TestimonialController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $testimonials = Testimonial::orderBy('sort_order')->paginate(20);
        return view('admin.testimonials.index', compact('testimonials'));
    }

    public function create()
    {
        return view('admin.testimonials.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'author' => 'required|string|max:255',
            'author_role' => 'nullable|string|max:255',
            'author_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'rating' => 'required|integer|min:1|max:5',
            'content' => 'required|string',
            'source' => 'nullable|string|max:50',
            'review_date' => 'nullable|date',
            'is_verified' => 'boolean',
            'sort_order' => 'integer',
            'is_active' => 'boolean',
        ]);

        if ($request->hasFile('author_image')) {
            $validated['author_image'] = $request->file('author_image')->store('testimonials', 'public');
        }

        // Set defaults if not provided
        $validated['is_verified'] = $request->has('is_verified');
        $validated['is_active'] = $request->has('is_active');
        $validated['sort_order'] = $validated['sort_order'] ?? 0;
        $validated['source'] = $validated['source'] ?? 'Google';

        Testimonial::create($validated);
        return redirect()->route('admin.testimonials.index')->with('success', 'Review added successfully.');
    }

    public function edit(Testimonial $testimonial)
    {
        return view('admin.testimonials.edit', compact('testimonial'));
    }

    public function update(Request $request, Testimonial $testimonial)
    {
        $validated = $request->validate([
            'author' => 'required|string|max:255',
            'author_role' => 'nullable|string|max:255',
            'author_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'rating' => 'required|integer|min:1|max:5',
            'content' => 'required|string',
            'source' => 'nullable|string|max:50',
            'review_date' => 'nullable|date',
            'is_verified' => 'boolean',
            'sort_order' => 'integer',
            'is_active' => 'boolean',
        ]);

        if ($request->hasFile('author_image')) {
            if ($testimonial->author_image) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete($testimonial->author_image);
            }
            $validated['author_image'] = $request->file('author_image')->store('testimonials', 'public');
        }

        $validated['is_verified'] = $request->has('is_verified');
        $validated['is_active'] = $request->has('is_active');
        $validated['sort_order'] = $validated['sort_order'] ?? 0;

        $testimonial->update($validated);
        return redirect()->route('admin.testimonials.index')->with('success', 'Review updated successfully.');
    }

    public function destroy(Testimonial $testimonial)
    {
        if ($testimonial->author_image) {
            \Illuminate\Support\Facades\Storage::disk('public')->delete($testimonial->author_image);
        }
        $testimonial->delete();
        return redirect()->route('admin.testimonials.index')->with('success', 'Review deleted successfully.');
    }
}
