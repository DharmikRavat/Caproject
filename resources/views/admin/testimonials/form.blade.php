@extends('layouts.admin')

@section('content')
<div class="container py-5">
    <h1 class="section-title mb-4">{{ isset($testimonial->id) ? 'Edit Testimonial' : 'Create Testimonial' }}</h1>

    <form action="{{ $route }}" method="POST" enctype="multipart/form-data" class="card border-0 shadow-sm p-4">
        @csrf
        @if(isset($testimonial->id))
            @method('PUT')
        @endif

        <div class="row g-3">
            <div class="col-md-6">
                <label class="form-label">Client Name (Author)</label>
                <input type="text" name="author" class="form-control" value="{{ old('author', $testimonial->author ?? '') }}" required>
            </div>
            <div class="col-md-6">
                <label class="form-label">Rating (1-5)</label>
                <input type="number" name="rating" min="1" max="5" class="form-control" value="{{ old('rating', $testimonial->rating ?? 5) }}" required>
            </div>
            
            <div class="col-md-6">
                <label class="form-label">Client Photo (optional)</label>
                <input type="file" name="author_image" class="form-control" accept="image/*">
                @if(isset($testimonial->author_image) && $testimonial->author_image)
                    <small class="text-muted d-block mt-1">Current: <a href="{{ Storage::url($testimonial->author_image) }}" target="_blank">View image</a></small>
                @endif
            </div>
            <div class="col-md-6">
                <label class="form-label">Status</label>
                <select name="is_active" class="form-select">
                    <option value="1" {{ old('is_active', $testimonial->is_active ?? 1) == 1 ? 'selected' : '' }}>Active</option>
                    <option value="0" {{ old('is_active', $testimonial->is_active ?? 1) == 0 ? 'selected' : '' }}>Inactive</option>
                </select>
            </div>
            
            <div class="col-12">
                <label class="form-label">Review Content</label>
                <textarea name="content" class="form-control" rows="4" required>{{ old('content', $testimonial->content ?? '') }}</textarea>
            </div>
            
            <div class="col-12 mt-4">
                <button type="submit" class="btn btn-primary-custom">Save</button>
                <a href="{{ route('admin.testimonials.index') }}" class="btn btn-outline-secondary">Cancel</a>
            </div>
        </div>
    </form>
</div>
@endsection
