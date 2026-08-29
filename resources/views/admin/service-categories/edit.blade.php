@extends('layouts.admin')

@section('content')
<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0 text-gray-800">Edit Service Category</h1>
        <a href="{{ route('admin.service-categories.index') }}" class="btn btn-secondary">Back</a>
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
            <form action="{{ route('admin.service-categories.update', $serviceCategory->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Name <span class="text-danger">*</span></label>
                        <input type="text" name="name" class="form-control" value="{{ old('name', $serviceCategory->name) }}" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Slug <span class="text-danger">*</span></label>
                        <input type="text" name="slug" class="form-control" value="{{ old('slug', $serviceCategory->slug) }}" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Parent Category</label>
                        <select name="parent_id" class="form-control">
                            <option value="">None (Top Level)</option>
                            @foreach($categories as $cat)
                                <option value="{{ $cat->id }}" {{ old('parent_id', $serviceCategory->parent_id) == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Sort Order</label>
                        <input type="number" name="sort_order" class="form-control" value="{{ old('sort_order', $serviceCategory->sort_order) }}">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">FontAwesome Icon Class</label>
                        <input type="text" name="icon" class="form-control" value="{{ old('icon', $serviceCategory->icon) }}" placeholder="e.g. fas fa-briefcase">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Cover Image (Small Banner)</label>
                        <input type="file" name="image" class="form-control">
                        @if($serviceCategory->image)
                            <div class="mt-2">
                                <img src="{{ \Illuminate\Support\Str::startsWith($serviceCategory->image, ['http://', 'https://']) ? $serviceCategory->image : Storage::url($serviceCategory->image) }}" alt="Current Image" class="img-thumbnail" style="max-height: 100px;">
                            </div>
                        @endif
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Header Background Image (Large Hero)</label>
                        <input type="file" name="header_image" class="form-control">
                        @if($serviceCategory->header_image)
                            <div class="mt-2">
                                <img src="{{ \Illuminate\Support\Str::startsWith($serviceCategory->header_image, ['http://', 'https://']) ? $serviceCategory->header_image : Storage::url($serviceCategory->header_image) }}" alt="Current Header Image" class="img-thumbnail" style="max-height: 100px;">
                            </div>
                        @endif
                    </div>
                    <div class="col-md-12 mb-3">
                        <label class="form-label">Short Description</label>
                        <textarea name="short_description" class="form-control" rows="3">{{ old('short_description', $serviceCategory->short_description) }}</textarea>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label class="form-label">Description (Summernote)</label>
                        <textarea name="description" class="form-control summernote" rows="5">{{ old('description', $serviceCategory->description) }}</textarea>
                    </div>
                    <div class="col-md-12 mb-3">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" name="status" id="status" value="1" {{ old('status', $serviceCategory->status) ? 'checked' : '' }}>
                            <label class="form-check-label" for="status">Active</label>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Update Category</button>
            </form>
        </div>
    </div>
</div>

<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
<script>
    $(document).ready(function() {
        $('.summernote').summernote({
            height: 250,
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'underline', 'clear']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['table', ['table']],
                ['insert', ['link', 'picture', 'video']],
                ['view', ['fullscreen', 'codeview', 'help']]
            ]
        });
        
        $('input[name="name"]').on('keyup', function() {
            var val = $(this).val();
            var slug = val.toLowerCase().replace(/[^a-z0-9]+/g, '-').replace(/(^-|-$)+/g, '');
            $('input[name="slug"]').val(slug);
        });
    });
</script>
@endsection
