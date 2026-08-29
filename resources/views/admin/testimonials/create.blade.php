@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0 text-gray-800">Add Review</h1>
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
            <form action="{{ route('admin.testimonials.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Client Name *</label>
                        <input type="text" name="author" class="form-control" value="{{ old('author') }}" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Client Role / Company</label>
                        <input type="text" name="author_role" class="form-control" value="{{ old('author_role') }}">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Client Image</label>
                        <input type="file" name="author_image" class="form-control">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Rating *</label>
                        <select name="rating" class="form-control" required>
                            <option value="5" {{ old('rating') == '5' ? 'selected' : '' }}>5 Stars</option>
                            <option value="4" {{ old('rating') == '4' ? 'selected' : '' }}>4 Stars</option>
                            <option value="3" {{ old('rating') == '3' ? 'selected' : '' }}>3 Stars</option>
                            <option value="2" {{ old('rating') == '2' ? 'selected' : '' }}>2 Stars</option>
                            <option value="1" {{ old('rating') == '1' ? 'selected' : '' }}>1 Star</option>
                        </select>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Review Source (e.g., Google)</label>
                        <input type="text" name="source" class="form-control" value="{{ old('source', 'Google') }}">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Review Date</label>
                        <input type="date" name="review_date" class="form-control" value="{{ old('review_date') }}">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Display Order</label>
                        <input type="number" name="sort_order" class="form-control" value="{{ old('sort_order', 0) }}">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Options</label>
                        <div class="d-flex mt-2">
                            <div class="form-check form-switch me-4">
                                <input class="form-check-input" type="checkbox" name="is_active" id="is_active" value="1" {{ old('is_active', '1') == '1' ? 'checked' : '' }}>
                                <label class="form-check-label" for="is_active">Active</label>
                            </div>
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" name="is_verified" id="is_verified" value="1" {{ old('is_verified', '1') == '1' ? 'checked' : '' }}>
                                <label class="form-check-label" for="is_verified">Verified</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label class="form-label">Review Text *</label>
                        <textarea name="content" class="form-control" rows="5" required>{{ old('content') }}</textarea>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Save Review</button>
            </form>
        </div>
    </div>
</div>
@endsection
