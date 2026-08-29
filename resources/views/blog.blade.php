@extends('layouts.app')

@section('title', $blog->meta_title ?? $blog->title)
@section('meta_description', $blog->meta_description ?? Str::limit(strip_tags($blog->content), 160))
@section('meta_keywords', $blog->meta_keywords ?? '')

@push('meta')
    <meta property="og:title" content="{{ $blog->meta_title ?? $blog->title }}">
    <meta property="og:description" content="{{ $blog->meta_description ?? Str::limit(strip_tags($blog->content), 160) }}">
    <meta property="og:type" content="article">
    <meta property="og:url" content="{{ url()->current() }}">
    @if($blog->og_image)
        <meta property="og:image" content="{{ Storage::url($blog->og_image) }}">
    @elseif($blog->image)
        <meta property="og:image" content="{{ Storage::url($blog->image) }}">
    @endif
@endpush

@section('content')
@php
    $blogImage = function ($blog) {
        $image = data_get($blog, 'image');
        return $image && \Illuminate\Support\Str::startsWith($image, ['http://', 'https://'])
            ? $image
            : ($image ? Storage::url($image) : 'https://images.unsplash.com/photo-1554224155-8d04cb21cd6c?auto=format&fit=crop&w=1000&q=80');
    };
@endphp

<!-- BLOG HEADER -->
<section class="relative overflow-hidden bg-slate-800 bg-cover bg-center px-5 py-20 lg:px-10" style="background-image: linear-gradient(rgba(13,35,58,.85), rgba(13,35,58,.85)), url('{{ $blogImage($blog) }}');">
    <div class="mx-auto max-w-7xl text-center">
        @if($blog->category)
            <a href="{{ route('blog.category', $blog->category->slug) }}" class="inline-block bg-emerald-600 text-white text-xs font-bold uppercase tracking-wider px-3 py-1 rounded mb-6 hover:bg-emerald-700 transition">
                {{ $blog->category->name }}
            </a>
        @endif
        
        <h1 class="text-3xl font-bold tracking-tight text-white md:text-5xl leading-tight mb-6 max-w-4xl mx-auto">
            {{ $blog->title }}
        </h1>
        
        <div class="flex flex-wrap items-center justify-center gap-x-6 gap-y-2 text-sm font-semibold text-slate-300">
            <span><i class="far fa-user text-emerald-400 mr-2"></i>{{ $blog->author ?: 'Team' }}</span>
            <span><i class="far fa-calendar-alt text-emerald-400 mr-2"></i>{{ $blog->published_date ? \Carbon\Carbon::parse($blog->published_date)->format('F d, Y') : $blog->created_at->format('F d, Y') }}</span>
        </div>
    </div>
</section>

