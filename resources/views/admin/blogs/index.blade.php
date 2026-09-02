@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0 text-gray-800">
            @if(isset($selectedCategory))
                Blogs for: {{ $selectedCategory->name }}
            @else
                Blogs
            @endif
        </h1>
        <div>
            @if(isset($selectedCategory))
                <a href="{{ route('admin.blog-categories.index') }}" class="btn btn-secondary me-2"><i class="fas fa-arrow-left"></i> Back to Categories</a>
                <a href="{{ route('admin.blogs.create', ['category_id' => $selectedCategory->id]) }}" class="btn btn-primary"><i class="fas fa-plus"></i> Add Blog to {{ $selectedCategory->name }}</a>
            @else
                <a href="{{ route('admin.blogs.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus fa-sm text-white-50"></i> Add Blog
                </a>
            @endif
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover align-middle table-bordered" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Image</th>
                            <th>Title</th>
                            <th>Category</th>
                            <th>Date</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($blogs as $blog)
                            <tr>
                                <td>
                                    @if($blog->image)
                                        <img src="{{ Storage::url($blog->image) }}" class="img-thumbnail" style="width: 50px; height: 50px; object-fit: cover;">
                                    @else
                                        <span class="text-muted">None</span>
                                    @endif
                                </td>
                                <td>{{ $blog->title }}
                                    @if($blog->is_featured)
                                        <span class="badge bg-warning text-dark ml-2">Featured</span>
                                    @endif
                                </td>
                                <td>{{ $blog->category->name ?? 'Uncategorized' }}</td>
                                <td>{{ $blog->published_date ? \Carbon\Carbon::parse($blog->published_date)->format('d M Y') : 'N/A' }}</td>
                                <td>
                                    @if($blog->is_published)
                                        <span class="badge bg-success rounded-pill px-3 py-2 fw-medium">Active</span>
                                    @else
                                        <span class="badge bg-secondary rounded-pill px-3 py-2 fw-medium">Draft</span>
                                    @endif
                                <td>
                                    <a href="{{ route('admin.blogs.edit', $blog) }}" class="btn btn-sm btn-info">Edit</a>
                                    <form action="{{ route('admin.blogs.destroy', $blog) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this blog?');">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-danger" type="submit">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
