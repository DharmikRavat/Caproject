@extends('layouts.admin')

@section('content')
<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="section-title mb-0">Manage Topic Posts</h1>
        <a href="{{ route('admin.topic-posts.create') }}" class="btn btn-primary"><i class="fas fa-plus me-2"></i>Add Topic Post</a>
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
                            <th class="px-4 py-3 border-0">Title</th>
                            <th class="px-4 py-3 border-0">Topic</th>
                            <th class="px-4 py-3 border-0">Status</th>
                            <th class="px-4 py-3 border-0">Published Date</th>
                            <th class="px-4 py-3 border-0 text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($posts as $post)
                            <tr>
                                <td class="px-4 py-3 align-middle">{{ Str::limit($post->title, 40) }}</td>
                                <td class="px-4 py-3 align-middle"><span class="badge bg-secondary">{{ $post->topic->title }}</span></td>
                                <td class="px-4 py-3 align-middle">{{ $post->is_published ? 'Published' : 'Draft' }}</td>
                                <td class="px-4 py-3 align-middle">{{ $post->published_date ? $post->published_date->format('d M Y') : 'N/A' }}</td>
                                <td class="px-4 py-3 align-middle text-end">
                                    <div class="btn-group">
                                        <a href="{{ url('/topic-post/' . $post->slug) }}" target="_blank" class="btn btn-sm btn-outline-info" title="View"><i class="fas fa-eye"></i></a>
                                        <a href="{{ route('admin.topic-posts.edit', $post) }}" class="btn btn-sm btn-outline-primary" title="Edit"><i class="fas fa-edit"></i></a>
                                        <form action="{{ route('admin.topic-posts.destroy', $post) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this post?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger" title="Delete"><i class="fas fa-trash-alt"></i></button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="5" class="text-center py-4 text-muted">No topic posts found.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    
    <div class="mt-4">
        {{ $posts->links() }}
    </div>
</div>
@endsection
