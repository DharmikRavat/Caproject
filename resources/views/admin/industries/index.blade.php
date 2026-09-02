@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0 text-gray-800">Verticals We Serve</h1>
        <a href="{{ route('admin.industries.create') }}" class="btn btn-primary">
            <i class="fas fa-plus fa-sm text-white-50"></i> Add Vertical
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover align-middle table-bordered" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Slug</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($industries as $industry)
                            <tr>
                                <td>
                                    @if($industry->image)
                                        <img src="{{ Storage::url($industry->image) }}" alt="{{ $industry->name }}" style="height: 40px; width: auto; border-radius: 4px;">
                                    @elseif($industry->icon)
                                        <i class="{{ $industry->icon }} fa-2x text-primary"></i>
                                    @else
                                        <span class="text-muted">None</span>
                                    @endif
                                </td>
                                <td>{{ $industry->name }}</td>
                                <td>{{ $industry->slug }}</td>
                                <td>
                                    @if($industry->is_active)
                                        <span class="badge bg-success rounded-pill px-3 py-2 fw-medium">Active</span>
                                    @else
                                        <span class="badge bg-danger rounded-pill px-3 py-2 fw-medium">Inactive</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('admin.industries.edit', $industry) }}" class="btn btn-sm btn-info">Edit</a>
                                    <form action="{{ route('admin.industries.destroy', $industry) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this vertical?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center">No verticals found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="mt-4">
                {{ $industries->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
