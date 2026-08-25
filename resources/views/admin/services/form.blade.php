@extends('layouts.admin')

@section('content')
<div class="container py-5">
    <h1 class="section-title mb-4">{{ isset($service->id) ? 'Edit service' : 'Create service' }}</h1>

    <form action="{{ $route }}" method="POST" enctype="multipart/form-data" class="card border-0 shadow-sm p-4">
        @csrf
        @if(isset($service->id))
            @method('PUT')
        @endif

        <div class="row g-3">
            <div class="col-md-6">
                <label class="form-label">Title</label>
                <input type="text" name="title" class="form-control" value="{{ old('title', $service->title ?? '') }}" required>
            </div>
            <div class="col-md-6">
                <label class="form-label">Slug</label>
                <input type="text" name="slug" class="form-control" value="{{ old('slug', $service->slug ?? '') }}">
            </div>
            <div class="col-md-4">
                <label class="form-label">Category</label>
                <input type="text" name="category" class="form-control" value="{{ old('category', $service->category ?? '') }}" placeholder="e.g. Direct Tax" required>
                <small class="text-muted">This category becomes a Services menu group on the website.</small>
            </div>
            <div class="col-md-4">
                <label class="form-label">Image (optional)</label>
                <input type="file" name="image" class="form-control" accept="image/*">
                @if(isset($service->image) && $service->image)
                    <small class="text-muted d-block mt-1">Current: <a href="{{ Storage::url($service->image) }}" target="_blank">View image</a></small>
                @endif
            </div>
            <div class="col-md-4">
                <label class="form-label">Icon Class (FontAwesome)</label>
                <input type="text" name="icon" class="form-control" value="{{ old('icon', $service->icon ?? '') }}" placeholder="e.g. fa-building">
            </div>
            <div class="col-md-6">
                <label class="form-label">Featured</label>
                <select name="featured" class="form-select">
                    <option value="0" {{ old('featured', $service->featured ?? 0) == 0 ? 'selected' : '' }}>No</option>
                    <option value="1" {{ old('featured', $service->featured ?? 0) == 1 ? 'selected' : '' }}>Yes</option>
                </select>
            </div>
            <div class="col-12">
                <label class="form-label">Short description</label>
                <textarea name="short_description" class="form-control" rows="3">{{ old('short_description', $service->short_description ?? '') }}</textarea>
            </div>
            <div class="col-12">
                <label class="form-label">Description</label>
                <textarea name="description" class="form-control" rows="6" required>{{ old('description', $service->description ?? '') }}</textarea>
            </div>
            <div class="col-12">
                <label class="form-label">Active</label>
                <select name="is_active" class="form-select">
                    <option value="1" {{ old('is_active', $service->is_active ?? 1) == 1 ? 'selected' : '' }}>Active</option>
                    <option value="0" {{ old('is_active', $service->is_active ?? 1) == 0 ? 'selected' : '' }}>Inactive</option>
                </select>
            </div>
            <div class="col-12">
                <button type="submit" class="btn btn-primary-custom">Save</button>
                <a href="{{ route('admin.services.index') }}" class="btn btn-outline-secondary">Cancel</a>
            </div>
        </div>
    </form>
</div>
@endsection
