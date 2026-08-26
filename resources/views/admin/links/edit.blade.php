@extends('layouts.admin')

@section('content')
<div class="container-fluid py-4 px-lg-5 admin-links-page">
    <div class="d-flex flex-wrap gap-3 justify-content-between align-items-center mb-4">
        <div><span class="badge badge-soft px-3 py-2 rounded-pill mb-2">Content management</span><h1 class="section-title mb-1">Links Directory</h1><p class="text-muted mb-0">Manage the resources visitors see on the public Links page.</p></div>
        <a href="{{ route('links') }}" class="btn btn-outline-primary" target="_blank"><i class="fas fa-external-link-alt me-2"></i>Preview public page</a>
    </div>
    @if(session('success'))<div class="alert alert-success">{{ session('success') }}</div>@endif
    @if($errors->any())<div class="alert alert-danger"><ul class="mb-0">@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul></div>@endif
    <form action="{{ route('admin.links.update') }}" method="POST" class="card border-0 shadow-sm p-4">
        @csrf @method('PUT')
        <div class="editor-section mb-4">
            <div class="section-label"><i class="fas fa-pen-to-square"></i><div><h2>Page content</h2><p>Update the copy displayed above and below the directory.</p></div></div>
            <div class="row g-3">
                <div class="col-md-4"><label class="form-label">Banner title</label><input name="links_title" class="form-control" value="{{ old('links_title', $settings['links_title'] ?? 'Links') }}"></div>
                <div class="col-md-4"><label class="form-label">Introduction</label><textarea name="links_intro" class="form-control" rows="4">{{ old('links_intro', $settings['links_intro'] ?? '') }}</textarea></div>
                <div class="col-md-4"><label class="form-label">Footer summary</label><textarea name="links_footer" class="form-control" rows="4">{{ old('links_footer', $settings['links_footer'] ?? '') }}</textarea></div>
            </div>
        </div>
        <div class="editor-section">
            <div class="d-flex flex-wrap gap-3 justify-content-between align-items-center mb-3"><div class="section-label mb-0"><i class="fas fa-list"></i><div><h2>Directory entries</h2><p>Add a title, choose its category, and paste the full destination URL.</p></div></div><button type="button" id="add-link" class="btn btn-success"><i class="fas fa-plus me-2"></i>Add entry</button></div>
            <div id="link-rows">
                @foreach($links as $index => $link)
                    <div class="link-row">
                        <div class="row g-2 align-items-end"><div class="col-lg-3"><label class="form-label small">Category</label><select name="links[{{ $index }}][category]" class="form-select"><option value="gov" @selected($link->category === 'gov')>Government Websites</option><option value="ca" @selected($link->category === 'ca')>CA Governance</option><option value="financial" @selected($link->category === 'financial')>Financial Institutions</option><option value="news" @selected($link->category === 'news')>News</option><option value="finance" @selected($link->category === 'finance')>Finance</option></select></div><div class="col-lg-3"><label class="form-label small">Link title</label><input name="links[{{ $index }}][title]" class="form-control" value="{{ $link->title }}"></div><div class="col-lg-5"><label class="form-label small">Destination URL</label><input type="url" name="links[{{ $index }}][url]" class="form-control" value="{{ $link->url }}"></div><div class="col-lg-1"><button type="button" class="btn btn-outline-danger remove-link" title="Remove entry"><i class="fas fa-trash"></i></button></div></div>
                    </div>
                @endforeach
            @if($links->isEmpty())
                <div class="link-row">
                    <div class="row g-2 align-items-end"><div class="col-lg-3"><label class="form-label small">Category</label><select name="links[0][category]" class="form-select"><option value="gov">Government Websites</option><option value="ca">CA Governance</option><option value="financial">Financial Institutions</option><option value="news">News</option><option value="finance">Finance</option></select></div><div class="col-lg-3"><label class="form-label small">Link title</label><input name="links[0][title]" class="form-control"></div><div class="col-lg-5"><label class="form-label small">Destination URL</label><input type="url" name="links[0][url]" class="form-control"></div><div class="col-lg-1"><button type="button" class="btn btn-outline-danger remove-link" title="Remove entry"><i class="fas fa-trash"></i></button></div></div>
                </div>
            @endif
            </div>
        </div>
        <div class="d-flex justify-content-end border-top mt-4 pt-4"><button class="btn btn-primary-custom fw-bold px-4"><i class="fas fa-cloud-arrow-up me-2"></i>Save and publish</button></div>
    </form>
</div>
<script>
let linkIndex = {{ $links->count() }};
document.getElementById('add-link').addEventListener('click', function () {
    const row = document.createElement('div');
    row.className = 'link-row';
    row.innerHTML = `<div class="row g-2 align-items-end"><div class="col-lg-3"><label class="form-label small">Category</label><select name="links[${linkIndex}][category]" class="form-select"><option value="gov">Government Websites</option><option value="ca">CA Governance</option><option value="financial">Financial Institutions</option><option value="news">News</option><option value="finance">Finance</option></select></div><div class="col-lg-3"><label class="form-label small">Link title</label><input name="links[${linkIndex}][title]" class="form-control"></div><div class="col-lg-5"><label class="form-label small">Destination URL</label><input type="url" name="links[${linkIndex}][url]" class="form-control"></div><div class="col-lg-1"><button type="button" class="btn btn-outline-danger remove-link" title="Remove entry"><i class="fas fa-trash"></i></button></div></div>`;
    document.getElementById('link-rows').appendChild(row);
    linkIndex++;
});
document.addEventListener('click', function (event) { if (event.target.closest('.remove-link')) event.target.closest('.link-row').remove(); });
</script>
<style>
    .admin-links-page { background: #f7f9fb; min-height: calc(100vh - 80px); }
    .admin-links-page > .card { border-radius: 10px; }
    .editor-section { background: #fbfcfd; border: 1px solid #e5eaee; border-radius: 8px; padding: 22px; }
    .section-label { align-items: flex-start; display: flex; gap: 13px; margin-bottom: 20px; }
    .section-label > i { color: #09b85b; font-size: 1.1rem; margin-top: 4px; }
    .section-label h2 { color: #17345d; font-size: 1rem; font-weight: 700; margin: 0 0 3px; }
    .section-label p { color: #7b8790; font-size: .74rem; margin: 0; }
    .link-row { background: #fff; border: 1px solid #e5eaee; border-radius: 6px; margin-bottom: 10px; padding: 13px; }
    .link-row .form-label { color: #53616b; font-weight: 600; margin-bottom: 5px; }
    .link-row .btn { min-height: 38px; width: 100%; }
    .admin-links-page .form-control, .admin-links-page .form-select { border-color: #dce3e8; font-size: .8rem; min-height: 38px; }
    .admin-links-page .form-control:focus, .admin-links-page .form-select:focus { border-color: #09b85b; box-shadow: 0 0 0 .2rem rgba(9, 184, 91, .12); }
    @media (max-width: 767px) { .admin-links-page { padding-left: 12px !important; padding-right: 12px !important; }.editor-section { padding: 15px; }.link-row .btn { margin-top: 4px; width: auto; } }
</style>
@endsection