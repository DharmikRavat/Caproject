@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row g-5">
        <div class="col-lg-8">
            <span class="badge badge-soft px-3 py-2 rounded-pill mb-3">Career opportunity</span>
            <h1 class="section-title display-6 fw-bold">{{ $career->title }}</h1>
            <div class="d-flex flex-wrap gap-2 mb-3">
                <span class="badge bg-light text-dark">{{ $career->location }}</span>
                <span class="badge bg-light text-dark">{{ $career->type }}</span>
                <span class="badge bg-light text-dark">{{ $career->experience }}</span>
            </div>
            <p class="lead text-muted">{{ $career->summary }}</p>
            <div class="text-muted">
                {!! nl2br(e($career->description)) !!}
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card border-0 shadow-sm rounded-4 p-4">
                <h5 class="fw-bold mb-3">Apply now</h5>
                <form method="POST" action="{{ route('career.apply', $career->slug) }}" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Full name</label>
                        <input type="text" name="name" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Phone</label>
                        <input type="text" name="phone" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Resume</label>
                        <input type="file" name="resume" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Cover letter</label>
                        <textarea name="cover_letter" class="form-control" rows="4"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary-custom w-100">Submit application</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
