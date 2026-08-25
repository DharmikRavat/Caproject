@extends('layouts.admin')

@section('content')
<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="section-title mb-0">Team members</h1>
        <a href="{{ route('admin.team-members.create') }}" class="btn btn-primary-custom">Add member</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card border-0 shadow-sm">
        <div class="table-responsive">
            <table class="table mb-0">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Position</th>
                        <th>Contact</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($teamMembers as $member)
                        <tr>
                            <td>{{ $member->name }}</td>
                            <td>{{ $member->position }}</td>
                            <td>{{ $member->email }}</td>
                            <td>
                                <a href="{{ route('admin.team-members.edit', $member) }}" class="btn btn-sm btn-outline-primary">Edit</a>
                                <form action="{{ route('admin.team-members.destroy', $member) }}" method="POST" class="d-inline">
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
