@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0 text-gray-800">{{ isset($blogCategory) ? 'Edit Category' : 'Add Category' }}</h1>
        <a href="{{ route('admin.blog-categories.index') }}" class="btn btn-secondary">
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
            <form action="{{ $route ?? route('admin.blog-categories.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @if(isset($blogCategory) && $blogCategory->exists)
                    @method('PUT')
                @endif
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Category Name *</label>
                        <input type="text" name="name" class="form-control" value="{{ old('name', $blogCategory->name ?? '') }}" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Slug (optional, auto-generated)</label>
                        <input type="text" name="slug" class="form-control" value="{{ old('slug', $blogCategory->slug ?? '') }}">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Banner Image</label>
                        <input type="file" name="banner_image" class="form-control">
                        @if(isset($blogCategory) && $blogCategory->banner_image)
                            <div class="mt-2">
                                <img src="{{ Storage::url($blogCategory->banner_image) }}" class="img-thumbnail" style="max-height: 100px;">
                            </div>
                        @endif
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Display Order</label>
                        <input type="number" name="sort_order" class="form-control" value="{{ old('sort_order', $blogCategory->sort_order ?? 0) }}">
                    </div>
                    <div class="col-md-12 mb-3">
                        <label class="form-label">Description</label>
                        <textarea name="description" class="form-control" rows="3">{{ old('description', $blogCategory->description ?? '') }}</textarea>
                    </div>
                    <div class="col-md-12 mb-3">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" name="is_active" id="is_active" value="1" {{ old('is_active', $blogCategory->is_active ?? '1') == '1' ? 'checked' : '' }}>
                            <label class="form-check-label" for="is_active">Active</label>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Save Category</button>
            </form>
        </div>
    </div>
</div>
@endsection
