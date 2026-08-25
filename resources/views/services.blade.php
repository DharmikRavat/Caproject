@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="text-center mb-5">
        <span class="badge badge-soft px-3 py-2 rounded-pill mb-2">Services</span>
        <h1 class="section-title display-6 fw-bold">Financial and compliance solutions designed around your goals</h1>
    </div>

    <div class="row g-4">
        @foreach($services as $service)
            <div class="col-md-6 col-lg-4">
                <div class="card h-100 border-0 shadow-sm card-hover">
                    <div class="card-body p-4">
                        <div class="display-6 mb-3">{{ $service->icon ?? '📌' }}</div>
                        <h5 class="fw-bold">{{ $service->title }}</h5>
                        <p class="text-muted">{{ Str::limit($service->short_description ?? $service->description, 140) }}</p>
                        <a href="{{ route('service.show', $service->slug) }}" class="btn btn-link px-0">Explore service</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
