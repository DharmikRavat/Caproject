@extends('layouts.admin')

@section('content')
<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="section-title m-0">Site Settings</h1>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('admin.site-settings.update') }}" method="POST" enctype="multipart/form-data" class="card border-0 shadow-sm p-4">
        @csrf
        
        <h5 class="mb-3 border-bottom pb-2">Contact Information (Header & Footer)</h5>
        <div class="row g-3 mb-4">
            <div class="col-md-4">
                <label class="form-label">Contact Email</label>
                <input type="email" name="contact_email" class="form-control" value="{{ old('contact_email', $settings['contact_email'] ?? '') }}">
            </div>
            <div class="col-md-4">
                <label class="form-label">Contact Phone</label>
                <input type="text" name="contact_phone" class="form-control" value="{{ old('contact_phone', $settings['contact_phone'] ?? '') }}">
            </div>
            <div class="col-md-4">
                <label class="form-label">Office Address</label>
                <input type="text" name="contact_address" class="form-control" value="{{ old('contact_address', $settings['contact_address'] ?? '') }}">
            </div>
        </div>

        <h5 class="mb-3 border-bottom pb-2">Homepage "About Us" Section</h5>
        <div class="row g-3 mb-4">
            <div class="col-12">
                <label class="form-label">About Us Description</label>
                <textarea name="about_us_text" class="form-control" rows="4">{{ old('about_us_text', $settings['about_us_text'] ?? '') }}</textarea>
            </div>
            <div class="col-md-6">
                <label class="form-label">About Us Image</label>
                <input type="file" name="about_us_image" class="form-control" accept="image/*">
                @if(isset($settings['about_us_image']) && $settings['about_us_image'])
                    <small class="text-muted d-block mt-2">Current Image: <br> <img src="{{ Storage::url($settings['about_us_image']) }}" alt="preview" style="max-width: 200px; border-radius: 8px; margin-top: 5px;"></small>
                @endif
            </div>
        </div>
        
        <h5 class="mb-3 border-bottom pb-2">Social Links</h5>
        <div class="row g-3 mb-4">
            <div class="col-md-4">
                <label class="form-label">Facebook URL</label>
                <input type="url" name="facebook_link" class="form-control" value="{{ old('facebook_link', $settings['facebook_link'] ?? '') }}">
            </div>
            <div class="col-md-4">
                <label class="form-label">Twitter URL</label>
                <input type="url" name="twitter_link" class="form-control" value="{{ old('twitter_link', $settings['twitter_link'] ?? '') }}">
            </div>
            <div class="col-md-4">
                <label class="form-label">LinkedIn URL</label>
                <input type="url" name="linkedin_link" class="form-control" value="{{ old('linkedin_link', $settings['linkedin_link'] ?? '') }}">
            </div>
        </div>

        <div class="mt-2">
            <button type="submit" class="btn btn-primary-custom px-4 py-2 fw-bold">Save All Settings</button>
        </div>
    </form>
</div>
@endsection
