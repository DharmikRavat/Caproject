@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0 text-gray-800">Edit Vertical</h1>
        <a href="{{ route('admin.industries.index') }}" class="btn btn-secondary">
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
            <form action="{{ route('admin.industries.update', $industry) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Name *</label>
                        <input type="text" name="name" class="form-control" value="{{ old('name', $industry->name) }}" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Slug *</label>
                        <input type="text" name="slug" class="form-control" value="{{ old('slug', $industry->slug) }}" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">FontAwesome Icon Class</label>
                        <input type="text" name="icon" class="form-control" value="{{ old('icon', $industry->icon) }}" placeholder="e.g. fas fa-industry">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Image (Card Thumbnail)</label>
                        <input type="file" name="image" class="form-control">
                        @if($industry->image)
                            <div class="mt-2">
                                <img src="{{ Storage::url($industry->image) }}" alt="Current Image" class="img-thumbnail" style="max-height: 80px;">
                            </div>
                        @endif
                    </div>
                    <div class="col-md-12 mb-3">
                        <label class="form-label">Description</label>
                        <textarea name="description" class="form-control" rows="3">{{ old('description', $industry->description) }}</textarea>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Status</label>
                        <div class="form-check form-switch mt-2">
                            <input class="form-check-input" type="checkbox" name="is_active" id="is_active" value="1" {{ old('is_active', $industry->is_active) ? 'checked' : '' }}>
                            <label class="form-check-label" for="is_active">Active</label>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Update Vertical</button>
            </form>
        </div>
    </div>
</div>
@endsection
