@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0 text-gray-800">Edit Review</h1>
        <a href="{{ route('admin.testimonials.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left fa-sm text-white-50"></i> Back
        </a>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card shadow mb-4">
        <div class="card-body">
            <form action="{{ route('admin.testimonials.update', $testimonial) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Client Name *</label>
                        <input type="text" name="author" class="form-control" value="{{ old('author', $testimonial->author) }}" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Client Role / Company</label>
                        <input type="text" name="author_role" class="form-control" value="{{ old('author_role', $testimonial->author_role) }}">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Client Image</label>
                        <input type="file" name="author_image" class="form-control">
                        @if($testimonial->author_image)
                            <div class="mt-2">
                                <img src="{{ Storage::url($testimonial->author_image) }}" alt="Current Image" class="img-thumbnail" style="max-height: 80px; border-radius: 50%;">
                            </div>
                        @endif
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Rating *</label>
                        <select name="rating" class="form-control" required>
                            <option value="5" {{ old('rating', $testimonial->rating) == '5' ? 'selected' : '' }}>5 Stars</option>
                            <option value="4" {{ old('rating', $testimonial->rating) == '4' ? 'selected' : '' }}>4 Stars</option>
                            <option value="3" {{ old('rating', $testimonial->rating) == '3' ? 'selected' : '' }}>3 Stars</option>
                            <option value="2" {{ old('rating', $testimonial->rating) == '2' ? 'selected' : '' }}>2 Stars</option>
                            <option value="1" {{ old('rating', $testimonial->rating) == '1' ? 'selected' : '' }}>1 Star</option>
                        </select>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Review Source (e.g., Google)</label>
                        <input type="text" name="source" class="form-control" value="{{ old('source', $testimonial->source) }}">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Review Date</label>
                        <input type="date" name="review_date" class="form-control" value="{{ old('review_date', $testimonial->review_date ? \Carbon\Carbon::parse($testimonial->review_date)->format('Y-m-d') : '') }}">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Display Order</label>
                        <input type="number" name="sort_order" class="form-control" value="{{ old('sort_order', $testimonial->sort_order) }}">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Options</label>
                        <div class="d-flex mt-2">
                            <div class="form-check form-switch me-4">
                                <input class="form-check-input" type="checkbox" name="is_active" id="is_active" value="1" {{ old('is_active', $testimonial->is_active) ? 'checked' : '' }}>
                                <label class="form-check-label" for="is_active">Active</label>
                            </div>
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" name="is_verified" id="is_verified" value="1" {{ old('is_verified', $testimonial->is_verified) ? 'checked' : '' }}>
                                <label class="form-check-label" for="is_verified">Verified</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label class="form-label">Review Text *</label>
                        <textarea name="content" class="form-control" rows="5" required>{{ old('content', $testimonial->content) }}</textarea>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Update Review</button>
            </form>
        </div>
    </div>
</div>
@endsection
