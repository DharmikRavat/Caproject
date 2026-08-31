@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0 text-gray-800">{{ $blog->exists ? 'Edit Blog' : 'Add Blog' }}</h1>
        <a href="{{ route('admin.blogs.index') }}" class="btn btn-secondary">
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

    <form action="{{ $route }}" method="POST" enctype="multipart/form-data">
        @csrf
        @if($blog->exists)
            @method('PUT')
        @endif
        
        <div class="row">
            <!-- Main Content Area -->
            <div class="col-12 mb-4">
                <div class="card shadow">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Blog Content</h6>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label">Blog Title *</label>
                            <input type="text" name="title" class="form-control" value="{{ old('title', $blog->title) }}" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Blog Slug (auto-generated if empty)</label>
                            <input type="text" name="slug" class="form-control" value="{{ old('slug', $blog->slug) }}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Short Description / Excerpt</label>
                            <textarea name="excerpt" class="form-control" rows="3">{{ old('excerpt', $blog->excerpt) }}</textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Full Content *</label>
                            <textarea name="content" class="form-control tinymce-editor" rows="15">{{ old('content', $blog->content) }}</textarea>
                        </div>
                    </div>
            </div>

            <!-- Publishing Metadata Area -->
            <div class="col-12">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Publishing & Metadata</h6>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                        <div class="mb-3">
                            <label class="form-label d-flex justify-content-between align-items-center w-100">
                                Category
                                <button type="button" class="btn btn-sm btn-link p-0" data-toggle="modal" data-target="#createCategoryModal" data-bs-toggle="modal" data-bs-target="#createCategoryModal">
                                    <i class="fas fa-plus"></i> Create New
                                </button>
                            </label>
                            <select name="blog_category_id" id="blog_category_id" class="form-control">
                                <option value="">No Category</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ (old('blog_category_id', $blog->blog_category_id) == $category->id || (isset($selectedCategoryId) && $selectedCategoryId == $category->id)) ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label d-flex justify-content-between align-items-center w-100">
                                Archive
                            </label>
                            <select name="blog_archive_id" id="blog_archive_id" class="form-control">
                                <option value="">No Archive</option>
                                @foreach(\App\Models\BlogArchive::where('is_active', true)->orderBy('created_at', 'desc')->get() as $archive)
                                    <option value="{{ $archive->id }}" {{ (old('blog_archive_id', $blog->blog_archive_id) == $archive->id) ? 'selected' : '' }}>
                                        {{ $archive->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Author</label>
                            <input type="text" name="author" class="form-control" value="{{ old('author', $blog->author) }}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Published Date</label>
                            <input type="date" name="published_date" class="form-control" value="{{ old('published_date', $blog->published_date ?? \Carbon\Carbon::now()->format('Y-m-d')) }}">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Featured Image</label>
                            <input type="file" name="image" class="form-control mb-2">
                            @if($blog->image)
                                <img src="{{ Storage::url($blog->image) }}" class="img-fluid rounded mb-2">
                            @endif
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label">Tags (Ctrl+Click to select multiple)</label>
                            <select name="tags[]" class="form-control" multiple style="height: 120px;">
                                @foreach($tags as $tag)
                                    <option value="{{ $tag->id }}" {{ in_array($tag->id, old('tags', $blog->tags->pluck('id')->toArray())) ? 'selected' : '' }}>
                                        {{ $tag->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <hr>
                        
                        <div class="form-check form-switch mb-2">
                            <input class="form-check-input" type="checkbox" name="is_published" id="is_published" value="1" {{ old('is_published', $blog->is_published ?? '1') == '1' ? 'checked' : '' }}>
                            <label class="form-check-label" for="is_published">Active (Published)</label>
                        </div>
                        
                        <div class="form-check form-switch mb-3">
                            <input class="form-check-input" type="checkbox" name="is_featured" id="is_featured" value="1" {{ old('is_featured', $blog->is_featured) ? 'checked' : '' }}>
                            <label class="form-check-label" for="is_featured">Featured Blog</label>
                        </div>

                        <button type="submit" class="btn btn-primary w-100">Save Blog</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

<!-- Create Category Modal -->
<div class="modal fade" id="createCategoryModal" tabindex="-1" role="dialog" aria-labelledby="createCategoryModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createCategoryModalLabel">Create New Category</h5>
                <button type="button" class="close btn-close" data-dismiss="modal" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="createCategoryForm">
                    <div class="mb-3">
                        <label>Category Name *</label>
                        <input type="text" id="new_category_name" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" id="new_category_is_active" checked>
                            <label class="form-check-label">Active</label>
                        </div>
                    </div>
                    <div class="alert alert-danger d-none" id="createCategoryError"></div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" id="saveCategoryBtn">Save Category</button>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
<script>
    tinymce.init({
        selector: '.tinymce-editor',
        height: 500,
        plugins: 'advlist autolink lists link image charmap preview anchor pagebreak searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking save table directionality emoticons template',
        toolbar: 'undo redo | styles | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | preview code',
        promotion: false,
    });

    document.getElementById('saveCategoryBtn').addEventListener('click', function() {
        const name = document.getElementById('new_category_name').value;
        const isActive = document.getElementById('new_category_is_active').checked;
        const errorDiv = document.getElementById('createCategoryError');
        
        if (!name) {
            errorDiv.textContent = 'Category name is required.';
            errorDiv.classList.remove('d-none');
            return;
        }
        
        errorDiv.classList.add('d-none');
        this.disabled = true;
        this.textContent = 'Saving...';
        
        fetch('{{ route("admin.blog-categories.store") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
            },
            body: JSON.stringify({
                name: name,
                is_active: isActive ? 1 : 0
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Add to select and select it
                const select = document.getElementById('blog_category_id');
                const option = document.createElement('option');
                option.value = data.category.id;
                option.text = data.category.name;
                option.selected = true;
                select.add(option);
                
                // Hide modal
                const modalEl = document.getElementById('createCategoryModal');
                if (typeof bootstrap !== 'undefined') {
                    const modal = bootstrap.Modal.getInstance(modalEl);
                    if (modal) modal.hide();
                    else new bootstrap.Modal(modalEl).hide();
                } else if (window.jQuery) {
                    jQuery(modalEl).modal('hide');
                }
                
                // Reset form
                document.getElementById('new_category_name').value = '';
            } else {
                errorDiv.textContent = data.message || 'Error creating category.';
                errorDiv.classList.remove('d-none');
            }
        })
        .catch(err => {
            errorDiv.textContent = 'A network error occurred. Check if validation failed.';
            errorDiv.classList.remove('d-none');
        })
        .finally(() => {
            this.disabled = false;
            this.textContent = 'Save Category';
        });
    });
</script>
@endsection
