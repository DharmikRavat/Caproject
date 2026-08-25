@extends('layouts.admin')

@section('content')
<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4"><h1 class="section-title mb-0">Job applications</h1></div>
    @if(session('success'))<div class="alert alert-success">{{ session('success') }}</div>@endif
    <div class="card border-0 shadow-sm"><div class="table-responsive"><table class="table table-hover mb-0">
        <thead><tr><th>Applicant</th><th>Position</th><th>Contact</th><th>Resume</th><th>Status</th><th>Applied</th></tr></thead>
        <tbody>
        @forelse($applications as $application)
            <tr><td>{{ $application->name }}</td><td>{{ $application->career->title ?? 'Position removed' }}</td><td>{{ $application->email }}<br>{{ $application->phone }}</td><td><a href="{{ Storage::url($application->resume_path) }}" target="_blank" rel="noopener">View resume</a></td><td><form action="{{ route('admin.job-applications.status', $application) }}" method="POST">@csrf @method('PATCH')<select name="status" class="form-select form-select-sm" onchange="this.form.submit()"><option value="new" {{ $application->status === 'new' ? 'selected' : '' }}>New</option><option value="reviewing" {{ $application->status === 'reviewing' ? 'selected' : '' }}>Reviewing</option><option value="shortlisted" {{ $application->status === 'shortlisted' ? 'selected' : '' }}>Shortlisted</option><option value="rejected" {{ $application->status === 'rejected' ? 'selected' : '' }}>Rejected</option><option value="hired" {{ $application->status === 'hired' ? 'selected' : '' }}>Hired</option></select></form></td><td>{{ $application->created_at->format('d M Y') }}</td></tr>
        @empty
            <tr><td colspan="6" class="text-center py-5 text-muted">No job applications yet.</td></tr>
        @endforelse
        </tbody>
    </table></div></div>
</div>
@endsection
