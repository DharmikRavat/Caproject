@extends('layouts.admin')

@section('content')
<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="section-title m-0">Testimonials Management</h1>
        <a href="{{ route('admin.testimonials.create') }}" class="btn btn-primary-custom">Add Testimonial</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card border-0 shadow-sm">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Image</th>
                            <th>Author</th>
                            <th>Rating</th>
                            <th>Status</th>
                            <th class="text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($testimonials as $testimonial)
                            <tr>
                                <td>
                                    @if($testimonial->author_image)
                                        <img src="{{ Storage::url($testimonial->author_image) }}" alt="image" style="width: 40px; height: 40px; border-radius: 50%; object-fit: cover;">
                                    @else
                                        <div class="bg-secondary text-white d-flex align-items-center justify-content-center" style="width: 40px; height: 40px; border-radius: 50%;">
                                            {{ substr($testimonial->author, 0, 1) }}
                                        </div>
                                    @endif
                                </td>
                                <td>{{ $testimonial->author }}</td>
                                <td>{{ $testimonial->rating }} Stars</td>
                                <td>
                                    @if($testimonial->is_active)
                                        <span class="badge bg-success">Active</span>
                                    @else
                                        <span class="badge bg-danger">Inactive</span>
                                    @endif
                                </td>
                                <td class="text-end">
                                    <a href="{{ route('admin.testimonials.edit', $testimonial) }}" class="btn btn-sm btn-outline-primary">Edit</a>
                                    <form action="{{ route('admin.testimonials.destroy', $testimonial) }}" method="POST" class="d-inline-block" onsubmit="return confirm('Are you sure?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center py-4">No testimonials found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
