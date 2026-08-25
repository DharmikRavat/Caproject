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

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $stats = [
            'services' => Service::count(),
            'testimonials' => \App\Models\Testimonial::count(),
            'blogs' => Blog::count(),
            'industries' => Industry::count(),
            'careers' => Career::count(),
            'team_members' => TeamMember::count(),
            'banners' => Banner::count(),
            'contact_enquiries' => ContactEnquiry::count(),
            'job_applications' => JobApplication::count(),
        ];

        return view('admin.dashboard', compact('stats'));
    }
}
