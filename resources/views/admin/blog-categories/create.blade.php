@extends('layouts.admin')

@section('content')
<div class="container py-5">
    <div class="mb-4">
        <a href="{{ route('admin.blog-categories.index') }}" class="btn btn-outline-secondary btn-sm"><i class="fas fa-arrow-left me-2"></i>Back to Categories</a>
    </div>

    <div class="card shadow-sm border-0 max-w-2xl mx-auto">
        <div class="card-header bg-white py-3">
            <h5 class="mb-0 text-slate-800">Add New Blog Category</h5>
        </div>
        <div class="card-body p-4">
            <form action="{{ route('admin.blog-categories.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Category Name</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" required autofocus>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="text-end mt-4">
                    <button type="submit" class="btn btn-primary px-4">Create Category</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
