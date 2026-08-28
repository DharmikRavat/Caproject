<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\Blog;
use App\Models\Career;
use App\Models\ContactEnquiry;
use App\Models\Industry;
use App\Models\JobApplication;
use App\Models\Service;
use App\Models\TeamMember;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PageController extends Controller
{
    public function home()
    {
        $banners = Banner::where('is_active', true)->latest()->get();
        $blogs = Blog::where('is_published', true)->latest()->take(3)->get();
        $teamMembers = TeamMember::where('is_active', true)->latest()->take(4)->get();

        return view('home', compact('banners', 'blogs', 'teamMembers'));
    }

    public function about()
    {
        $teamMembers = TeamMember::where('is_active', true)->latest()->get();

        return view('about', compact('teamMembers'));
    }



    public function blogs()
    {
        $query = Blog::with(['category', 'tags'])->where('is_published', true);
        
        if (request()->filled('search')) {
            $search = request('search');
            $query->where(function ($builder) use ($search) {
                $builder->where('title', 'like', "%{$search}%")
                    ->orWhere('excerpt', 'like', "%{$search}%")
                    ->orWhere('content', 'like', "%{$search}%");
            });
        }

        if (request()->filled('category')) {
            $categorySlug = request('category');
            $query->whereHas('category', function ($q) use ($categorySlug) {
                $q->where('slug', $categorySlug);
            });
        }

        if (request()->filled('tag')) {
            $tagSlug = request('tag');
            $query->whereHas('tags', function ($q) use ($tagSlug) {
                $q->where('slug', $tagSlug);
            });
        }

        if (request()->filled('month')) {
            $month = request('month');
            $query->whereRaw("DATE_FORMAT(created_at, '%Y-%m') = ?", [$month]);
        }

        $blogs = $query->latest()->paginate(5)->appends(request()->query());
        $recentBlogs = Blog::where('is_published', true)->latest()->take(3)->get();
        
        $categories = \App\Models\BlogCategory::withCount('blogs')->orderBy('name')->get();
        $tags = \App\Models\BlogTag::withCount('blogs')->orderBy('name')->get();
        
        $archives = Blog::where('is_published', true)
            ->selectRaw("DATE_FORMAT(created_at, '%Y-%m') as month, count(*) as total")
            ->groupBy('month')
            ->orderBy('month', 'desc')
            ->get();

        return view('blogs', compact('blogs', 'recentBlogs', 'categories', 'tags', 'archives'));
    }

    public function blog($slug)
    {
        $blog = Blog::with(['category', 'tags'])->where('slug', $slug)->where('is_published', true)->firstOrFail();
        return view('blog', compact('blog'));
    }

    public function careers()
    {
        $careers = Career::where('is_active', true)->latest()->get();

        return view('careers', compact('careers'));
    }

    public function career($slug)
    {
        $career = Career::where('slug', $slug)->where('is_active', true)->firstOrFail();
        return view('career', compact('career'));
    }

    public function contact()
    {
        return view('contact');
    }

    public function submitContact(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:50',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        ContactEnquiry::create($validated);

        return back()->with('success', 'Your enquiry has been sent successfully. Our team will contact you shortly.');
    }

    public function applyCareer(Request $request, $slug)
    {
        $career = Career::where('slug', $slug)->where('is_active', true)->firstOrFail();

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:50',
            'cover_letter' => 'nullable|string',
            'resume' => 'required|file|mimes:pdf,doc,docx|max:2048',
        ]);

        $resumePath = $request->file('resume')->store('resumes', 'public');

        JobApplication::create([
            'career_id' => $career->getKey(),
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'cover_letter' => $validated['cover_letter'] ?? null,
            'resume_path' => $resumePath,
            'status' => 'new',
        ]);

        return redirect()->back()->with('success', 'Your application has been submitted successfully.');
    }

    public function topic($slug)
    {
        $topic = \App\Models\Topic::where('slug', $slug)->firstOrFail();
        $posts = $topic->posts()->where('is_published', true)->latest('published_date')->paginate(12);
        
        return view('topic', compact('topic', 'posts'));
    }

    public function topicPost($slug)
    {
        $post = \App\Models\TopicPost::with('topic')->where('slug', $slug)->where('is_published', true)->firstOrFail();
        return view('topic-post', compact('post'));
    }
}
