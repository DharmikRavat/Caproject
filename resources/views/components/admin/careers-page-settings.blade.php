<h5 class="mb-3 border-bottom pb-2">Careers Page</h5>
<div class="row g-3 mb-4">
    <div class="col-md-6">
        <label class="form-label">Banner Title</label>
        <input type="text" name="careers_page_title" class="form-control" value="{{ old('careers_page_title', $settings['careers_page_title'] ?? '') }}" required>
    </div>
    <div class="col-md-6">
        <label class="form-label">Application Form Title</label>
        <input type="text" name="careers_page_form_title" class="form-control" value="{{ old('careers_page_form_title', $settings['careers_page_form_title'] ?? '') }}" required>
    </div>
    @foreach(range(1, 3) as $paragraph)
        <div class="col-12">
            <label class="form-label">Introduction Paragraph {{ $paragraph }}</label>
            <textarea name="careers_page_intro_{{ $paragraph }}" class="form-control" rows="3" required>{{ old('careers_page_intro_' . $paragraph, $settings['careers_page_intro_' . $paragraph] ?? '') }}</textarea>
        </div>
    @endforeach
    <div class="col-12">
        <label class="form-label">Available Roles (one per line)</label>
        <textarea name="careers_page_roles" class="form-control" rows="4" required>{{ old('careers_page_roles', $settings['careers_page_roles'] ?? '') }}</textarea>
    </div>
    <div class="col-md-6">
        <label class="form-label">Careers Side Image</label>
        <input type="file" name="careers_page_image" class="form-control" accept="image/*">
        @if(!empty($settings['careers_page_image']))<img src="{{ \Illuminate\Support\Str::startsWith($settings['careers_page_image'], ['http://', 'https://']) ? $settings['careers_page_image'] : Storage::url($settings['careers_page_image']) }}" alt="Careers preview" class="mt-2" style="max-width: 200px;">@endif
    </div>
</div>