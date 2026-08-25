@extends('layouts.app')

@section('content')
@php
    $heroImage = $siteSettings['about_page_hero_image'] ?? '';
    $visionImage = $siteSettings['about_page_vision_image'] ?? '';
    $heroImage = \Illuminate\Support\Str::startsWith($heroImage, ['http://', 'https://']) ? $heroImage : Storage::url($heroImage);
    $visionImage = \Illuminate\Support\Str::startsWith($visionImage, ['http://', 'https://']) ? $visionImage : Storage::url($visionImage);
@endphp
<div class="bg-[#0d233a] px-5 py-2 text-xs text-white lg:px-10">
    <div class="mx-auto flex max-w-7xl flex-wrap items-center gap-x-8 gap-y-2">
        <a href="mailto:{{ $siteSettings['contact_email'] ?? 'cajiteshtellsara@gmail.com' }}" class="flex items-center gap-2 transition hover:text-emerald-300"><i class="far fa-envelope text-emerald-400"></i>{{ $siteSettings['contact_email'] ?? 'cajiteshtellsara@gmail.com' }}</a>
        <a href="tel:{{ $siteSettings['contact_phone'] ?? '+91 70765 52839' }}" class="flex items-center gap-2 transition hover:text-emerald-300"><i class="fas fa-phone text-emerald-400"></i>{{ $siteSettings['contact_phone'] ?? '+91 70765 52839' }}</a>
    </div>
</div>

<section class="relative overflow-hidden bg-slate-800 bg-cover bg-center px-5 py-16 lg:px-10" style="background-image: linear-gradient(rgba(13,35,58,.88), rgba(13,35,58,.88)), url('{{ $heroImage }}');">
    <div class="relative mx-auto max-w-7xl">
        <p class="mb-3 text-sm text-slate-300"><a href="{{ route('home') }}" class="hover:text-white">Home</a> <span class="mx-2 text-emerald-400">/</span> About Us</p>
        <h1 class="text-4xl font-bold tracking-tight text-white md:text-5xl">About Us</h1>
    </div>
</section>

<main class="mx-auto max-w-7xl space-y-16 px-5 py-14 lg:px-10">
    <section class="max-w-4xl">
        <p class="mb-3 text-sm font-bold uppercase tracking-[.18em] text-emerald-600">Our firm</p>
        <h2 class="mb-6 text-3xl font-bold tracking-tight text-slate-900 md:text-4xl">{{ $siteSettings['about_page_title'] }}</h2>
        <div class="space-y-5 text-base leading-8 text-slate-600">
            <p>{{ $siteSettings['about_page_intro'] }}</p>
            <p>{{ $siteSettings['about_page_intro_secondary'] }}</p>
        </div>
    </section>

    <section class="grid gap-10 border-y border-slate-200 py-12 lg:grid-cols-[.8fr_1.2fr] lg:items-start">
        <div><p class="mb-3 text-sm font-bold uppercase tracking-[.18em] text-emerald-600">Our approach</p><h2 class="text-3xl font-bold tracking-tight text-slate-900">{{ $siteSettings['about_page_why_title'] }}</h2></div>
        <ul class="space-y-5 text-base leading-7 text-slate-600">
            @foreach(json_decode($siteSettings['about_page_why_points'], true) as $point)
                <li class="flex gap-4"><i class="fas fa-check mt-1 text-emerald-600"></i><span>{{ $point }}</span></li>
            @endforeach
        </ul>
    </section>

    <section class="relative overflow-hidden bg-cover bg-center px-6 py-16 text-center text-white md:px-12" style="background-image: linear-gradient(rgba(13,35,58,.93), rgba(13,35,58,.93)), url('{{ $visionImage }}');">
        <p class="mb-3 text-sm font-bold uppercase tracking-[.18em] text-emerald-300">Looking ahead</p><h2 class="mb-5 text-3xl font-bold">Our Vision</h2>
        <p class="mx-auto max-w-3xl text-base leading-8 text-slate-200">{{ $siteSettings['about_page_vision'] }}</p>
    </section>

    <section>
        <div class="mb-8 flex flex-wrap items-end justify-between gap-4"><div><p class="mb-3 text-sm font-bold uppercase tracking-[.18em] text-emerald-600">The people behind the work</p><h2 class="text-3xl font-bold tracking-tight text-slate-900">Meet Our Team</h2></div><a href="{{ route('contact') }}" class="inline-flex items-center gap-2 font-bold text-blue-900 transition hover:text-emerald-600">Start a conversation <i class="fas fa-arrow-right text-sm"></i></a></div>
        <div class="grid gap-8 md:grid-cols-2">
            @forelse($teamMembers as $teamMember)
                <article class="overflow-hidden border border-slate-200 bg-white shadow-sm"><img src="{{ $teamMember->image ? Storage::url($teamMember->image) : asset('images/team-placeholder.jpg') }}" alt="{{ $teamMember->name }}" class="h-72 w-full object-cover" loading="lazy"><div class="p-6"><h3 class="text-xl font-bold text-slate-900">{{ $teamMember->name }}</h3><p class="mt-1 text-sm font-bold text-emerald-600">{{ $teamMember->position }}</p><p class="mt-4 leading-7 text-slate-600">{{ $teamMember->bio }}</p></div></article>
            @empty
                <p class="text-slate-600">Team information will be available soon.</p>
            @endforelse
        </div>
    </section>
</main>
@endsection
