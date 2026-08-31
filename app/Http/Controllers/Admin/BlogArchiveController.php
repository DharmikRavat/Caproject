<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BlogArchive;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class BlogArchiveController extends Controller
{
    public function index()
    {
        $archives = BlogArchive::orderBy('created_at', 'desc')->get();
        return view('admin.blog-archives.index', compact('archives'));
    }

    public function create()
    {
        return view('admin.blog-archives.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:blog_archives,slug',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->except('image');
        
        if (empty($data['slug'])) {
            $data['slug'] = Str::slug($data['name']);
        }
        
        $data['is_active'] = $request->has('is_active');

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('blog-archives', 'public');
        }

        BlogArchive::create($data);

        return redirect()->route('admin.blog-archives.index')->with('success', 'Blog Archive created successfully.');
    }

    public function edit(BlogArchive $blogArchive)
    {
        return view('admin.blog-archives.edit', compact('blogArchive'));
    }

    public function update(Request $request, BlogArchive $blogArchive)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:blog_archives,slug,' . $blogArchive->id,
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->except('image');
        $data['is_active'] = $request->has('is_active');

        if ($request->hasFile('image')) {
            if ($blogArchive->image) {
                Storage::disk('public')->delete($blogArchive->image);
            }
            $data['image'] = $request->file('image')->store('blog-archives', 'public');
        }

        $blogArchive->update($data);

        return redirect()->route('admin.blog-archives.index')->with('success', 'Blog Archive updated successfully.');
    }

    public function destroy(BlogArchive $blogArchive)
    {
        if ($blogArchive->image) {
            Storage::disk('public')->delete($blogArchive->image);
        }
        $blogArchive->delete();

        return redirect()->route('admin.blog-archives.index')->with('success', 'Blog Archive deleted successfully.');
    }
}
