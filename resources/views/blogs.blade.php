@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="text-center mb-5">
        <span class="badge badge-soft px-3 py-2 rounded-pill mb-2">Blogs</span>
        <h1 class="section-title display-6 fw-bold">Insights for better financial decisions</h1>
    </div>

    <div class="row g-4">
        @foreach($blogs as $blog)
            <div class="col-md-6 col-lg-4">
                <div class="card h-100 border-0 shadow-sm card-hover">
                    <div class="card-body p-4">
                        <p class="text-primary fw-semibold mb-2">{{ $blog->author }}</p>
                        <h5 class="fw-bold">{{ $blog->title }}</h5>
                        <p class="text-muted">{{ Str::limit($blog->excerpt ?? $blog->content, 140) }}</p>
                        <a href="{{ route('blog.show', $blog->slug) }}" class="btn btn-link px-0">Read article</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
