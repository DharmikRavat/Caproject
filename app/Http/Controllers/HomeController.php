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
            'blogs' => Blog::count(),
            'careers' => Career::count(),
            'team_members' => TeamMember::count(),
            'banners' => Banner::count(),
            'contact_enquiries' => ContactEnquiry::count(),
            'job_applications' => JobApplication::count(),
        ];

        // Fetch Business Registration services for the home page
        $businessRegistrationCategory = \App\Models\ServiceCategory::where('slug', 'business-registration')->first();
        $businessRegistrationServices = $businessRegistrationCategory 
            ? $businessRegistrationCategory->services()->where('status', true)->orderBy('sort_order')->get() 
            : collect();

        return view('admin.dashboard', compact('stats', 'businessRegistrationServices'));
    }
}
