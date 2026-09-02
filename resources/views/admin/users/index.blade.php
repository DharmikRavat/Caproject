@extends('layouts.admin')

@section('title', 'Admin Users')

@section('content')
<div class="container-fluid px-4 py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="section-title mb-0" style="font-size: 1.5rem;">Admin Users</h1>
        </div>
        <a href="{{ route('admin.users.create') }}" class="btn btn-primary btn-sm px-3 py-2 shadow-sm rounded-pill">
            <i class="fas fa-plus me-2"></i> Add Admin
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm" role="alert">
            <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm" role="alert">
            <i class="fas fa-exclamation-triangle me-2"></i> {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light text-secondary">
                        <tr>
                            <th class="ps-4 py-3" style="font-weight: 600; font-size: 0.85rem; text-transform: uppercase; letter-spacing: 0.5px;">Name</th>
                            <th class="py-3" style="font-weight: 600; font-size: 0.85rem; text-transform: uppercase; letter-spacing: 0.5px;">Email</th>
                            <th class="py-3" style="font-weight: 600; font-size: 0.85rem; text-transform: uppercase; letter-spacing: 0.5px;">Created</th>
                            <th class="text-end pe-4 py-3" style="font-weight: 600; font-size: 0.85rem; text-transform: uppercase; letter-spacing: 0.5px;">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="border-top-0">
                        @foreach($users as $user)
                            <tr>
                                <td class="ps-4 py-3">
                                    <div class="d-flex align-items-center">
                                        <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 40px; height: 40px; font-weight: 600;">
                                            {{ strtoupper(substr($user->name, 0, 1)) }}
                                        </div>
                                        <div>
                                            <span class="fw-bold text-dark d-block" style="font-size: 0.95rem;">{{ $user->name }}</span>
                                            @if($user->id === auth()->id())
                                                <span class="badge bg-success rounded-pill mt-1" style="font-size: 0.7rem;">You</span>
                                            @endif
                                        </div>
                                    </div>
                                </td>
                                <td class="py-3">
                                    <span class="text-muted" style="font-size: 0.9rem;">{{ $user->email }}</span>
                                </td>
                                <td class="py-3">
                                    <span class="text-muted" style="font-size: 0.9rem;">{{ $user->created_at->format('M d, Y') }}</span>
                                </td>
                                <td class="text-end pe-4 py-3">
                                    <div class="btn-group shadow-sm">
                                        <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-sm btn-outline-primary" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to remove this admin? This action cannot be undone.');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger {{ ($user->id === auth()->id() || $users->count() <= 1) ? 'disabled' : '' }}" title="Delete" {{ ($user->id === auth()->id() || $users->count() <= 1) ? 'disabled' : '' }}>
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @if($users->isEmpty())
                <div class="text-center py-5">
                    <div class="text-muted mb-3"><i class="fas fa-users fa-3x"></i></div>
                    <h5 class="text-secondary fw-bold">No admins found</h5>
                    <p class="text-muted mb-0">Get started by creating a new admin user.</p>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
