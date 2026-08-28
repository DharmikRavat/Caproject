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

<section class="relative overflow-hidden bg-slate-800 bg-cover bg-center px-5 py-14 lg:px-10" style="background-image: linear-gradient(rgba(13,35,58,.78), rgba(13,35,58,.78)), url('https://images.unsplash.com/photo-1499951360447-b19be8fe80f5?auto=format&fit=crop&w=1600&q=80');">
    <div class="mx-auto max-w-7xl">
        <p class="mb-3 text-sm text-slate-300"><a href="{{ route('home') }}" class="hover:text-white">Home</a> <span class="mx-2 text-emerald-400">/</span> {{ strtolower($topic->title) }}</p>
        <h1 class="text-4xl font-bold tracking-tight text-white md:text-5xl">{{ strtolower($topic->title) }}</h1>
        @if($topic->description)
            <p class="mt-4 max-w-3xl text-lg text-slate-200">{{ $topic->description }}</p>
        @endif
    </div>
</section>

<main class="mx-auto max-w-7xl px-5 py-14 lg:px-10">
    @if($posts->count() > 0)
        <div class="grid gap-10 sm:grid-cols-2 lg:grid-cols-3">
            @foreach($posts as $post)
                <article class="flex flex-col">
                    <a href="{{ route('topic.post.show', $post->slug) }}" class="block overflow-hidden bg-slate-100">
                        <img src="{{ $postImage($post) }}" alt="{{ $post->title }}" class="h-56 w-full object-cover transition duration-300 hover:scale-105" loading="lazy">
                    </a>
                    <div class="mt-4 flex flex-wrap items-center gap-x-3 text-xs font-semibold uppercase text-slate-500">
                        @if($post->published_date)
                            <span>{{ $post->published_date->format('F d, Y') }}</span>
                        @endif
                    </div>
                    <h2 class="mt-2 text-xl font-bold leading-snug text-slate-900">
                        <a href="{{ route('topic.post.show', $post->slug) }}" class="hover:text-emerald-600">{{ $post->title }}</a>
                    </h2>
                    <p class="mt-3 flex-1 text-sm leading-6 text-slate-600">{{ Str::limit($post->excerpt ?? $post->content, 180) }}</p>
                    <div class="mt-4">
                        <a href="{{ route('topic.post.show', $post->slug) }}" class="inline-flex items-center text-sm font-bold text-emerald-600 hover:text-emerald-700">
                            [...]Read More <i class="fas fa-chevron-right ml-1 text-[10px]"></i>
                        </a>
                    </div>
                </article>
            @endforeach
        </div>
        
        @if($posts->hasPages())
            <div class="mt-12">
                {{ $posts->links() }}
            </div>
        @endif
    @else
        <div class="py-12 text-center text-slate-500">
            <i class="far fa-folder-open mb-3 text-4xl text-slate-300"></i>
            <p>No content available for this topic yet.</p>
        </div>
    @endif
</main>
@endsection
