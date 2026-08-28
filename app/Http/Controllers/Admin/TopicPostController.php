<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Topic;
use App\Models\TopicPost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class TopicPostController extends Controller
{
    public function index()
    {
        $posts = TopicPost::with('topic')->latest()->paginate(10);
        return view('admin.topic-posts.index', compact('posts'));
    }

    public function create()
    {
        $topics = Topic::all();
        return view('admin.topic-posts.form', ['post' => new TopicPost(), 'topics' => $topics, 'route' => route('admin.topic-posts.store')]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'topic_id' => 'required|exists:topics,id',
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|unique:topic_posts,slug',
            'image' => 'nullable|image|max:4096',
            'excerpt' => 'nullable|string',
            'content' => 'required|string',
            'published_date' => 'nullable|date',
            'is_published' => 'boolean',
        ]);
        
        $validated['slug'] = $validated['slug'] ?? Str::slug($validated['title']);
        
        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('topics', 'public');
        }

        TopicPost::create($validated);

        return redirect()->route('admin.topic-posts.index')->with('success', 'Post created successfully.');
    }

    public function edit(TopicPost $topicPost)
    {
        $topics = Topic::all();
        return view('admin.topic-posts.form', ['post' => $topicPost, 'topics' => $topics, 'route' => route('admin.topic-posts.update', $topicPost)]);
    }

    public function update(Request $request, TopicPost $topicPost)
    {
        $validated = $request->validate([
            'topic_id' => 'required|exists:topics,id',
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|unique:topic_posts,slug,' . $topicPost->id,
            'image' => 'nullable|image|max:4096',
            'excerpt' => 'nullable|string',
            'content' => 'required|string',
            'published_date' => 'nullable|date',
            'is_published' => 'boolean',
        ]);
        
        $validated['slug'] = $validated['slug'] ?? Str::slug($validated['title']);
        
        if ($request->hasFile('image')) {
            if ($topicPost->image) {
                Storage::disk('public')->delete($topicPost->image);
            }
            $validated['image'] = $request->file('image')->store('topics', 'public');
        }

        $topicPost->update($validated);

        return redirect()->route('admin.topic-posts.index')->with('success', 'Post updated successfully.');
    }

    public function destroy(TopicPost $topicPost)
    {
        if ($topicPost->image) {
            Storage::disk('public')->delete($topicPost->image);
        }
        $topicPost->delete();
        return redirect()->route('admin.topic-posts.index')->with('success', 'Post deleted successfully.');
    }
}
