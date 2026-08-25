@extends('layouts.admin')

@section('content')
<div class="container py-5">
    <h1 class="section-title mb-4">{{ isset($industry->id) ? 'Edit industry' : 'Create industry' }}</h1>

    <form action="{{ $route }}" method="POST" enctype="multipart/form-data" class="card border-0 shadow-sm p-4">
        @csrf
        @if(isset($industry->id))
            @method('PUT')
        @endif

        <div class="row g-3">
            <div class="col-md-6">
                <label class="form-label">Name</label>
                <input type="text" name="name" class="form-control" value="{{ old('name', $industry->name ?? '') }}" required>
            </div>
            <div class="col-md-6">
                <label class="form-label">Slug</label>
                <input type="text" name="slug" class="form-control" value="{{ old('slug', $industry->slug ?? '') }}">
            </div>
            <div class="col-md-4">
                <label class="form-label">Image (optional)</label>
                <input type="file" name="image" class="form-control" accept="image/*">
                @if(isset($industry->image) && $industry->image)
                    <small class="text-muted d-block mt-1">Current: <a href="{{ Storage::url($industry->image) }}" target="_blank">View image</a></small>
                @endif
            </div>
            <div class="col-md-4">
                <label class="form-label">Icon Class</label>
                <input type="text" name="icon" class="form-control" value="{{ old('icon', $industry->icon ?? '') }}" placeholder="e.g. fa-industry">
            </div>
            <div class="col-md-4">
                <label class="form-label">Status</label>
                <select name="is_active" class="form-select">
                    <option value="1" {{ old('is_active', $industry->is_active ?? 1) == 1 ? 'selected' : '' }}>Active</option>
                    <option value="0" {{ old('is_active', $industry->is_active ?? 1) == 0 ? 'selected' : '' }}>Inactive</option>
                </select>
            </div>
            <div class="col-12">
                <label class="form-label">Description</label>
                <textarea name="description" class="form-control" rows="5">{{ old('description', $industry->description ?? '') }}</textarea>
            </div>
            <div class="col-12">
                <button type="submit" class="btn btn-primary-custom">Save</button>
                <a href="{{ route('admin.industries.index') }}" class="btn btn-outline-secondary">Cancel</a>
            </div>
        </div>
    </form>
</div>
@endsection
