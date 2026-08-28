@extends('layouts.admin')

@section('content')
<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="section-title mb-0">Manage Blog Tags</h1>
        <a href="{{ route('admin.blog-tags.create') }}" class="btn btn-primary"><i class="fas fa-plus me-2"></i>Add Tag</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card shadow-sm border-0">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th class="px-4 py-3 border-0">Name</th>
                            <th class="px-4 py-3 border-0">Slug</th>
                            <th class="px-4 py-3 border-0">Blog Count</th>
                            <th class="px-4 py-3 border-0 text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($tags as $tag)
                            <tr>
                                <td class="px-4 py-3 align-middle">{{ $tag->name }}</td>
                                <td class="px-4 py-3 align-middle">{{ $tag->slug }}</td>
                                <td class="px-4 py-3 align-middle">{{ $tag->blogs_count }}</td>
                                <td class="px-4 py-3 align-middle text-end">
                                    <div class="btn-group">
                                        <a href="{{ route('admin.blog-tags.edit', $tag) }}" class="btn btn-sm btn-outline-primary" title="Edit"><i class="fas fa-edit"></i></a>
                                        <form action="{{ route('admin.blog-tags.destroy', $tag) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this tag?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger" title="Delete"><i class="fas fa-trash-alt"></i></button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="4" class="text-center py-4 text-muted">No tags found.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    
    <div class="mt-4">
        {{ $tags->links() }}
    </div>
</div>
@endsection
