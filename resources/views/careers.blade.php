@extends('layouts.app')

@section('content')
@php
    $careerImage = $siteSettings['careers_page_image'] ?? '';
    $careerImage = \Illuminate\Support\Str::startsWith($careerImage, ['http://', 'https://']) ? $careerImage : Storage::url($careerImage);
    $roles = preg_split('/\r\n|\r|\n/', $siteSettings['careers_page_roles'] ?? '');
    $applicationCareer = $careers->first();
@endphp
<section class="relative overflow-hidden bg-slate-700 bg-cover bg-center px-5 py-12 lg:px-10" style="background-image: linear-gradient(rgba(30,58,95,.72), rgba(30,58,95,.72)), url('{{ $careerImage }}');">
    <div class="mx-auto max-w-7xl"><p class="mb-2 text-xs text-slate-200"><a href="{{ route('home') }}" class="hover:text-white">Home</a> <span class="mx-2 text-emerald-300">/</span> Careers</p><h1 class="text-3xl font-bold tracking-wide text-white md:text-4xl">{{ $siteSettings['careers_page_title'] }}</h1></div>
</section>
<main class="mx-auto max-w-7xl space-y-12 px-5 py-12 lg:px-10">
    @if(session('success'))
        <div class="border border-emerald-200 bg-emerald-50 px-5 py-4 text-sm text-emerald-800" role="status">{{ session('success') }}</div>
    @endif
    @if($errors->any())
        <div class="border border-red-200 bg-red-50 px-5 py-4 text-sm text-red-800" role="alert">
            <p class="font-bold">Please correct the following:</p>
            <ul class="mt-2 list-disc pl-5">@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
        </div>
    @endif
    <section class="space-y-6 text-base leading-8 text-slate-600"><p>{{ $siteSettings['careers_page_intro_1'] }}</p><p>{{ $siteSettings['careers_page_intro_2'] }}</p><ul class="list-disc space-y-2 pl-8">@foreach($roles as $role) @if(trim($role))<li>{{ trim($role) }}</li>@endif @endforeach</ul><p>{{ $siteSettings['careers_page_intro_3'] }}</p></section>
    <section>
        <h2 class="mb-7 text-3xl font-bold text-slate-900">{{ $siteSettings['careers_page_form_title'] }}</h2>
        @if($applicationCareer)
            <div class="grid gap-10 lg:grid-cols-2">
                <form method="POST" action="{{ route('career.apply', $applicationCareer->slug) }}" enctype="multipart/form-data" class="space-y-4">
                    @csrf
                    <div class="grid gap-4 sm:grid-cols-2"><input type="text" name="name" value="{{ old('name') }}" placeholder="Name" class="w-full border border-slate-200 p-3 text-sm focus:border-emerald-500 focus:outline-none" required><input type="text" name="phone" value="{{ old('phone') }}" placeholder="Phone" class="w-full border border-slate-200 p-3 text-sm focus:border-emerald-500 focus:outline-none" required></div>
                    <input type="email" name="email" value="{{ old('email') }}" placeholder="Email" class="w-full border border-slate-200 p-3 text-sm focus:border-emerald-500 focus:outline-none" required>
                    <label class="block text-sm font-semibold text-slate-700">Upload Resume (PDF, DOC, or DOCX)<input type="file" name="resume" accept=".pdf,.doc,.docx" class="mt-2 block w-full border border-slate-200 p-2 text-sm" required></label>
                    <textarea name="cover_letter" placeholder="Message" rows="5" class="w-full border border-slate-200 p-3 text-sm focus:border-emerald-500 focus:outline-none">{{ old('cover_letter') }}</textarea>
                    <button type="submit" class="bg-emerald-600 px-8 py-3 text-sm font-bold text-white transition hover:bg-emerald-700">SUBMIT</button>
                </form>
                <img src="{{ $careerImage }}" alt="Our team at work" class="h-full min-h-64 w-full object-cover shadow-sm">
            </div>
        @else
            <p class="border border-slate-200 p-6 text-slate-600">There are no open positions at the moment. Please check back soon.</p>
        @endif
    </section>
</main>
@endsection
