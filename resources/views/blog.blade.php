@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <span class="badge badge-soft px-3 py-2 rounded-pill mb-3">Blog</span>
            <h1 class="section-title display-6 fw-bold">{{ $blog->title }}</h1>
            <p class="text-muted mb-4">By {{ $blog->author }} • {{ $blog->created_at->format('d M Y') }}</p>
            <div class="text-muted">
                {!! nl2br(e($blog->content)) !!}
            </div>
        </div>
    </div>
</div>
@endsection
