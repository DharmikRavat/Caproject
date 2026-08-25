@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="text-center mb-5">
        <span class="badge badge-soft px-3 py-2 rounded-pill mb-2">Careers</span>
        <h1 class="section-title display-6 fw-bold">Join our team of financial professionals</h1>
    </div>

    <div class="row g-4">
        @foreach($careers as $career)
            <div class="col-md-6">
                <div class="card h-100 border-0 shadow-sm card-hover">
                    <div class="card-body p-4">
                        <h5 class="fw-bold">{{ $career->title }}</h5>
                        <p class="text-muted mb-2">{{ $career->location }} • {{ $career->type }}</p>
                        <p class="text-muted">{{ Str::limit($career->summary ?? $career->description, 140) }}</p>
                        <a href="{{ route('career.show', $career->slug) }}" class="btn btn-link px-0">View opening</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
