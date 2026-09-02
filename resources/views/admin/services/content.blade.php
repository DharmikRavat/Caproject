@extends('layouts.admin')

@section('content')
<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0 text-gray-800">Manage Content: {{ $service->name }}</h1>
        <a href="{{ route('admin.services.index') }}" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Back to Services</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
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
        <div class="card-header bg-white py-3">
            <ul class="nav nav-tabs card-header-tabs" id="contentTabs" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="sections-tab" data-bs-toggle="tab" data-bs-target="#sections" type="button" role="tab" aria-controls="sections" aria-selected="true">Sections (Rich Text)</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="steps-tab" data-bs-toggle="tab" data-bs-target="#steps" type="button" role="tab" aria-controls="steps" aria-selected="false">Process Steps</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="faqs-tab" data-bs-toggle="tab" data-bs-target="#faqs" type="button" role="tab" aria-controls="faqs" aria-selected="false">FAQs</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="docs-tab" data-bs-toggle="tab" data-bs-target="#docs" type="button" role="tab" aria-controls="docs" aria-selected="false">Documents</button>
                </li>
            </ul>
        </div>
        <div class="card-body">
            <div class="tab-content" id="contentTabsContent">
                
                <!-- SECTIONS TAB -->
                <div class="tab-pane fade show active" id="sections" role="tabpanel" aria-labelledby="sections-tab">
                    <div class="d-flex justify-content-end mb-3">
                        <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#addSectionModal"><i class="fas fa-plus"></i> Add Section</button>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover align-middle table-bordered">
                            <thead class="table-light"><tr><th>Title</th><th>Sort Order</th><th>Actions</th></tr></thead>
                            <tbody>
                                @forelse($service->sections as $section)
                                <tr>
                                    <td>{{ $section->title }}</td>
                                    <td>{{ $section->sort_order }}</td>
                                    <td>
                                        <button class="btn btn-sm btn-info text-white" data-bs-toggle="modal" data-bs-target="#editSectionModal{{ $section->id }}">Edit</button>
                                        <form action="{{ route('admin.service-sections.destroy', $section->id) }}" method="POST" class="d-inline-block">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Delete this section?');">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                                <!-- Edit Section Modal -->
                                <div class="modal fade" id="editSectionModal{{ $section->id }}" tabindex="-1">
                                    <div class="modal-dialog modal-xl">
                                        <div class="modal-content">
                                            <form action="{{ route('admin.service-sections.update', $section->id) }}" method="POST">
                                                @csrf @method('PUT')
                                                <div class="modal-header"><h5 class="modal-title">Edit Section</h5><button type="button" class="btn-close" data-bs-dismiss="modal"></button></div>
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="col-md-6 mb-3"><label>Title *</label><input type="text" name="title" class="form-control" value="{{ $section->title }}" required></div>
                                                        <div class="col-md-6 mb-3"><label>Subtitle</label><input type="text" name="subtitle" class="form-control" value="{{ $section->subtitle }}"></div>
                                                        <div class="col-md-12 mb-3"><label>Content *</label><textarea name="content" class="form-control summernote" required>{{ $section->content }}</textarea></div>
                                                        <div class="col-md-6"><label>Sort Order</label><input type="number" name="sort_order" class="form-control" value="{{ $section->sort_order }}"></div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer"><button type="submit" class="btn btn-primary">Save Changes</button></div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                @empty
                                <tr><td colspan="3" class="text-center">No sections added yet.</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- PROCESS STEPS TAB -->
                <div class="tab-pane fade" id="steps" role="tabpanel" aria-labelledby="steps-tab">
                    <div class="d-flex justify-content-end mb-3">
                        <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#addStepModal"><i class="fas fa-plus"></i> Add Process Step</button>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover align-middle table-bordered">
                            <thead class="table-light"><tr><th>Step #</th><th>Title</th><th>Actions</th></tr></thead>
                            <tbody>
                                @forelse($service->processSteps as $step)
                                <tr>
                                    <td>{{ $step->step_number }}</td>
                                    <td>{{ $step->title }}</td>
                                    <td>
                                        <button class="btn btn-sm btn-info text-white" data-bs-toggle="modal" data-bs-target="#editStepModal{{ $step->id }}">Edit</button>
                                        <form action="{{ route('admin.service-process-steps.destroy', $step->id) }}" method="POST" class="d-inline-block">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Delete this step?');">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                                <!-- Edit Step Modal -->
                                <div class="modal fade" id="editStepModal{{ $step->id }}" tabindex="-1">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <form action="{{ route('admin.service-process-steps.update', $step->id) }}" method="POST">
                                                @csrf @method('PUT')
                                                <div class="modal-header"><h5 class="modal-title">Edit Step</h5><button type="button" class="btn-close" data-bs-dismiss="modal"></button></div>
                                                <div class="modal-body">
                                                    <div class="mb-3"><label>Step Number</label><input type="number" name="step_number" class="form-control" value="{{ $step->step_number }}"></div>
                                                    <div class="mb-3"><label>Title *</label><input type="text" name="title" class="form-control" value="{{ $step->title }}" required></div>
                                                    <div class="mb-3"><label>Description *</label><textarea name="description" class="form-control" rows="3" required>{{ $step->description }}</textarea></div>
                                                </div>
                                                <div class="modal-footer"><button type="submit" class="btn btn-primary">Save Changes</button></div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                @empty
                                <tr><td colspan="3" class="text-center">No process steps added yet.</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- FAQS TAB -->
                <div class="tab-pane fade" id="faqs" role="tabpanel" aria-labelledby="faqs-tab">
                    <div class="d-flex justify-content-end mb-3">
                        <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#addFaqModal"><i class="fas fa-plus"></i> Add FAQ</button>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover align-middle table-bordered">
                            <thead class="table-light"><tr><th>Question</th><th>Sort Order</th><th>Actions</th></tr></thead>
                            <tbody>
                                @forelse($service->faqs as $faq)
                                <tr>
                                    <td>{{ $faq->question }}</td>
                                    <td>{{ $faq->sort_order }}</td>
                                    <td>
                                        <button class="btn btn-sm btn-info text-white" data-bs-toggle="modal" data-bs-target="#editFaqModal{{ $faq->id }}">Edit</button>
                                        <form action="{{ route('admin.service-faqs.destroy', $faq->id) }}" method="POST" class="d-inline-block">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Delete this FAQ?');">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                                <!-- Edit FAQ Modal -->
                                <div class="modal fade" id="editFaqModal{{ $faq->id }}" tabindex="-1">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <form action="{{ route('admin.service-faqs.update', $faq->id) }}" method="POST">
                                                @csrf @method('PUT')
                                                <div class="modal-header"><h5 class="modal-title">Edit FAQ</h5><button type="button" class="btn-close" data-bs-dismiss="modal"></button></div>
                                                <div class="modal-body">
                                                    <div class="mb-3"><label>Question *</label><input type="text" name="question" class="form-control" value="{{ $faq->question }}" required></div>
                                                    <div class="mb-3"><label>Answer (Rich Text) *</label><textarea name="answer" class="form-control summernote" required>{{ $faq->answer }}</textarea></div>
                                                    <div class="mb-3"><label>Sort Order</label><input type="number" name="sort_order" class="form-control" value="{{ $faq->sort_order }}"></div>
                                                </div>
                                                <div class="modal-footer"><button type="submit" class="btn btn-primary">Save Changes</button></div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                @empty
                                <tr><td colspan="3" class="text-center">No FAQs added yet.</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- DOCUMENTS TAB -->
                <div class="tab-pane fade" id="docs" role="tabpanel" aria-labelledby="docs-tab">
                    <div class="d-flex justify-content-end mb-3">
                        <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#addDocModal"><i class="fas fa-plus"></i> Add Document</button>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover align-middle table-bordered">
                            <thead class="table-light"><tr><th>Title</th><th>Sort Order</th><th>Actions</th></tr></thead>
                            <tbody>
                                @forelse($service->documents as $doc)
                                <tr>
                                    <td>{{ $doc->title }}</td>
                                    <td>{{ $doc->sort_order }}</td>
                                    <td>
                                        <button class="btn btn-sm btn-info text-white" data-bs-toggle="modal" data-bs-target="#editDocModal{{ $doc->id }}">Edit</button>
                                        <form action="{{ route('admin.service-documents.destroy', $doc->id) }}" method="POST" class="d-inline-block">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Delete this Document?');">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                                <!-- Edit Doc Modal -->
                                <div class="modal fade" id="editDocModal{{ $doc->id }}" tabindex="-1">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <form action="{{ route('admin.service-documents.update', $doc->id) }}" method="POST">
                                                @csrf @method('PUT')
                                                <div class="modal-header"><h5 class="modal-title">Edit Document</h5><button type="button" class="btn-close" data-bs-dismiss="modal"></button></div>
                                                <div class="modal-body">
                                                    <div class="mb-3"><label>Title *</label><input type="text" name="title" class="form-control" value="{{ $doc->title }}" required></div>
                                                    <div class="mb-3"><label>Description</label><textarea name="description" class="form-control" rows="2">{{ $doc->description }}</textarea></div>
                                                    <div class="mb-3"><label>Sort Order</label><input type="number" name="sort_order" class="form-control" value="{{ $doc->sort_order }}"></div>
                                                </div>
                                                <div class="modal-footer"><button type="submit" class="btn btn-primary">Save Changes</button></div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                @empty
                                <tr><td colspan="3" class="text-center">No documents added yet.</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<!-- ADD MODALS -->

