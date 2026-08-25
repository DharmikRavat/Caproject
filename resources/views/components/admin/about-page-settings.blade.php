<h5 class="mb-3 border-bottom pb-2">About Us Page</h5>
<div class="row g-3 mb-4">
    <div class="col-12">
        <label class="form-label">Page Title</label>
        <input type="text" name="about_page_title" class="form-control" value="{{ old('about_page_title', $settings['about_page_title'] ?? '') }}" required>
    </div>
    <div class="col-12">
        <label class="form-label">Introduction</label>
        <textarea name="about_page_intro" class="form-control" rows="4" required>{{ old('about_page_intro', $settings['about_page_intro'] ?? '') }}</textarea>
    </div>
    <div class="col-12">
        <label class="form-label">Introduction (second paragraph)</label>
        <textarea name="about_page_intro_secondary" class="form-control" rows="3" required>{{ old('about_page_intro_secondary', $settings['about_page_intro_secondary'] ?? '') }}</textarea>
    </div>
    <div class="col-12">
        <label class="form-label">Why Choose Us Title</label>
        <input type="text" name="about_page_why_title" class="form-control" value="{{ old('about_page_why_title', $settings['about_page_why_title'] ?? '') }}" required>
    </div>
    @php($whyPoints = json_decode($settings['about_page_why_points'] ?? '[]', true) ?: [])
    @foreach(range(0, 3) as $pointIndex)
        <div class="col-md-6">
            <label class="form-label">Why Choose Us Point {{ $pointIndex + 1 }}</label>
            <textarea name="about_page_why_points[]" class="form-control" rows="2" required>{{ old('about_page_why_points.' . $pointIndex, $whyPoints[$pointIndex] ?? '') }}</textarea>
        </div>
    @endforeach
    <div class="col-12">
        <label class="form-label">Vision Statement</label>
        <textarea name="about_page_vision" class="form-control" rows="3" required>{{ old('about_page_vision', $settings['about_page_vision'] ?? '') }}</textarea>
    </div>
    <div class="col-md-6">
        <label class="form-label">About Page Hero Image</label>
        <input type="file" name="about_page_hero_image" class="form-control" accept="image/*">
        @if(!empty($settings['about_page_hero_image']))<img src="{{ Storage::url($settings['about_page_hero_image']) }}" alt="Hero preview" class="mt-2" style="max-width: 200px;">@endif
    </div>
    <div class="col-md-6">
        <label class="form-label">Vision Section Image</label>
        <input type="file" name="about_page_vision_image" class="form-control" accept="image/*">
        @if(!empty($settings['about_page_vision_image']))<img src="{{ Storage::url($settings['about_page_vision_image']) }}" alt="Vision preview" class="mt-2" style="max-width: 200px;">@endif
    </div>
</div>