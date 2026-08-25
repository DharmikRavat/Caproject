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
        $caServices = Service::where('is_active', true)->where('category', 'ca_services')->latest()->get();
        $businessRegistration = Service::where('is_active', true)->where('category', 'business_registration')->latest()->get();
        $companyFormation = Service::where('is_active', true)->where('category', 'company_formation')->latest()->get();
        $groupedServices = Service::where('is_active', true)->latest()->get()->groupBy('category');
        $industries = Industry::where('is_active', true)->latest()->take(4)->get();
        $testimonials = \App\Models\Testimonial::where('is_active', true)->latest()->get();
        $siteSettings = \App\Models\SiteSetting::pluck('value', 'key');
        $blogs = Blog::where('is_published', true)->latest()->take(3)->get();
        $teamMembers = TeamMember::where('is_active', true)->latest()->take(4)->get();

        return view('home', compact('banners', 'caServices', 'businessRegistration', 'companyFormation', 'groupedServices', 'industries', 'blogs', 'teamMembers', 'testimonials', 'siteSettings'));
    }

    public function about()
    {
        $teamMembers = TeamMember::where('is_active', true)->latest()->get();
        return view('about', compact('teamMembers'));
    }

    public function services()
    {
        $servicesQuery = Service::where('is_active', true);

        if (request()->filled('category')) {
            $servicesQuery->where('category', request()->query('category'));
        }

        $services = $servicesQuery->latest()->get();
        return view('services', compact('services'));
    }

    public function service($slug)
    {
        $service = Service::where('slug', $slug)->where('is_active', true)->firstOrFail();
        return view('service', compact('service'));
    }

    public function industries()
    {
        $industries = Industry::where('is_active', true)->latest()->get();
        return view('industries', compact('industries'));
    }

    public function blogs()
    {
        $blogs = Blog::where('is_published', true)->latest()->get();
        return view('blogs', compact('blogs'));
    }

    public function blog($slug)
    {
        $blog = Blog::where('slug', $slug)->where('is_published', true)->firstOrFail();
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
}
