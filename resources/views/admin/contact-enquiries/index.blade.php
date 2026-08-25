@extends('layouts.admin')

@section('content')
<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4"><h1 class="section-title mb-0">Contact enquiries</h1></div>
    @if(session('success'))<div class="alert alert-success">{{ session('success') }}</div>@endif
    <div class="card border-0 shadow-sm"><div class="table-responsive"><table class="table table-hover mb-0">
        <thead><tr><th>Name</th><th>Contact</th><th>Subject</th><th>Message</th><th>Status</th><th>Received</th></tr></thead>
        <tbody>
        @forelse($enquiries as $enquiry)
            <tr><td>{{ $enquiry->name }}</td><td>{{ $enquiry->email }}<br>{{ $enquiry->phone }}</td><td>{{ $enquiry->subject }}</td><td>{{ Str::limit($enquiry->message, 80) }}</td><td><form action="{{ route('admin.contact-enquiries.status', $enquiry) }}" method="POST">@csrf @method('PATCH')<select name="status" class="form-select form-select-sm" onchange="this.form.submit()"><option value="new" {{ $enquiry->status === 'new' ? 'selected' : '' }}>New</option><option value="in_progress" {{ $enquiry->status === 'in_progress' ? 'selected' : '' }}>In progress</option><option value="closed" {{ $enquiry->status === 'closed' ? 'selected' : '' }}>Closed</option></select></form></td><td>{{ $enquiry->created_at->format('d M Y') }}</td></tr>
        @empty
            <tr><td colspan="6" class="text-center py-5 text-muted">No contact enquiries yet.</td></tr>
        @endforelse
        </tbody>
    </table></div></div>
</div>
@endsection
