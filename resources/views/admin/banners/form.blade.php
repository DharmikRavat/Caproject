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
                <input type="file" name="image" id="banner-image" class="form-control" accept="image/jpeg,image/png,image/webp">
                @if($banner->getAttribute('image'))<small class="text-muted d-block mt-1"><a href="{{ \Illuminate\Support\Str::startsWith($banner->getAttribute('image'), ['http://', 'https://']) ? $banner->getAttribute('image') : Storage::url($banner->getAttribute('image')) }}" target="_blank">View current image</a></small>@endif
            </div>
            <div class="col-12">
                <label class="form-label">Public page preview</label>
                <div class="hero-panel rounded" id="banner-preview" style="background-image: linear-gradient(rgba(16, 42, 67, .72), rgba(16, 42, 67, .72)), url('{{ $banner->getAttribute('image') ? (\Illuminate\Support\Str::startsWith($banner->getAttribute('image'), ['http://', 'https://']) ? $banner->getAttribute('image') : Storage::url($banner->getAttribute('image'))) : asset('images/hero-bg.jpg') }}');">
                    <div class="hero-content">
                        <p class="hero-kicker">Homepage header</p>
                        <h1 id="preview-title">{{ $banner->title ?: 'Your banner title' }}</h1>
                        <p id="preview-subtitle">{{ $banner->subtitle ?: 'Your banner description' }}</p>
                        <span class="btn-accent" id="preview-button">{{ $banner->button_text ?: 'Button text' }}</span>
                    </div>
                </div>
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
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const fields = {
            title: document.querySelector('[name="title"]'),
            subtitle: document.querySelector('[name="subtitle"]'),
            button: document.querySelector('[name="button_text"]'),
        };
        const preview = {
            title: document.getElementById('preview-title'),
            subtitle: document.getElementById('preview-subtitle'),
            button: document.getElementById('preview-button'),
            panel: document.getElementById('banner-preview'),
        };
        Object.entries(fields).forEach(([key, field]) => field.addEventListener('input', () => {
            preview[key].textContent = field.value || (key === 'title' ? 'Your banner title' : key === 'subtitle' ? 'Your banner description' : 'Button text');
        }));
        document.getElementById('banner-image').addEventListener('change', function (event) {
            const file = event.target.files[0];
            if (file) preview.panel.style.backgroundImage = `linear-gradient(rgba(16, 42, 67, .72), rgba(16, 42, 67, .72)), url('${URL.createObjectURL(file)}')`;
        });
    });
</script>
@endsection
