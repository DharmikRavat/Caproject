<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BlogTag;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BlogTagController extends Controller
{
    public function index()
    {
        $tags = BlogTag::withCount('blogs')->orderBy('sort_order', 'asc')->latest()->paginate(10);
        return view('admin.blog-tags.index', compact('tags'));
    }

    public function create()
    {
        return view('admin.blog-tags.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:blog_tags,name',
            'slug' => 'nullable|string|max:255|unique:blog_tags,slug',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
            'meta_keywords' => 'nullable|string',
            'sort_order' => 'nullable|integer',
        ]);
        
        $data = $request->except(['_token', 'image']);
        $data['slug'] = $request->slug ? Str::slug($request->slug) : Str::slug($request->name);
        $data['is_active'] = $request->has('is_active') ? 1 : 0;
        $data['sort_order'] = $request->sort_order ?? 0;

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('blog_tags', 'public');
        }
        
        BlogTag::create($data);

        return redirect()->route('admin.blog-tags.index')->with('success', 'Tag created successfully.');
    }

    public function edit(BlogTag $blogTag)
    {
        return view('admin.blog-tags.edit', compact('blogTag'));
    }

    public function update(Request $request, BlogTag $blogTag)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:blog_tags,name,' . $blogTag->id,
            'slug' => 'nullable|string|max:255|unique:blog_tags,slug,' . $blogTag->id,
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
            'meta_keywords' => 'nullable|string',
            'sort_order' => 'nullable|integer',
        ]);
        
        $data = $request->except(['_token', '_method', 'image']);
        $data['slug'] = $request->slug ? Str::slug($request->slug) : Str::slug($request->name);
        $data['is_active'] = $request->has('is_active') ? 1 : 0;
        $data['sort_order'] = $request->sort_order ?? 0;

        if ($request->hasFile('image')) {
            if ($blogTag->image) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete($blogTag->image);
            }
            $data['image'] = $request->file('image')->store('blog_tags', 'public');
        }
        
        $blogTag->update($data);

        return redirect()->route('admin.blog-tags.index')->with('success', 'Tag updated successfully.');
    }

    public function destroy(BlogTag $blogTag)
    {
        $blogTag->delete();
        return redirect()->route('admin.blog-tags.index')->with('success', 'Tag deleted successfully.');
    }
}
