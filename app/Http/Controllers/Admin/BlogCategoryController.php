<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BlogCategory;
use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BlogCategoryController extends Controller
{
    public function index()
    {
        $categories = BlogCategory::withCount('blogs')->orderBy('sort_order')->get();
        return view('admin.blog-categories.index', compact('categories'));
    }

    public function create()
    {
        $allBlogs = Blog::orderBy('title')->get();
        return view('admin.blog-categories.form', ['blogCategory' => new BlogCategory(), 'allBlogs' => $allBlogs]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|unique:blog_categories,slug',
            'is_active' => 'boolean',
            'banner_image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'description' => 'nullable|string',
            'sort_order' => 'integer',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
            'meta_keywords' => 'nullable|string|max:255',
            'blogs' => 'nullable|array',
            'blogs.*' => 'exists:blogs,id',
        ]);

        $validated['slug'] = $validated['slug'] ?? Str::slug($validated['name']);
        $validated['is_active'] = $request->has('is_active');
        $validated['sort_order'] = $validated['sort_order'] ?? 0;

        if ($request->hasFile('banner_image')) {
            $validated['banner_image'] = $request->file('banner_image')->store('blog_categories', 'public');
        }
        
        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('blog_categories', 'public');
        }

        $category = BlogCategory::create($validated);

        if ($request->has('blogs') && is_array($request->blogs)) {
            Blog::whereIn('id', $request->blogs)->update(['blog_category_id' => $category->id]);
        }

        if ($request->wantsJson()) {
            return response()->json([
                'success' => true,
                'category' => $category,
                'message' => 'Category created successfully!'
            ]);
        }

        return redirect()->route('admin.blog-categories.index')->with('success', 'Blog Category created successfully.');
    }

    public function edit(BlogCategory $blogCategory)
    {
        $allBlogs = Blog::orderBy('title')->get();
        return view('admin.blog-categories.form', ['blogCategory' => $blogCategory, 'route' => route('admin.blog-categories.update', $blogCategory), 'allBlogs' => $allBlogs]);
    }

    public function update(Request $request, BlogCategory $blogCategory)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|unique:blog_categories,slug,' . $blogCategory->id,
            'is_active' => 'boolean',
            'banner_image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'description' => 'nullable|string',
            'sort_order' => 'integer',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
            'meta_keywords' => 'nullable|string|max:255',
            'blogs' => 'nullable|array',
            'blogs.*' => 'exists:blogs,id',
        ]);

        $validated['slug'] = $validated['slug'] ?? Str::slug($validated['name']);
        $validated['is_active'] = $request->has('is_active');
        $validated['sort_order'] = $validated['sort_order'] ?? 0;

        if ($request->hasFile('banner_image')) {
            if ($blogCategory->banner_image) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete($blogCategory->banner_image);
            }
            $validated['banner_image'] = $request->file('banner_image')->store('blog_categories', 'public');
        }
        
        if ($request->hasFile('image')) {
            if ($blogCategory->image) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete($blogCategory->image);
            }
            $validated['image'] = $request->file('image')->store('blog_categories', 'public');
        }

        $blogCategory->update($validated);

        // Disconnect old blogs
        Blog::where('blog_category_id', $blogCategory->id)->update(['blog_category_id' => null]);
        
        // Connect newly selected blogs
        if ($request->has('blogs') && is_array($request->blogs)) {
            Blog::whereIn('id', $request->blogs)->update(['blog_category_id' => $blogCategory->id]);
        }

        return redirect()->route('admin.blog-categories.index')->with('success', 'Blog Category updated successfully.');
    }

    public function destroy(BlogCategory $blogCategory)
    {
        if ($blogCategory->blogs()->count() > 0) {
            return redirect()->route('admin.blog-categories.index')->with('error', 'This category contains blogs. Please move the blogs to another category before deleting.');
        }

        if ($blogCategory->banner_image) {
            \Illuminate\Support\Facades\Storage::disk('public')->delete($blogCategory->banner_image);
        }
        if ($blogCategory->image) {
            \Illuminate\Support\Facades\Storage::disk('public')->delete($blogCategory->image);
        }
        $blogCategory->delete();
        return redirect()->route('admin.blog-categories.index')->with('success', 'Category deleted successfully.');
    }
}
