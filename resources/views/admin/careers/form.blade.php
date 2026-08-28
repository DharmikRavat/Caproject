@extends('layouts.admin')

@section('content')
<div class="container py-5">
    <h1 class="section-title mb-4">{{ isset($career->id) ? 'Edit career' : 'Create career' }}</h1>

    <form action="{{ $route }}" method="POST" enctype="multipart/form-data" class="card border-0 shadow-sm p-4">
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
                <textarea id="rich-description" name="description" class="form-control" rows="12">{{ old('description', $career->description ?? '') }}</textarea>
            </div>
            <div class="col-md-6">
                <label class="form-label">Career Image</label>
                <input type="file" name="image" class="form-control" accept="image/jpeg,image/png,image/webp">
                @if($career->image)<img src="{{ Storage::url($career->image) }}" alt="Current career image" class="mt-2" style="max-width: 220px;">@endif
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

<script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        tinymce.init({
            selector: '#rich-description',
            plugins: 'advlist autolink lists link image charmap preview anchor pagebreak searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking table emoticons template help',
            toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table | align lineheight | numlist bullist indent outdent | emoticons charmap | removeformat',
            menubar: false,
            height: 400
        });
    });
</script>
@endsection
