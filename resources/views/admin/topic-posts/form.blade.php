@extends('layouts.admin')

@section('content')
<div class="container py-5">
    <div class="mb-4">
        <a href="{{ route('admin.topic-posts.index') }}" class="btn btn-outline-secondary btn-sm"><i class="fas fa-arrow-left me-2"></i>Back to Topic Posts</a>
    </div>

    <h1 class="section-title mb-4">{{ isset($post->id) ? 'Edit Topic Post' : 'Create Topic Post' }}</h1>

    <form action="{{ $route }}" method="POST" enctype="multipart/form-data" class="card border-0 shadow-sm p-4">
        @csrf
        @if(isset($post->id))
            @method('PUT')
        @endif

        <div class="row g-3">
            <div class="col-md-6">
                <label class="form-label">Topic</label>
                <select name="topic_id" class="form-select" required>
                    <option value="">Select Topic</option>
                    @foreach($topics as $topic)
                        <option value="{{ $topic->id }}" {{ old('topic_id', $post->topic_id ?? '') == $topic->id ? 'selected' : '' }}>{{ $topic->title }}</option>
                    @endforeach
                </select>
                @error('topic_id') <div class="text-danger mt-1 small">{{ $message }}</div> @enderror
            </div>
            <div class="col-md-6">
                <label class="form-label">Title</label>
                <input type="text" name="title" class="form-control" value="{{ old('title', $post->title ?? '') }}" required>
                @error('title') <div class="text-danger mt-1 small">{{ $message }}</div> @enderror
            </div>
            
            <div class="col-md-6">
                <label class="form-label">Slug (Optional)</label>
                <input type="text" name="slug" class="form-control" value="{{ old('slug', $post->slug ?? '') }}">
            </div>
            <div class="col-md-6">
                <label class="form-label">Published Date</label>
                <input type="date" name="published_date" class="form-control" value="{{ old('published_date', isset($post->published_date) ? $post->published_date->format('Y-m-d') : now()->format('Y-m-d')) }}">
            </div>

            <div class="col-md-6">
                <label class="form-label">Image</label>
                <input type="file" name="image" class="form-control" accept="image/jpeg,image/png,image/webp">
                @if($post->image)
                    <small class="text-muted d-block mt-1"><a href="{{ Storage::url($post->image) }}" target="_blank">View current image</a></small>
                @endif
                @error('image') <div class="text-danger mt-1 small">{{ $message }}</div> @enderror
            </div>
            <div class="col-md-6">
                <label class="form-label">Status</label>
                <select name="is_published" class="form-select">
                    <option value="1" {{ old('is_published', $post->is_published ?? 1) == 1 ? 'selected' : '' }}>Published</option>
                    <option value="0" {{ old('is_published', $post->is_published ?? 1) == 0 ? 'selected' : '' }}>Draft</option>
                </select>
            </div>

            <div class="col-12">
                <label class="form-label">Excerpt</label>
                <textarea name="excerpt" class="form-control" rows="3" required placeholder="Short description for the grid layout">{{ old('excerpt', $post->excerpt ?? '') }}</textarea>
                @error('excerpt') <div class="text-danger mt-1 small">{{ $message }}</div> @enderror
            </div>
            <div class="col-12">
                <label class="form-label">Content</label>
                <textarea name="content" class="form-control" rows="8" required>{{ old('content', $post->content ?? '') }}</textarea>
                @error('content') <div class="text-danger mt-1 small">{{ $message }}</div> @enderror
            </div>
            
            <div class="col-12 mt-4 text-end">
                <a href="{{ route('admin.topic-posts.index') }}" class="btn btn-outline-secondary me-2">Cancel</a>
                <button type="submit" class="btn btn-primary px-4">Save Post</button>
            </div>
        </div>
    </form>
</div>
@endsection
