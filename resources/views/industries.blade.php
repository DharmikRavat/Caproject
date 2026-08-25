@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="text-center mb-5">
        <span class="badge badge-soft px-3 py-2 rounded-pill mb-2">Industries</span>
        <h1 class="section-title display-6 fw-bold">Sector-specific solutions for modern businesses</h1>
    </div>

    <div class="row g-4">
        @foreach($industries as $industry)
            <div class="col-md-6 col-lg-4">
                <div class="card h-100 border-0 shadow-sm card-hover">
                    <div class="card-body p-4">
                        <div class="display-6 mb-3">{{ $industry->icon ?? '🏢' }}</div>
                        <h5 class="fw-bold">{{ $industry->name }}</h5>
                        <p class="text-muted">{{ Str::limit($industry->description, 170) }}</p>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
