<h5 class="mb-3 border-bottom pb-2">Contact Page</h5>
<div class="row g-3 mb-4">
    <div class="col-12">
        <label class="form-label">Contact Page Title</label>
        <input type="text" name="contact_page_title" class="form-control" value="{{ old('contact_page_title', $settings['contact_page_title'] ?? '') }}" required>
    </div>
    <div class="col-md-12">
        <label class="form-label">Contact Page Hero Image</label>
        <input type="file" name="contact_page_hero_image" class="form-control" accept="image/*">
        @if(isset($settings['contact_page_hero_image']) && $settings['contact_page_hero_image'])
            <small class="text-muted d-block mt-2">Current Hero Image: <br> <img src="{{ Storage::url($settings['contact_page_hero_image']) }}" alt="preview" style="max-height: 80px; border-radius: 4px; margin-top: 5px;"></small>
        @endif
    </div>
    <div class="col-12">
        <label class="form-label">Contact Page Introduction</label>
        <textarea name="contact_page_intro" class="form-control" rows="3" required>{{ old('contact_page_intro', $settings['contact_page_intro'] ?? '') }}</textarea>
    </div>
    <div class="col-md-6">
        <label class="form-label">Office Schedule</label>
        <textarea name="contact_page_schedule" class="form-control" rows="3" required>{{ old('contact_page_schedule', $settings['contact_page_schedule'] ?? '') }}</textarea>
    </div>
    <div class="col-md-6">
        <label class="form-label">Google Maps Embed URL</label>
        <input type="url" name="contact_page_map" class="form-control" value="{{ old('contact_page_map', $settings['contact_page_map'] ?? '') }}">
    </div>
</div>