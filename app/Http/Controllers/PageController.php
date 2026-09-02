<?php

namespace App\Http\Controllers;

use App\Models\BlogArchive;
use App\Models\Blog;
use App\Models\Career;
use App\Models\ContactEnquiry;
use App\Models\Industry;
use App\Models\JobApplication;
use App\Models\Service;
use App\Models\TeamMember;
use App\Models\Banner;
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



    private function getBlogSidebarData()
    {
        $recentBlogs = Blog::where('is_published', true)->orderBy('published_date', 'desc')->take(3)->get();
        $categories = \App\Models\BlogCategory::where('is_active', true)->withCount(['blogs' => function($q) { $q->where('is_published', true); }])->orderBy('name')->get();
        $tags = \App\Models\BlogTag::withCount(['blogs' => function($q) { $q->where('is_published', true); }])->orderBy('name')->get();
        
        $archives = BlogArchive::withCount(['blogs' => function($q) { $q->where('is_published', true); }])
            ->where('is_active', true)
            ->whereHas('blogs', function($q) { $q->where('is_published', true); })
            ->orderBy('created_at', 'desc')
            ->get();
            
        return compact('recentBlogs', 'categories', 'tags', 'archives');
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
            $parts = explode('-', $month);
            if (count($parts) == 2) {
                $query->whereYear('created_at', $parts[0])->whereMonth('created_at', $parts[1]);
            }
        }

        $blogs = $query->orderBy('published_date', 'desc')->paginate(9)->appends(request()->query());
        $sidebarData = $this->getBlogSidebarData();

        return view('blogs', array_merge(compact('blogs'), $sidebarData));
    }

    public function blogCategory($slug)
    {
        $category = \App\Models\BlogCategory::where('slug', $slug)->where('is_active', true)->firstOrFail();
        
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
        $sidebarData = $this->getBlogSidebarData();
        
        return view('blog-category', array_merge(compact('category', 'blogs'), $sidebarData));
    }

    public function blogTag($slug)
    {
        $tag = \App\Models\BlogTag::where('slug', $slug)->firstOrFail();
        
        $query = $tag->blogs()->where('is_published', true);

        if (request()->filled('search')) {
            $search = request('search');
            $query->where(function ($builder) use ($search) {
                $builder->where('title', 'like', "%{$search}%")
                    ->orWhere('excerpt', 'like', "%{$search}%")
                    ->orWhere('content', 'like', "%{$search}%");
            });
        }

        $blogs = $query->orderBy('published_date', 'desc')->paginate(9)->appends(request()->query());
        $sidebarData = $this->getBlogSidebarData();
        
        return view('blog-tag', array_merge(compact('tag', 'blogs'), $sidebarData));
    }

    public function blogArchive($slug)
    {
        $archive = BlogArchive::where('slug', $slug)
            ->where('is_active', true)
            ->firstOrFail();

        $blogsQuery = Blog::with(['category', 'tags'])
            ->where('is_published', true)
            ->where('blog_archive_id', $archive->id);

        if (request('search')) {
            $search = request('search');
            $blogsQuery->where(function($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('content', 'like', "%{$search}%");
            });
        }

        $blogs = $blogsQuery->orderBy('published_date', 'desc')
            ->orderBy('created_at', 'desc')
            ->paginate(6);

        $sidebarData = $this->getBlogSidebarData();

        return view('blog-archive', array_merge([
            'blogs' => $blogs,
            'archive' => $archive
        ], $sidebarData));
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
        
        $sidebarData = $this->getBlogSidebarData();
        
        return view('blog', array_merge(compact('blog', 'relatedBlogs'), $sidebarData));
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
        $serviceCategories = \App\Models\ServiceCategory::with(['services' => function($q) { $q->where('status', true); }])->whereNull('parent_id')->where('status', true)->orderBy('sort_order')->get();
        return view('contact', compact('serviceCategories'));
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
