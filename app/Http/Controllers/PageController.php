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
        $serviceCategories = \App\Models\ServiceCategory::with(['services' => function($q) { $q->where('status', true); }])->whereNull('parent_id')->where('status', true)->orderBy('sort_order')->get();

        $businessRegistrationCategory = \App\Models\ServiceCategory::where('slug', 'business-registration')->first();
        $businessRegistrationServices = $businessRegistrationCategory 
            ? $businessRegistrationCategory->services()->where('status', true)->orderBy('sort_order')->get() 
            : collect();
            
        $companyFormationCategory = \App\Models\ServiceCategory::where('slug', 'company-formation')->first();
        $companyFormationServices = $companyFormationCategory 
            ? $companyFormationCategory->services()->where('status', true)->orderBy('sort_order')->get() 
            : collect();

        $industries = \App\Models\Industry::where('is_active', true)->orderBy('name')->get();

        $testimonials = \App\Models\Testimonial::where('is_active', true)->orderBy('sort_order')->get();
        $averageRating = $testimonials->avg('rating') ?? 5;
        $averageRating = number_format($averageRating, 1);
        $totalReviews = $testimonials->count();

        return view('home', compact('banners', 'blogs', 'teamMembers', 'serviceCategories', 'businessRegistrationServices', 'companyFormationServices', 'industries', 'testimonials', 'averageRating', 'totalReviews'));
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

        $blogs = $query->latest()->paginate(3)->appends(request()->query());
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

    public function blogCategory($slug)
    {
        $category = \App\Models\BlogCategory::where('slug', $slug)->firstOrFail();
        
        $query = Blog::where('blog_category_id', $category->id)->where('is_published', true);

        if (request()->filled('search')) {
            $search = request('search');
            $query->where(function ($builder) use ($search) {
                $builder->where('title', 'like', "%{$search}%")
                    ->orWhere('excerpt', 'like', "%{$search}%")
                    ->orWhere('content', 'like', "%{$search}%");
            });
        }

        $blogs = $query->orderBy('sort_order')->orderBy('published_date', 'desc')->paginate(9)->appends(request()->query());
        $recentBlogs = Blog::where('is_published', true)->orderBy('published_date', 'desc')->take(3)->get();
        
        return view('blog-category', compact('category', 'blogs', 'recentBlogs'));
    }

    public function blog($slug)
    {
        $blog = Blog::with(['category', 'tags'])->where('slug', $slug)->where('is_published', true)->firstOrFail();
        
        $relatedBlogs = collect();
        if ($blog->category) {
            $relatedBlogs = Blog::where('blog_category_id', $blog->blog_category_id)
                                ->where('is_published', true)
                                ->where('id', '!=', $blog->id)
                                ->orderBy('published_date', 'desc')
                                ->take(3)
                                ->get();
        }
        
        $recentBlogs = Blog::where('is_published', true)->latest()->take(3)->get();
        $categories = \App\Models\BlogCategory::withCount('blogs')->orderBy('name')->get();
        $tags = \App\Models\BlogTag::withCount('blogs')->orderBy('name')->get();
        $archives = Blog::where('is_published', true)
            ->selectRaw("DATE_FORMAT(created_at, '%Y-%m') as month, count(*) as total")
            ->groupBy('month')
            ->orderBy('month', 'desc')
            ->get();
        
        return view('blog', compact('blog', 'relatedBlogs', 'recentBlogs', 'categories', 'tags', 'archives'));
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
