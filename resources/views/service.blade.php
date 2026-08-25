@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row g-5">
        <div class="col-lg-8">
            <span class="badge badge-soft px-3 py-2 rounded-pill mb-3">Service detail</span>
            <h1 class="section-title display-6 fw-bold">{{ $service->title }}</h1>
            <p class="lead text-muted">{{ $service->short_description }}</p>
            <div class="text-muted">
                {!! nl2br(e($service->description)) !!}
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card border-0 shadow-sm rounded-4 p-4">
                <h5 class="fw-bold mb-3">Need help?</h5>
                <p class="text-muted mb-3">Speak to our team about your requirements and we’ll help you plan the right next steps.</p>
                <a href="{{ route('contact') }}" class="btn btn-primary-custom w-100">Book a consultation</a>
            </div>
        </div>
    </div>
</div>
@endsection
