@extends('layouts.app')

@section('content')
@php
    $blogImage = function ($blog) {
        $image = data_get($blog, 'image');
        return $image && \Illuminate\Support\Str::startsWith($image, ['http://', 'https://'])
            ? $image
            : ($image ? Storage::url($image) : 'https://images.unsplash.com/photo-1554224155-8d04cb21cd6c?auto=format&fit=crop&w=1000&q=80');
    };
@endphp

<!-- HERO BANNER -->
<section class="relative overflow-hidden bg-slate-800 bg-cover bg-center px-5 py-24 lg:px-10" style="background-image: linear-gradient(rgba(13,35,58,.8), rgba(13,35,58,.8)), url('https://images.unsplash.com/photo-1454165804606-c3d57bc86b40?auto=format&fit=crop&w=1600&q=80');">
    <div class="mx-auto max-w-7xl text-center">
        <h1 class="text-4xl font-extrabold uppercase tracking-tight text-white md:text-5xl drop-shadow-lg mb-4">Insights & Articles</h1>
        <div class="flex items-center justify-center space-x-2 text-sm mt-4 font-semibold text-blue-200">
            <a href="{{ route('home') }}" class="hover:text-white transition">Home</a>
            <i class="fas fa-chevron-right text-xs mx-2"></i>
            <span class="text-emerald-400">Blogs</span>
        </div>
    </div>
</section>

<!-- MAIN CONTENT & SIDEBAR -->
<main class="mx-auto max-w-7xl px-5 py-16 lg:px-10">
    <div class="flex flex-col lg:flex-row gap-12">
        
        <!-- BLOG LIST (70%) -->
        <section class="lg:w-2/3">
            @if(request('search'))
                <div class="mb-8 p-4 bg-emerald-50 border border-emerald-100 rounded text-emerald-800 font-medium flex justify-between items-center">
                    <span>Search results for: "<strong>{{ request('search') }}</strong>"</span>
                    <a href="{{ route('blogs') }}" class="text-emerald-600 hover:text-emerald-800 text-sm underline">Clear Search</a>
                </div>
            @endif

            <div class="space-y-12">
                @forelse($blogs as $blog)
                    <article class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-xl transition-all duration-300 flex flex-col md:flex-row group transform hover:-translate-y-1">
                        <!-- Image Container -->
                        <div class="md:w-5/12 relative h-64 md:h-auto overflow-hidden bg-gray-100">
                            <img src="{{ $blogImage($blog) }}" alt="{{ $blog->title }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-500" loading="lazy">
                            @if($blog->category)
                                <a href="{{ route('blog.category', $blog->category->slug) }}" class="absolute top-4 left-4 bg-emerald-600 text-white text-[10px] font-bold uppercase tracking-wider px-3 py-1 rounded shadow-sm hover:bg-emerald-700 transition">
                                    {{ $blog->category->name }}
                                </a>
                            @endif
                        </div>
                        
                        <!-- Content Container -->
                        <div class="md:w-7/12 p-6 md:p-8 flex flex-col justify-center">
                            <div class="flex flex-wrap items-center gap-x-4 gap-y-2 text-xs font-bold uppercase tracking-wider text-emerald-600 mb-3">
                                <span><i class="far fa-calendar-alt mr-1"></i> {{ $blog->published_date ? \Carbon\Carbon::parse($blog->published_date)->format('M d, Y') : $blog->created_at->format('M d, Y') }}</span>
                            </div>
                            
                            <h2 class="text-2xl font-bold text-gray-900 leading-snug mb-4 group-hover:text-emerald-700 transition">
                                <a href="{{ route('blog.show', $blog->slug) }}">{{ $blog->title }}</a>
                            </h2>
                            
                            <p class="text-sm text-gray-600 mb-6 line-clamp-3 leading-relaxed">
                                {{ Str::limit(strip_tags($blog->content), 180) }}
                            </p>
                            
                            <div class="mt-auto flex items-center justify-between">
                                <div class="flex items-center text-xs font-semibold text-gray-500">
                                    <i class="far fa-user mr-2 text-gray-400"></i> {{ $blog->author ?: 'CA Team' }}
                                </div>
                                <a href="{{ route('blog.show', $blog->slug) }}" class="text-emerald-600 font-bold text-xs uppercase tracking-wider hover:text-emerald-800 transition flex items-center">
                                    Read More <i class="fas fa-chevron-right ml-1 text-[10px]"></i>
                                </a>
                            </div>
                        </div>
                    </article>
                @empty
                    <div class="bg-gray-50 border border-gray-100 rounded-lg p-12 text-center shadow-sm">
                        <i class="fas fa-newspaper text-4xl text-gray-300 mb-4"></i>
                        <p class="text-slate-500 font-medium text-lg">No articles found.</p>
                    </div>
                @endforelse
            </div>

            <!-- Pagination -->
            @if($blogs->hasPages())
                <div class="mt-12">
                    {{ $blogs->links('pagination::tailwind') }}
                </div>
            @endif
        </section>

        <!-- SIDEBAR (30%) -->
        <aside class="lg:w-1/3 space-y-10">
            <!-- Search Widget -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                <h3 class="text-lg font-bold text-gray-900 mb-4 pb-2 border-b border-gray-100 relative after:absolute after:bottom-[-1px] after:left-0 after:w-12 after:h-[2px] after:bg-emerald-500">Search Articles</h3>
                <form action="{{ route('blogs') }}" method="GET" class="relative">
                    <input type="search" name="search" value="{{ request('search') }}" placeholder="Search topics..." class="w-full bg-gray-50 border border-gray-200 rounded px-4 py-3 text-sm focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500 focus:outline-none transition">
                    <button type="submit" aria-label="Search" class="absolute right-3 top-3 text-emerald-600 hover:text-emerald-800 transition">
                        <i class="fas fa-search"></i>
                    </button>
                </form>
            </div>

            <!-- Categories Widget -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                <h3 class="text-lg font-bold text-gray-900 mb-4 pb-2 border-b border-gray-100 relative after:absolute after:bottom-[-1px] after:left-0 after:w-12 after:h-[2px] after:bg-emerald-500">Categories</h3>
                <ul class="space-y-3">
                    @forelse($categories as $cat)
                        <li>
                            <a href="{{ route('blog.category', $cat->slug) }}" class="flex items-center justify-between text-gray-600 hover:text-emerald-600 transition group font-medium text-sm">
                                <span><i class="fas fa-angle-right text-xs mr-2 text-emerald-400 group-hover:translate-x-1 transition-transform"></i> {{ $cat->name }}</span>
                                <span class="bg-gray-100 text-gray-500 text-xs px-2 py-0.5 rounded group-hover:bg-emerald-100 group-hover:text-emerald-700 transition">{{ $cat->blogs()->where('is_published', true)->count() }}</span>
                            </a>
                        </li>
                    @empty
                        <li class="text-sm text-gray-500">No categories found.</li>
                    @endforelse
                </ul>
            </div>

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
