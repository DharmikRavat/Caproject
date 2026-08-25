@extends('layouts.admin')

@section('content')
<div class="container py-5">
    <h1 class="section-title mb-4">{{ isset($banner->id) ? 'Edit banner' : 'Create banner' }}</h1>

    <form action="{{ $route }}" method="POST" enctype="multipart/form-data" class="card border-0 shadow-sm p-4">
        @csrf
        @if(isset($banner->id))
            @method('PUT')
        @endif

        <div class="row g-3">
            <div class="col-md-6">
                <label class="form-label">Title</label>
                <input type="text" name="title" class="form-control" value="{{ old('title', $banner->title ?? '') }}" required>
            </div>
            <div class="col-md-6">
                <label class="form-label">Subtitle</label>
                <input type="text" name="subtitle" class="form-control" value="{{ old('subtitle', $banner->subtitle ?? '') }}">
            </div>
            <div class="col-md-6">
                <label class="form-label">Hero image</label>
                <input type="file" name="image" class="form-control" accept="image/jpeg,image/png,image/webp">
                @if($banner->getAttribute('image'))<small class="text-muted d-block mt-1"><a href="{{ Storage::url($banner->getAttribute('image')) }}" target="_blank">View current image</a></small>@endif
            </div>
            <div class="col-md-6">
                <label class="form-label">Button text</label>
                <input type="text" name="button_text" class="form-control" value="{{ old('button_text', $banner->button_text ?? '') }}">
            </div>
            <div class="col-md-6">
                <label class="form-label">Link</label>
                <input type="text" name="link" class="form-control" value="{{ old('link', $banner->link ?? '') }}">
            </div>
            <div class="col-12">
                <label class="form-label">Status</label>
                <select name="is_active" class="form-select">
                    <option value="1" {{ old('is_active', $banner->is_active ?? 1) == 1 ? 'selected' : '' }}>Active</option>
                    <option value="0" {{ old('is_active', $banner->is_active ?? 1) == 0 ? 'selected' : '' }}>Inactive</option>
                </select>
            </div>
            <div class="col-12">
                <button type="submit" class="btn btn-primary-custom">Save</button>
                <a href="{{ route('admin.banners.index') }}" class="btn btn-outline-secondary">Cancel</a>
            </div>
        </div>
    </form>
</div>
@endsection
