@extends('layouts.admin')

@section('content')
<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="section-title mb-0">Manage Topic Pages</h1>
        <a href="{{ route('admin.topics.create') }}" class="btn btn-primary"><i class="fas fa-plus me-2"></i>Add Topic Page</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card shadow-sm border-0">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle table-hover mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th class="px-4 py-3 border-0">Title</th>
                            <th class="px-4 py-3 border-0">Slug</th>
                            <th class="px-4 py-3 border-0">Posts Count</th>
                            <th class="px-4 py-3 border-0 text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($topics as $topic)
                            <tr>
                                <td class="px-4 py-3 align-middle">{{ $topic->title }}</td>
                                <td class="px-4 py-3 align-middle">{{ $topic->slug }}</td>
                                <td class="px-4 py-3 align-middle">{{ $topic->posts_count }}</td>
                                <td class="px-4 py-3 align-middle text-end">
                                    <div class="btn-group">
                                        <a href="{{ url('/' . $topic->slug) }}" target="_blank" class="btn btn-sm btn-outline-info" title="View"><i class="fas fa-eye"></i></a>
                                        <a href="{{ route('admin.topics.edit', $topic) }}" class="btn btn-sm btn-outline-primary" title="Edit"><i class="fas fa-edit"></i></a>
                                        <form action="{{ route('admin.topics.destroy', $topic) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this topic?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger" title="Delete"><i class="fas fa-trash-alt"></i></button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="4" class="text-center py-4 text-muted">No topics found.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    
    <div class="mt-4">
        {{ $topics->links() }}
    </div>
</div>
@endsection
