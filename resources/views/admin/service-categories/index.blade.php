@extends('layouts.admin')

@section('content')
<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0 text-gray-800">Services Directory (Main Categories)</h1>
        <a href="{{ route('admin.service-categories.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i> Add Category</a>
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
                            <th>Name</th>
                            <th>Slug</th>
                            <th>Parent Category</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($categories as $category)
                            <tr>
                                <td>{{ $category->name }}</td>
                                <td>{{ $category->slug }}</td>
                                <td>{{ $category->parent ? $category->parent->name : 'None' }}</td>
                                <td>
                                    <span class="badge {{ $category->status ? 'bg-success' : 'bg-danger' }}">
                                        {{ $category->status ? 'Active' : 'Inactive' }}
                                    </span>
                                </td>
                                <td>
                                    <a href="{{ route('admin.services.index', ['category_id' => $category->id]) }}" class="btn btn-sm btn-success text-white"><i class="fas fa-list"></i> Manage Services</a>
                                    <a href="{{ route('admin.service-categories.edit', $category->id) }}" class="btn btn-sm btn-info text-white">Edit</a>
                                    <form action="{{ route('admin.service-categories.destroy', $category->id) }}" method="POST" class="d-inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this category?');">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center">No categories found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="mt-3">
                {{ $categories->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
