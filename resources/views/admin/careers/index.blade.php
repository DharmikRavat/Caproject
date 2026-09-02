@extends('layouts.admin')

@section('content')
<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="section-title mb-0">Careers</h1>
        <a href="{{ route('admin.careers.create') }}" class="btn btn-primary-custom">Add career</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card border-0 shadow-sm">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Location</th>
                        <th>Type</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($careers as $career)
                        <tr>
                            <td>{{ $career->title }}</td>
                            <td>{{ $career->location }}</td>
                            <td>{{ $career->type }}</td>
                            <td>
                                <a href="{{ route('admin.careers.edit', $career) }}" class="btn btn-sm btn-outline-primary">Edit</a>
                                <form action="{{ route('admin.careers.destroy', $career) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
