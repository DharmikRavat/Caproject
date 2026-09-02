@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0 text-gray-800">Blog archives</h1>
        <a href="{{ route('admin.blog-archives.create') }}" class="btn btn-primary">
            <i class="fas fa-plus fa-sm text-white-50"></i> Add Archive
        </a>
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
                            <th>Archive Name</th>
                            <th>Slug</th>
                            <th>Blogs</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($archives as $Archive)
                            <tr>
                                <td>{{ $Archive->name }}</td>
                                <td>{{ $Archive->slug }}</td>
                                <td>{{ $Archive->blogs_count ?? 0 }}</td>
                                <td>
                                    @if($Archive->is_active)
                                        <span class="badge bg-success rounded-pill px-3 py-2 fw-medium">Active</span>
                                    @else
                                        <span class="badge bg-danger rounded-pill px-3 py-2 fw-medium">Inactive</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('admin.blogs.index', ['Archive_id' => $Archive->id]) }}" class="btn btn-sm btn-success text-white"><i class="fas fa-list"></i> Manage Blogs</a>
                                    <a href="{{ route('admin.blog-archives.edit', $Archive) }}" class="btn btn-sm btn-info text-white">Edit</a>
                                    <form action="{{ route('admin.blog-archives.destroy', $Archive) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this Archive?');">
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
