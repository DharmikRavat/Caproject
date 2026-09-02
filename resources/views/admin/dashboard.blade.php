@extends('layouts.admin')
@section('title', 'Dashboard')

@section('content')
<div class="container-fluid px-4 py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <span class="badge badge-soft px-3 py-2 rounded-pill mb-2">Admin panel</span>
            <h1 class="section-title mb-0" style="font-size: 1.5rem;">Dashboard</h1>
        </div>
        <a href="{{ route('home') }}" class="btn btn-outline-primary btn-sm px-3 py-1">View website</a>
    </div>

    <h4 class="mb-3 text-secondary" style="font-size: 0.9rem; font-weight: 600;">Quick Links</h4>
    <div class="d-flex flex-wrap gap-2 mb-4">
        <a href="{{ route('admin.banners.index') }}" class="btn btn-outline-primary py-1 px-3 border-1" style="font-size: 0.8rem; border-radius: 6px;">Manage Hero Banners</a>
        <a href="{{ route('admin.blogs.index') }}" class="btn btn-outline-primary py-1 px-3 border-1" style="font-size: 0.8rem; border-radius: 6px;">Manage Blogs</a>
        <a href="{{ route('admin.careers.index') }}" class="btn btn-outline-primary py-1 px-3 border-1" style="font-size: 0.8rem; border-radius: 6px;">Manage Careers</a>
        <a href="{{ route('admin.team-members.index') }}" class="btn btn-outline-primary py-1 px-3 border-1" style="font-size: 0.8rem; border-radius: 6px;">Manage Team</a>
        <a href="{{ route('admin.site-settings.index') }}" class="btn btn-outline-primary py-1 px-3 border-1" style="font-size: 0.8rem; border-radius: 6px;">Global Site Settings</a>
        <a href="{{ route('admin.links.edit') }}" class="btn btn-outline-primary py-1 px-3 border-1" style="font-size: 0.8rem; border-radius: 6px;">Manage Important Links</a>
    </div>

    <h4 class="mb-3 text-secondary" style="font-size: 0.9rem; font-weight: 600;">Statistics</h4>
    <div class="row g-3">
        <div class="col-12 col-sm-6 col-lg-3">
            <div class="card bg-white border-0 shadow-sm h-100" style="margin-bottom: 0; border-radius: 8px;">
                <div class="card-body p-3 d-flex align-items-center justify-content-between">
                    <div>
                        <h6 class="text-muted mb-1 fw-bold text-uppercase" style="font-size: 0.65rem; letter-spacing: 0.5px;">Blogs</h6>
                        <h2 class="mb-0 fw-bolder text-dark" style="font-size: 1.25rem;">{{ \App\Models\Blog::count() }}</h2>
                    </div>
                    <div class="rounded bg-primary bg-opacity-10 d-flex align-items-center justify-content-center" style="width: 32px; height: 32px;">
                        <i class="fas fa-newspaper text-primary" style="font-size: 0.85rem;"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-lg-3">
            <div class="card bg-white border-0 shadow-sm h-100" style="margin-bottom: 0; border-radius: 8px;">
                <div class="card-body p-3 d-flex align-items-center justify-content-between">
                    <div>
                        <h6 class="text-muted mb-1 fw-bold text-uppercase" style="font-size: 0.65rem; letter-spacing: 0.5px;">Careers</h6>
                        <h2 class="mb-0 fw-bolder text-dark" style="font-size: 1.25rem;">{{ \App\Models\Career::count() }}</h2>
                    </div>
                    <div class="rounded bg-success bg-opacity-10 d-flex align-items-center justify-content-center" style="width: 32px; height: 32px;">
                        <i class="fas fa-briefcase text-success" style="font-size: 0.85rem;"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-lg-3">
            <div class="card bg-white border-0 shadow-sm h-100" style="margin-bottom: 0; border-radius: 8px;">
                <div class="card-body p-3 d-flex align-items-center justify-content-between">
                    <div>
                        <h6 class="text-muted mb-1 fw-bold text-uppercase" style="font-size: 0.65rem; letter-spacing: 0.5px;">Enquiries</h6>
                        <h2 class="mb-0 fw-bolder text-dark" style="font-size: 1.25rem;">{{ \App\Models\ContactEnquiry::count() }}</h2>
                    </div>
                    <div class="rounded bg-warning bg-opacity-10 d-flex align-items-center justify-content-center" style="width: 32px; height: 32px;">
                        <i class="fas fa-envelope text-warning" style="font-size: 0.85rem;"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-lg-3">
            <div class="card bg-white border-0 shadow-sm h-100" style="margin-bottom: 0; border-radius: 8px;">
                <div class="card-body p-3 d-flex align-items-center justify-content-between">
                    <div>
                        <h6 class="text-muted mb-1 fw-bold text-uppercase" style="font-size: 0.65rem; letter-spacing: 0.5px;">Applications</h6>
                        <h2 class="mb-0 fw-bolder text-dark" style="font-size: 1.25rem;">{{ \App\Models\JobApplication::count() }}</h2>
                    </div>
                    <div class="rounded bg-info bg-opacity-10 d-flex align-items-center justify-content-center" style="width: 32px; height: 32px;">
                        <i class="fas fa-file-alt text-info" style="font-size: 0.85rem;"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-lg-3">
            <div class="card bg-white border-0 shadow-sm h-100" style="margin-bottom: 0; border-radius: 8px;">
                <div class="card-body p-3 d-flex align-items-center justify-content-between">
                    <div>
                        <h6 class="text-muted mb-1 fw-bold text-uppercase" style="font-size: 0.65rem; letter-spacing: 0.5px;">Admin Users</h6>
                        <h2 class="mb-0 fw-bolder text-dark" style="font-size: 1.25rem;">{{ \App\Models\User::where('is_admin', true)->count() }}</h2>
                    </div>
                    <div class="rounded bg-secondary bg-opacity-10 d-flex align-items-center justify-content-center" style="width: 32px; height: 32px;">
                        <i class="fas fa-users-cog text-secondary" style="font-size: 0.85rem;"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