<!-- Add Section Modal -->
<div class="modal fade" id="addSectionModal" tabindex="-1">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <form action="{{ route('admin.service-sections.store') }}" method="POST">
                @csrf
                <input type="hidden" name="service_id" value="{{ $service->id }}">
                <div class="modal-header"><h5 class="modal-title">Add Section</h5><button type="button" class="btn-close" data-bs-dismiss="modal"></button></div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6 mb-3"><label>Title *</label><input type="text" name="title" class="form-control" required></div>
                        <div class="col-md-6 mb-3"><label>Subtitle</label><input type="text" name="subtitle" class="form-control"></div>
                        <div class="col-md-12 mb-3"><label>Content *</label><textarea name="content" class="form-control summernote" required></textarea></div>
                        <div class="col-md-6"><label>Sort Order</label><input type="number" name="sort_order" class="form-control" value="0"></div>
                    </div>
                </div>
                <div class="modal-footer"><button type="submit" class="btn btn-primary">Save Section</button></div>
            </form>
        </div>
    </div>
</div>

<!-- Add Step Modal -->
<div class="modal fade" id="addStepModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('admin.service-process-steps.store') }}" method="POST">
                @csrf
                <input type="hidden" name="service_id" value="{{ $service->id }}">
                <div class="modal-header"><h5 class="modal-title">Add Process Step</h5><button type="button" class="btn-close" data-bs-dismiss="modal"></button></div>
                <div class="modal-body">
                    <div class="mb-3"><label>Step Number</label><input type="number" name="step_number" class="form-control" value="{{ $service->processSteps->count() + 1 }}"></div>
                    <div class="mb-3"><label>Title *</label><input type="text" name="title" class="form-control" required></div>
                    <div class="mb-3"><label>Description *</label><textarea name="description" class="form-control" rows="3" required></textarea></div>
                </div>
                <div class="modal-footer"><button type="submit" class="btn btn-primary">Save Step</button></div>
            </form>
        </div>
    </div>
