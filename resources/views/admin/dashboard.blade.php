@extends('layouts.admin')

@section('content')
<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <span class="badge badge-soft px-3 py-2 rounded-pill mb-2">Admin panel</span>
            <h1 class="section-title mb-0">Dashboard</h1>
        </div>
        <a href="{{ route('home') }}" class="btn btn-outline-primary">View website</a>
    </div>

    <h4 class="mb-3">Quick Links</h4>
    <div class="row g-3 mb-5">
        <div class="col-md-3">
            <a href="{{ route('admin.services.index') }}" class="btn btn-outline-primary w-100">Services & Formations</a>
        </div>
        <div class="col-md-3">
            <a href="{{ route('admin.industries.index') }}" class="btn btn-outline-primary w-100">Manage Industries</a>
        </div>
        <div class="col-md-3">
            <a href="{{ route('admin.banners.index') }}" class="btn btn-outline-primary w-100">Manage Hero Banners</a>
        </div>
        <div class="col-md-3">
            <a href="{{ route('admin.blogs.index') }}" class="btn btn-outline-primary w-100">Manage Blogs</a>
        </div>
        <div class="col-md-3">
            <a href="{{ route('admin.careers.index') }}" class="btn btn-outline-primary w-100">Manage Careers</a>
        </div>
        <div class="col-md-3">
            <a href="{{ route('admin.team-members.index') }}" class="btn btn-outline-primary w-100">Manage Team</a>
        </div>
        <div class="col-md-3">
            <a href="{{ route('admin.testimonials.index') }}" class="btn btn-outline-primary w-100">Manage Testimonials</a>
        </div>
        <div class="col-md-3">
            <a href="{{ route('admin.site-settings.index') }}" class="btn btn-outline-primary w-100">Global Site Settings</a>
        </div>
        <div class="col-md-3">
            <a href="{{ route('admin.links.edit') }}" class="btn btn-outline-primary w-100">Manage Important Links</a>
        </div>
    </div>

    <h4 class="mb-3">Statistics</h4>
    <div class="row g-4">
        @foreach([
            ['Services', $stats['services'], 'fas fa-file-contract'],
            ['Testimonials', $stats['testimonials'], 'fas fa-star'],
            ['Industries', $stats['industries'], 'fas fa-industry'],
            ['Blogs', $stats['blogs'], 'fas fa-newspaper'],
            ['Careers', $stats['careers'], 'fas fa-briefcase'],
            ['Enquiries', $stats['contact_enquiries'], 'fas fa-envelope'],
            ['Applications', $stats['job_applications'], 'fas fa-file-alt'],
        ] as $stat)
            <div class="col-md-6 col-lg-3">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body p-4">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <div class="text-muted small">{{ $stat[0] }}</div>
                                <div class="display-6 fw-bold">{{ $stat[1] }}</div>
                            </div>
                            <div class="bg-light rounded-3 p-3"><i class="{{ $stat[2] }}"></i></div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
