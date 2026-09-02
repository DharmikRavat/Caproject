@extends('layouts.admin')

@section('content')
<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0 text-gray-800">
            @if(isset($selectedCategory))
                Services for: {{ $selectedCategory->name }}
            @else
                All Services
            @endif
        </h1>
        <div>
            @if(isset($selectedCategory))
                <a href="{{ route('admin.service-categories.index') }}" class="btn btn-secondary me-2"><i class="fas fa-arrow-left"></i> Back to Categories</a>
                <a href="{{ route('admin.services.create', ['category_id' => $selectedCategory->id]) }}" class="btn btn-primary"><i class="fas fa-plus"></i> Add Service to {{ $selectedCategory->name }}</a>
            @else
                <a href="{{ route('admin.services.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i> Add Service</a>
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
                            <th>Name</th>
                            <th>Category</th>
                            <th>Slug</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($services as $service)
                            <tr>
                                <td>{{ $service->name }}</td>
                                <td>{{ $service->category()->first() ? $service->category()->first()->name : 'N/A' }}</td>
                                <td>{{ $service->slug }}</td>
                                <td>
                                    <span class="badge {{ $service->status ? 'bg-success' : 'bg-danger' }}">
                                        {{ $service->status ? 'Active' : 'Inactive' }}
                                    </span>
                                </td>
                                <td>
                                    <a href="{{ route('admin.services.content', $service->id) }}" class="btn btn-sm btn-success text-white">Manage Content</a>
                                    <a href="{{ route('admin.services.edit', $service->id) }}" class="btn btn-sm btn-info text-white">Edit</a>
                                    <form action="{{ route('admin.services.destroy', $service->id) }}" method="POST" class="d-inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this service?');">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center">No services found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="mt-3">
                {{ $services->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