</div>

<!-- Add FAQ Modal -->
<div class="modal fade" id="addFaqModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="{{ route('admin.service-faqs.store') }}" method="POST">
                @csrf
                <input type="hidden" name="service_id" value="{{ $service->id }}">
                <div class="modal-header"><h5 class="modal-title">Add FAQ</h5><button type="button" class="btn-close" data-bs-dismiss="modal"></button></div>
                <div class="modal-body">
                    <div class="mb-3"><label>Question *</label><input type="text" name="question" class="form-control" required></div>
                    <div class="mb-3"><label>Answer *</label><textarea name="answer" class="form-control summernote" required></textarea></div>
                    <div class="mb-3"><label>Sort Order</label><input type="number" name="sort_order" class="form-control" value="0"></div>
                </div>
                <div class="modal-footer"><button type="submit" class="btn btn-primary">Save FAQ</button></div>
            </form>
        </div>
    </div>
</div>

<!-- Add Doc Modal -->
<div class="modal fade" id="addDocModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('admin.service-documents.store') }}" method="POST">
                @csrf
                <input type="hidden" name="service_id" value="{{ $service->id }}">
                <div class="modal-header"><h5 class="modal-title">Add Document</h5><button type="button" class="btn-close" data-bs-dismiss="modal"></button></div>
                <div class="modal-body">
                    <div class="mb-3"><label>Title *</label><input type="text" name="title" class="form-control" required></div>
                    <div class="mb-3"><label>Description</label><textarea name="description" class="form-control" rows="2"></textarea></div>
                    <div class="mb-3"><label>Sort Order</label><input type="number" name="sort_order" class="form-control" value="0"></div>
                </div>
                <div class="modal-footer"><button type="submit" class="btn btn-primary">Save Document</button></div>
            </form>
        </div>
    </div>
</div>

<!-- Initialize Summernote and Tabs -->
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
<script>
    $(document).ready(function() {
        $('.summernote').summernote({
            height: 200,
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'underline', 'clear']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['table', ['table']],
                ['insert', ['link']],
                ['view', ['fullscreen', 'codeview']]
            ]
        });

        // Store active tab in localStorage
        $('button[data-bs-toggle="tab"]').on('shown.bs.tab', function (e) {
            localStorage.setItem('activeServiceTab', $(e.target).attr('id'));
        });

        // Restore active tab
        var activeTab = localStorage.getItem('activeServiceTab');
        if (activeTab) {
            var tab = new bootstrap.Tab(document.getElementById(activeTab));
            tab.show();
        }
    });
</script>
@endsection
