@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0 text-gray-800">Happy Clients / Testimonials</h1>
        <a href="{{ route('admin.testimonials.create') }}" class="btn btn-primary">
            <i class="fas fa-plus fa-sm text-white-50"></i> Add Review
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
                            <th>Client</th>
                            <th>Image</th>
                            <th>Rating</th>
                            <th>Source</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($testimonials as $testimonial)
                            <tr>
                                <td>
                                    <strong>{{ $testimonial->author }}</strong>
                                    @if($testimonial->is_verified)
                                        <i class="fas fa-check-circle text-primary" title="Verified"></i>
                                    @endif
                                    <br>
                                    <small class="text-muted">{{ $testimonial->author_role }}</small>
                                </td>
                                <td>
                                    @if($testimonial->author_image)
                                        <img src="{{ Storage::url($testimonial->author_image) }}" alt="{{ $testimonial->author }}" style="height: 40px; width: 40px; border-radius: 50%; object-fit: cover;">
                                    @else
                                        <span class="text-muted">None</span>
                                    @endif
                                </td>
                                <td>
                                    @for($i = 1; $i <= 5; $i++)
                                        @if($i <= $testimonial->rating)
                                            <i class="fas fa-star text-warning"></i>
                                        @else
                                            <i class="far fa-star text-warning"></i>
                                        @endif
                                    @endfor
                                </td>
                                <td>{{ $testimonial->source }}</td>
                                <td>
                                    @if($testimonial->is_active)
                                        <span class="badge bg-success rounded-pill px-3 py-2 fw-medium">Active</span>
                                    @else
                                        <span class="badge bg-danger rounded-pill px-3 py-2 fw-medium">Inactive</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('admin.testimonials.edit', $testimonial) }}" class="btn btn-sm btn-info">Edit</a>
                                    <form action="{{ route('admin.testimonials.destroy', $testimonial) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this review?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center">No reviews found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="mt-4">
                {{ $testimonials->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
