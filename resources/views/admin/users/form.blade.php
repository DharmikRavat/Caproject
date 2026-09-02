@extends('layouts.admin')

@section('title', isset($user) ? 'Edit Admin User' : 'Add Admin User')

@section('content')
<div class="container-fluid px-4 py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="section-title mb-0" style="font-size: 1.5rem;">{{ isset($user) ? 'Edit Admin User' : 'Add Admin User' }}</h1>
        </div>
        <a href="{{ route('admin.users.index') }}" class="btn btn-outline-secondary btn-sm px-3 py-2 shadow-sm rounded-pill">
            <i class="fas fa-arrow-left me-2"></i> Back to Admins
        </a>
    </div>

    @if($errors->any())
        <div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm" role="alert">
            <i class="fas fa-exclamation-circle me-2"></i> Please fix the errors below.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            <ul class="mb-0 mt-2">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
        <div class="card-body p-4 p-md-5">
            <form action="{{ isset($user) ? route('admin.users.update', $user->id) : route('admin.users.store') }}" method="POST">
                @csrf
                @if(isset($user))
                    @method('PUT')
                @endif

                <div class="row g-4 mb-4">
                    <div class="col-md-6">
                        <label for="name" class="form-label fw-bold text-secondary" style="font-size: 0.9rem;">Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control form-control-lg @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $user->name ?? '') }}" required placeholder="e.g. John Doe">
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label for="email" class="form-label fw-bold text-secondary" style="font-size: 0.9rem;">Email Address <span class="text-danger">*</span></label>
                        <input type="email" class="form-control form-control-lg @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email', $user->email ?? '') }}" required placeholder="e.g. admin@example.com">
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-12">
                        <label for="password" class="form-label fw-bold text-secondary" style="font-size: 0.9rem;">
                            Password {!! isset($user) ? '<span class="text-muted fw-normal" style="font-size: 0.8rem;">(Leave blank to keep current)</span>' : '<span class="text-danger">*</span>' !!}
                        </label>
                        <div class="input-group">
                            <input type="password" class="form-control form-control-lg @error('password') is-invalid @enderror" id="password" name="password" {{ isset($user) ? '' : 'required' }} placeholder="Enter a secure password">
                            <button class="btn btn-outline-secondary" type="button" id="togglePassword" style="border-color: #ced4da;">
                                <i class="fas fa-eye"></i>
                            </button>
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <script>
                    document.getElementById('togglePassword').addEventListener('click', function (e) {
                        const passwordInput = document.getElementById('password');
                        const icon = this.querySelector('i');
                        if (passwordInput.type === 'password') {
                            passwordInput.type = 'text';
                            icon.classList.remove('fa-eye');
                            icon.classList.add('fa-eye-slash');
                        } else {
                            passwordInput.type = 'password';
                            icon.classList.remove('fa-eye-slash');
                            icon.classList.add('fa-eye');
                        }
                    });
                </script>
                </div>

                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary px-4 py-2 shadow-sm rounded-pill fw-bold">
                        <i class="fas fa-save me-2"></i> {{ isset($user) ? 'Save Changes' : 'Create Admin User' }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
