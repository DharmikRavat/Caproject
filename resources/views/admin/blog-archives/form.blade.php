@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0 text-gray-800">{{ isset($blogArchive) ? 'Edit Archive' : 'Add Archive' }}</h1>
        <a href="{{ route('admin.blog-archives.index') }}" class="btn btn-secondary">
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
            <form action="{{ $route ?? route('admin.blog-archives.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @if(isset($blogArchive) && $blogArchive->exists)
                    @method('PUT')
                @endif
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Archive Name *</label>
                        <input type="text" name="name" class="form-control" value="{{ old('name', $blogArchive->name ?? '') }}" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Slug (optional, auto-generated)</label>
                        <input type="text" name="slug" class="form-control" value="{{ old('slug', $blogArchive->slug ?? '') }}">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Banner Image</label>
                        <input type="file" name="banner_image" class="form-control">
                        @if(isset($blogArchive) && $blogArchive->banner_image)
                            <div class="mt-2">
                                <img src="{{ Storage::url($blogArchive->banner_image) }}" class="img-thumbnail" style="max-height: 100px;">
                            </div>
                        @endif
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Archive Thumbnail / Image</label>
                        <input type="file" name="image" class="form-control">
                        @if(isset($blogArchive) && $blogArchive->image)
                            <div class="mt-2">
                                <img src="{{ Storage::url($blogArchive->image) }}" class="img-thumbnail" style="max-height: 100px;">
                            </div>
                        @endif
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Display Order</label>
                        <input type="number" name="sort_order" class="form-control" value="{{ old('sort_order', $blogArchive->sort_order ?? 0) }}">
                    </div>
                    <div class="col-md-12 mb-3">
                        <label class="form-label">Description</label>
                        <textarea name="description" class="form-control" rows="3">{{ old('description', $blogArchive->description ?? '') }}</textarea>
                    </div>

                    <!-- Assign Blogs -->
                    <div class="col-md-12 mt-4 mb-2">
                        <h5 class="border-bottom pb-2">Assign Blogs</h5>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label class="form-label">Select Blogs (Hold Ctrl/Cmd to select multiple)</label>
                        <select name="blogs[]" class="form-control" multiple size="8">
                            @php
                                $selectedBlogs = old('blogs', isset($blogArchive) ? $blogArchive->blogs->pluck('id')->toArray() : []);
                            @endphp
                            @foreach($allBlogs ?? [] as $blog)
                                <option value="{{ $blog->id }}" {{ in_array($blog->id, $selectedBlogs) ? 'selected' : '' }}>
                                    {{ $blog->title }}
                                </option>
                            @endforeach
                        </select>
                        <small class="form-text text-muted">Selected blogs will be assigned to this Archive, and removed from any previous Archive.</small>
                    </div>
                    

                    <div class="col-md-12 mb-3 mt-3">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" name="is_active" id="is_active" value="1" {{ old('is_active', $blogArchive->is_active ?? '1') == '1' ? 'checked' : '' }}>
                            <label class="form-check-label" for="is_active">Active</label>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Save Archive</button>
            </form>
        </div>
    </div>
</div>
@endsection