<!-- MAIN CONTENT & SIDEBAR -->
<main class="mx-auto max-w-7xl px-5 py-16 lg:px-10">
    <div class="flex flex-col lg:flex-row gap-12">
        
        <!-- BLOG CONTENT (70%) -->
        <section class="lg:w-2/3">
            <div class="bg-white p-8 md:p-10 rounded-xl shadow-sm border border-gray-100">
                <article class="prose prose-slate prose-lg max-w-none text-gray-700">
                    {!! $blog->content !!}
                </article>
                
                <!-- Tags -->
                @if($blog->tags->count() > 0)
                    <div class="mt-12 pt-6 border-t border-gray-100">
                        <h4 class="text-sm font-bold uppercase tracking-wider text-gray-900 mb-4">Tags</h4>
                        <div class="flex flex-wrap gap-2">
                            @foreach($blog->tags as $tag)
                                <a href="{{ route('blogs', ['tag' => $tag->slug]) }}" class="bg-gray-100 text-gray-600 px-3 py-1.5 text-[11px] font-bold uppercase rounded hover:bg-emerald-600 hover:text-white transition">
                                    {{ $tag->name }}
                                </a>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>

            <!-- RELATED POSTS -->
            @if(isset($relatedBlogs) && $relatedBlogs->count() > 0)
                <div class="mt-16">
                    <h3 class="text-xl font-bold text-gray-900 mb-6 pb-2 border-b border-gray-200">Related Posts</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach($relatedBlogs as $related)
                            <article class="bg-white rounded-lg shadow-sm border border-gray-100 overflow-hidden hover:shadow-lg transition duration-300 flex flex-col h-full group">
                                <div class="relative h-32 overflow-hidden">
                                    <img src="{{ $blogImage($related) }}" alt="{{ $related->title }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-500" loading="lazy">
                                </div>
                                <div class="p-4 flex flex-col flex-grow">
                                    <div class="text-[10px] font-bold uppercase tracking-wider text-emerald-600 mb-2">
                                        {{ $related->published_date ? \Carbon\Carbon::parse($related->published_date)->format('F d, Y') : $related->created_at->format('F d, Y') }}
                                    </div>
                                    <h4 class="text-sm font-bold text-gray-900 leading-snug mb-3 group-hover:text-emerald-700 transition">
                                        <a href="{{ route('blog.show', $related->slug) }}">{{ $related->title }}</a>
                                    </h4>
                                </div>
                            </article>
                        @endforeach
                    </div>
                </div>
            @endif
        </section>

        <!-- SIDEBAR (30%) -->
        <aside class="lg:w-1/3 space-y-10">
            <!-- Search Widget -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                <h3 class="text-lg font-bold text-gray-900 mb-4 pb-2 border-b border-gray-100 relative after:absolute after:bottom-[-1px] after:left-0 after:w-12 after:h-[2px] after:bg-emerald-500">Search Articles</h3>
                <form action="{{ route('blogs') }}" method="GET" class="relative">
                    <input type="search" name="search" placeholder="Search topics..." class="w-full bg-gray-50 border border-gray-200 rounded px-4 py-3 text-sm focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500 focus:outline-none transition">
                    <button type="submit" aria-label="Search" class="absolute right-3 top-3 text-emerald-600 hover:text-emerald-800 transition">
                        <i class="fas fa-search"></i>
                    </button>
                </form>
            </div>

            <!-- Categories Widget -->
            @if(isset($categories) && $categories->count() > 0)
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                    <h3 class="text-lg font-bold text-gray-900 mb-4 pb-2 border-b border-gray-100 relative after:absolute after:bottom-[-1px] after:left-0 after:w-12 after:h-[2px] after:bg-emerald-500">Categories</h3>
                    <ul class="space-y-3">
                        @foreach($categories as $cat)
                            <li>
                                <a href="{{ route('blog.category', $cat->slug) }}" class="flex items-center justify-between text-gray-600 hover:text-emerald-600 transition group font-medium text-sm">
                                    <span><i class="fas fa-angle-right text-xs mr-2 text-emerald-400 group-hover:translate-x-1 transition-transform"></i> {{ $cat->name }}</span>
                                    <span class="bg-gray-100 text-gray-500 text-xs px-2 py-0.5 rounded group-hover:bg-emerald-100 group-hover:text-emerald-700 transition">{{ $cat->blogs()->where('is_published', true)->count() }}</span>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Recent Posts Widget -->
            @if(isset($recentBlogs) && $recentBlogs->count() > 0)
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                    <h3 class="text-lg font-bold text-gray-900 mb-4 pb-2 border-b border-gray-100 relative after:absolute after:bottom-[-1px] after:left-0 after:w-12 after:h-[2px] after:bg-emerald-500">Recent Posts</h3>
                    <div class="space-y-5">
                        @foreach($recentBlogs as $recent)
                            <a href="{{ route('blog.show', $recent->slug) }}" class="flex gap-4 group">
                                <div class="w-20 h-20 shrink-0 rounded overflow-hidden">
                                    <img src="{{ $blogImage($recent) }}" alt="{{ $recent->title }}" class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
                                </div>
                                <div class="flex flex-col justify-center">
                                    <h4 class="text-sm font-bold text-gray-800 leading-tight group-hover:text-emerald-600 transition line-clamp-2 mb-1">{{ $recent->title }}</h4>
                                    <span class="text-[10px] font-bold uppercase tracking-wider text-emerald-500">
                                        {{ $recent->published_date ? \Carbon\Carbon::parse($recent->published_date)->format('M d, Y') : $recent->created_at->format('M d, Y') }}
                                    </span>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
            @endif
            
            <!-- Tags Widget -->
            @if(isset($tags) && $tags->count() > 0)
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                    <h3 class="text-lg font-bold text-gray-900 mb-4 pb-2 border-b border-gray-100 relative after:absolute after:bottom-[-1px] after:left-0 after:w-12 after:h-[2px] after:bg-emerald-500">Tags</h3>
                    <div class="flex flex-wrap gap-2">
                        @foreach($tags as $tag)
                            <a href="{{ route('blogs', ['tag' => $tag->slug]) }}" class="bg-gray-100 text-gray-600 px-3 py-1.5 text-[11px] font-bold uppercase rounded hover:bg-emerald-600 hover:text-white transition">
                                {{ $tag->name }}
                            </a>
                        @endforeach
                    </div>
                </div>
            @endif
        </aside>
    </div>
</main>
@endsection
