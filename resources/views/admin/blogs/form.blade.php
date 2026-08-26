@extends('layouts.admin')

@section('content')
<div class="container py-5">
    <h1 class="section-title mb-4">{{ isset($blog->id) ? 'Edit blog' : 'Create blog' }}</h1>

    <form action="{{ $route }}" method="POST" enctype="multipart/form-data" class="card border-0 shadow-sm p-4">
        @csrf
        @if(isset($blog->id))
            @method('PUT')
        @endif

        <div class="row g-3">
            <div class="col-md-6">
                <label class="form-label">Title</label>
                <input type="text" name="title" class="form-control" value="{{ old('title', $blog->title ?? '') }}" required>
            </div>
            <div class="col-md-6">
                <label class="form-label">Slug</label>
                <input type="text" name="slug" class="form-control" value="{{ old('slug', $blog->slug ?? '') }}">
            </div>
            <div class="col-md-6">
                <label class="form-label">Author</label>
                <input type="text" name="author" class="form-control" value="{{ old('author', $blog->author ?? '') }}">
            </div>
            <div class="col-md-6">
                <label class="form-label">Category</label>
                <input type="text" name="category" class="form-control" value="{{ old('category', $blog->category ?? '') }}" placeholder="Income Tax, GST, Compliance">
            </div>
            <div class="col-md-6">
                <label class="form-label">Tags</label>
                <input type="text" name="tags" class="form-control" value="{{ old('tags', $blog->tags ?? '') }}" placeholder="GST, Tax Planning, Audit">
            </div>
            <div class="col-md-6">
                <label class="form-label">Featured image</label>
                <input type="file" name="image" class="form-control" accept="image/jpeg,image/png,image/webp">
                @if($blog->getAttribute('image'))
                    @php($currentImage = $blog->getAttribute('image'))
                    <small class="text-muted d-block mt-1"><a href="{{ \Illuminate\Support\Str::startsWith($currentImage, ['http://', 'https://']) ? $currentImage : Storage::url($currentImage) }}" target="_blank">View current image</a></small>
                @endif
            </div>
            <div class="col-md-6">
                <label class="form-label">Featured image URL</label>
                <input type="url" name="image_url" class="form-control" value="{{ old('image_url', \Illuminate\Support\Str::startsWith($blog->getAttribute('image'), ['http://', 'https://']) ? $blog->getAttribute('image') : '') }}" placeholder="https://example.com/blog-image.jpg">
                <small class="text-muted">Use this instead of uploading a file.</small>
            </div>
            <div class="col-md-6">
                <label class="form-label">Published</label>
                <select name="is_published" class="form-select">
                    <option value="1" {{ old('is_published', $blog->is_published ?? 1) == 1 ? 'selected' : '' }}>Published</option>
                    <option value="0" {{ old('is_published', $blog->is_published ?? 1) == 0 ? 'selected' : '' }}>Draft</option>
                </select>
            </div>
            <div class="col-12">
                <label class="form-label">Excerpt</label>
                <textarea name="excerpt" class="form-control" rows="3">{{ old('excerpt', $blog->excerpt ?? '') }}</textarea>
            </div>
            <div class="col-12">
                <label class="form-label">Content</label>
                <textarea name="content" class="form-control" rows="8" required>{{ old('content', $blog->content ?? '') }}</textarea>
            </div>
            <div class="col-12">
                <button type="submit" class="btn btn-primary-custom">Save</button>
                <a href="{{ route('admin.blogs.index') }}" class="btn btn-outline-secondary">Cancel</a>
            </div>
        </div>
    </form>
</div>
@endsection
