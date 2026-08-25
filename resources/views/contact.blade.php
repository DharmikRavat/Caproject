@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row g-5">
        <div class="col-lg-5">
            <span class="badge badge-soft px-3 py-2 rounded-pill mb-3">Contact</span>
            <h1 class="section-title display-6 fw-bold">Let’s talk about your financial goals.</h1>
            <p class="text-muted">Whether you need tax guidance, compliance support, or strategic planning, our team is ready to help.</p>
            <ul class="list-unstyled text-muted">
                <li><strong>Email:</strong> info@apexca.in</li>
                <li><strong>Phone:</strong> +91 98765 43210</li>
                <li><strong>Address:</strong> 24 Business Plaza, New Delhi</li>
            </ul>
        </div>
        <div class="col-lg-7">
            <div class="card border-0 shadow-sm rounded-4 p-4">
                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                <form method="POST" action="{{ route('contact.submit') }}">
                    @csrf
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Name</label>
                            <input type="text" name="name" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Email</label>
                            <input type="email" name="email" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Phone</label>
                            <input type="text" name="phone" class="form-control">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Subject</label>
                            <input type="text" name="subject" class="form-control" required>
                        </div>
                        <div class="col-12">
                            <label class="form-label">Message</label>
                            <textarea name="message" class="form-control" rows="5" required></textarea>
                        </div>
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary-custom">Send enquiry</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
