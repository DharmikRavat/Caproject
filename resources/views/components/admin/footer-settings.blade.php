<h5 class="mb-3 border-bottom pb-2">Footer Settings</h5>
<div class="row g-3 mb-4">
    <div class="col-12">
        <label class="form-label">Footer About Text</label>
        <textarea name="footer_about_text" class="form-control" rows="3" placeholder="This text appears in the 'About' column of the footer.">{{ old('footer_about_text', $settings['footer_about_text'] ?? '') }}</textarea>
    </div>
    <div class="col-md-6">
        <label class="form-label">Footer Copyright Text</label>
        <input type="text" name="footer_copyright_text" class="form-control" value="{{ old('footer_copyright_text', $settings['footer_copyright_text'] ?? '') }}" placeholder="e.g. Copyrights © 2026 All rights reserved to...">
    </div>
    
    <div class="col-12 mt-3">
        <h6>Social Media Links</h6>
    </div>
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
