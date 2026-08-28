<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Topic;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TopicController extends Controller
{
    public function index()
    {
        $topics = Topic::withCount('posts')->latest()->paginate(10);
        return view('admin.topics.index', compact('topics'));
    }

    public function create()
    {
        return view('admin.topics.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|unique:topics,slug',
            'description' => 'nullable|string',
        ]);
        
        Topic::create([
            'title' => $request->title,
            'slug' => $request->slug ?? Str::slug($request->title),
            'description' => $request->description,
        ]);

        return redirect()->route('admin.topics.index')->with('success', 'Topic created successfully.');
    }

    public function edit(Topic $topic)
    {
        return view('admin.topics.edit', compact('topic'));
    }

    public function update(Request $request, Topic $topic)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|unique:topics,slug,' . $topic->id,
            'description' => 'nullable|string',
        ]);
        
        $topic->update([
            'title' => $request->title,
            'slug' => $request->slug ?? Str::slug($request->title),
            'description' => $request->description,
        ]);

        return redirect()->route('admin.topics.index')->with('success', 'Topic updated successfully.');
    }

    public function destroy(Topic $topic)
    {
        $topic->delete();
        return redirect()->route('admin.topics.index')->with('success', 'Topic deleted successfully.');
    }
}
