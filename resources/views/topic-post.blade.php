@extends('layouts.app')

@section('content')
@php
    $postImage = function ($post) {
        $image = data_get($post, 'image');
        return $image && \Illuminate\Support\Str::startsWith($image, ['http://', 'https://'])
            ? $image
            : ($image ? Storage::url($image) : 'https://images.unsplash.com/photo-1554224155-8d04cb21cd6c?auto=format&fit=crop&w=1000&q=80');
    };
@endphp

<main class="mx-auto max-w-4xl px-5 py-14 lg:px-10">
    <a href="{{ route('topic.show', $post->topic->slug) }}" class="inline-flex items-center gap-2 text-sm font-bold text-emerald-700 hover:text-emerald-800"><i class="fas fa-arrow-left text-xs"></i> Back to {{ strtolower($post->topic->title) }}</a>
    
    <img src="{{ $postImage($post) }}" alt="{{ $post->title }}" class="mt-8 h-72 w-full object-cover md:h-96">
    
    <div class="mt-8 flex items-center gap-x-4 text-sm font-bold uppercase tracking-[.18em] text-emerald-600">
        @if($post->published_date)
            <span>{{ $post->published_date->format('F d, Y') }}</span>
        @endif
    </div>
    
    <h1 class="mt-3 text-4xl font-bold leading-tight text-slate-900 md:text-5xl">{{ $post->title }}</h1>
    
    <div class="mt-10 whitespace-pre-line text-base leading-8 text-slate-600">
        {{ $post->content }}
    </div>
</main>
@endsection
