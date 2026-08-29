@extends('layouts.app')

@section('content')
@php
    $bannerImage = $category->banner_image 
        ? Storage::url($category->banner_image) 
        : 'https://images.unsplash.com/photo-1499951360447-b19be8fe80f5?auto=format&fit=crop&w=1600&q=80';
        
    $blogImage = function ($blog) {
        $image = data_get($blog, 'image');
        return $image && \Illuminate\Support\Str::startsWith($image, ['http://', 'https://'])
            ? $image
            : ($image ? Storage::url($image) : 'https://images.unsplash.com/photo-1554224155-8d04cb21cd6c?auto=format&fit=crop&w=1000&q=80');
    };
@endphp

<!-- CATEGORY BANNER -->
<section class="relative overflow-hidden bg-slate-800 bg-cover bg-center px-5 py-14 lg:px-10" style="background-image: linear-gradient(rgba(13,35,58,.78), rgba(13,35,58,.78)), url('{{ $bannerImage }}');">
    <div class="mx-auto max-w-7xl">
        <p class="mb-3 text-sm text-slate-300">
            <a href="{{ route('home') }}" class="hover:text-white transition">Home</a> 
            <span class="mx-2 text-emerald-400">></span> 
            <span class="text-white font-medium">{{ $category->name }}</span>
        </p>
        <h1 class="text-4xl font-bold tracking-tight text-white md:text-5xl uppercase">{{ $category->name }}</h1>
        @if($category->description)
            <p class="mt-4 text-slate-200 max-w-2xl">{{ $category->description }}</p>
        @endif
    </div>
</section>

<!-- MAIN CONTENT -->
<main class="mx-auto max-w-7xl px-5 py-14 lg:px-10">
    <div class="grid gap-12 lg:grid-cols-[1fr_300px]">
        <!-- Blog Grid Area -->
        <section>
            @if($blogs->isEmpty())
                <div class="bg-gray-50 border border-gray-100 rounded-lg p-8 text-center">
                    <i class="fas fa-folder-open text-4xl text-emerald-200 mb-4"></i>
                    <p class="text-slate-600 font-medium">No blogs found in this category.</p>
                </div>
            @else
                <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-8">
                    @foreach($blogs as $blog)
                        <article class="bg-white rounded-lg shadow-sm border border-slate-100 overflow-hidden hover:shadow-lg transition duration-300 flex flex-col h-full group">
                            <div class="relative h-48 overflow-hidden">
                                <img src="{{ $blogImage($blog) }}" alt="{{ $blog->title }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-500" loading="lazy">
                            </div>
                            <div class="p-6 flex flex-col flex-grow">
                                <div class="text-[10px] font-bold uppercase tracking-wider text-emerald-600 mb-3">
                                    {{ $blog->published_date ? \Carbon\Carbon::parse($blog->published_date)->format('F d, Y') : $blog->created_at->format('F d, Y') }}
                                </div>
                                <h3 class="text-lg font-bold text-slate-900 leading-snug mb-3 group-hover:text-emerald-700 transition">
                                    <a href="{{ route('blog.show', $blog->slug) }}">{{ $blog->title }}</a>
                                </h3>
                                <p class="text-sm text-slate-600 mb-5 line-clamp-3">
                                    {{ Str::limit($blog->excerpt ?? strip_tags($blog->content), 120) }}
                                </p>
                                <div class="mt-auto">
                                    <a href="{{ route('blog.show', $blog->slug) }}" class="text-emerald-600 font-bold text-xs uppercase tracking-wider hover:text-emerald-800 transition flex items-center">
                                        Read More <i class="fas fa-chevron-right ml-1 text-[10px]"></i>
                                    </a>
                                </div>
                            </div>
                        </article>
                    @endforeach
                </div>
                
                @if($blogs->hasPages())
                    <div class="mt-12 flex justify-center">
                        {{ $blogs->links('pagination::tailwind') }}
                    </div>
                @endif
            @endif
        </section>

        <!-- Sidebar Area -->
        <aside class="space-y-10">
            <!-- Search Widget -->
            <div class="bg-slate-50 p-6 rounded-lg border border-slate-100">
                <h2 class="text-sm font-bold uppercase tracking-widest text-slate-900 mb-4 pb-3 border-b border-slate-200">Search</h2>
                <form action="{{ route('blog.category', $category->slug) }}" method="GET" class="relative">
                    <input type="search" name="search" value="{{ request('search') }}" placeholder="Search blogs..." class="w-full border border-slate-200 bg-white p-3 pr-10 text-sm focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500 outline-none rounded transition">
                    <button type="submit" aria-label="Search" class="absolute right-3 top-3 text-slate-400 hover:text-emerald-600 transition">
                        <i class="fas fa-search"></i>
                    </button>
                </form>
            </div>

            <!-- Recent Posts Widget -->
            <div class="bg-slate-50 p-6 rounded-lg border border-slate-100">
                <h2 class="text-sm font-bold uppercase tracking-widest text-slate-900 mb-4 pb-3 border-b border-slate-200">Recent Posts</h2>
                <div class="space-y-5">
                    @forelse($recentBlogs as $recent)
                        <a href="{{ route('blog.show', $recent->slug) }}" class="group flex gap-4 items-center">
                            <img src="{{ $blogImage($recent) }}" alt="{{ $recent->title }}" class="h-14 w-16 rounded object-cover flex-shrink-0 group-hover:opacity-80 transition">
                            <div>
                                <h4 class="text-xs font-bold leading-relaxed text-slate-800 group-hover:text-emerald-600 transition line-clamp-2">
                                    {{ $recent->title }}
                                </h4>
                                <span class="text-[10px] uppercase text-emerald-600 font-semibold mt-1 block">
                                    {{ $recent->published_date ? \Carbon\Carbon::parse($recent->published_date)->format('F d, Y') : $recent->created_at->format('F d, Y') }}
                                </span>
                            </div>
                        </a>
                    @empty
                        <p class="text-sm text-slate-500">No recent posts available.</p>
                    @endforelse
                </div>
            </div>
        </aside>
    </div>
</main>
@endsection
