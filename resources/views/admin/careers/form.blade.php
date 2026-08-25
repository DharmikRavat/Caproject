@extends('layouts.admin')

@section('content')
<div class="container py-5">
    <h1 class="section-title mb-4">{{ isset($career->id) ? 'Edit career' : 'Create career' }}</h1>

    <form action="{{ $route }}" method="POST" class="card border-0 shadow-sm p-4">
        @csrf
        @if(isset($career->id))
            @method('PUT')
        @endif

        <div class="row g-3">
            <div class="col-md-6">
                <label class="form-label">Title</label>
                <input type="text" name="title" class="form-control" value="{{ old('title', $career->title ?? '') }}" required>
            </div>
            <div class="col-md-6">
                <label class="form-label">Slug</label>
                <input type="text" name="slug" class="form-control" value="{{ old('slug', $career->slug ?? '') }}">
            </div>
            <div class="col-md-4">
                <label class="form-label">Location</label>
                <input type="text" name="location" class="form-control" value="{{ old('location', $career->location ?? '') }}">
            </div>
            <div class="col-md-4">
                <label class="form-label">Type</label>
                <input type="text" name="type" class="form-control" value="{{ old('type', $career->type ?? '') }}">
            </div>
            <div class="col-md-4">
                <label class="form-label">Experience</label>
                <input type="text" name="experience" class="form-control" value="{{ old('experience', $career->experience ?? '') }}">
            </div>
            <div class="col-12">
                <label class="form-label">Summary</label>
                <textarea name="summary" class="form-control" rows="3">{{ old('summary', $career->summary ?? '') }}</textarea>
            </div>
            <div class="col-12">
                <label class="form-label">Description</label>
                <textarea name="description" class="form-control" rows="6" required>{{ old('description', $career->description ?? '') }}</textarea>
            </div>
            <div class="col-12">
                <label class="form-label">Status</label>
                <select name="is_active" class="form-select">
                    <option value="1" {{ old('is_active', $career->is_active ?? 1) == 1 ? 'selected' : '' }}>Active</option>
                    <option value="0" {{ old('is_active', $career->is_active ?? 1) == 0 ? 'selected' : '' }}>Inactive</option>
                </select>
            </div>
            <div class="col-12">
                <button type="submit" class="btn btn-primary-custom">Save</button>
                <a href="{{ route('admin.careers.index') }}" class="btn btn-outline-secondary">Cancel</a>
            </div>
        </div>
    </form>
</div>
@endsection
