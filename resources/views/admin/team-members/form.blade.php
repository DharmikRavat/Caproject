@extends('layouts.admin')

@section('content')
<div class="container py-5">
    <h1 class="section-title mb-4">{{ isset($teamMember->id) ? 'Edit team member' : 'Create team member' }}</h1>

    <form action="{{ $route }}" method="POST" enctype="multipart/form-data" class="card border-0 shadow-sm p-4">
        @csrf
        @if(isset($teamMember->id))
            @method('PUT')
        @endif

        <div class="row g-3">
            <div class="col-md-6">
                <label class="form-label">Name</label>
                <input type="text" name="name" class="form-control" value="{{ old('name', $teamMember->name ?? '') }}" required>
            </div>
            <div class="col-md-6">
                <label class="form-label">Position</label>
                <input type="text" name="position" class="form-control" value="{{ old('position', $teamMember->position ?? '') }}" required>
            </div>
            <div class="col-md-6">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-control" value="{{ old('email', $teamMember->email ?? '') }}">
            </div>
            <div class="col-md-6">
                <label class="form-label">Phone</label>
                <input type="text" name="phone" class="form-control" value="{{ old('phone', $teamMember->phone ?? '') }}">
            </div>
            <div class="col-md-6">
                <label class="form-label">Profile image</label>
                <input type="file" name="image" class="form-control" accept="image/jpeg,image/png,image/webp">
                @if($teamMember->getAttribute('image'))<small class="text-muted d-block mt-1"><a href="{{ Storage::url($teamMember->getAttribute('image')) }}" target="_blank">View current image</a></small>@endif
            </div>
            <div class="col-12">
                <label class="form-label">Bio</label>
                <textarea name="bio" class="form-control" rows="5">{{ old('bio', $teamMember->bio ?? '') }}</textarea>
            </div>
            <div class="col-12">
                <label class="form-label">Status</label>
                <select name="is_active" class="form-select">
                    <option value="1" {{ old('is_active', $teamMember->is_active ?? 1) == 1 ? 'selected' : '' }}>Active</option>
                    <option value="0" {{ old('is_active', $teamMember->is_active ?? 1) == 0 ? 'selected' : '' }}>Inactive</option>
                </select>
            </div>
            <div class="col-12">
                <button type="submit" class="btn btn-primary-custom">Save</button>
                <a href="{{ route('admin.team-members.index') }}" class="btn btn-outline-secondary">Cancel</a>
            </div>
        </div>
    </form>
</div>
@endsection
