@extends('layouts.app')

@section('title', 'Archives: ' . $archive->name . ' | ' . config('app.name', 'Laravel'))
@section('meta_description', $archive->meta_description ?? 'Read our latest blogs from ' . $archive->name)
@section('meta_keywords', $archive->meta_keywords ?? '')

@section('content')

<!-- HERO BANNER -->
<section class="relative overflow-hidden bg-slate-800 bg-cover bg-center px-5 py-24 lg:px-10" 
style="background-image: linear-gradient(rgba(13,35,58,.8), rgba(13,35,58,.8)), 
url('{{ $archive->image ? Storage::url($archive->image) : 'https://images.unsplash.com/photo-1454165804606-c3d57bc86b40?auto=format&fit=crop&w=1600&q=80' }}');">
    <div class="mx-auto max-w-7xl text-center">
        <h1 class="text-4xl font-extrabold uppercase tracking-tight text-white md:text-5xl drop-shadow-lg mb-4">Archive: {{ $archive->name }}</h1>
        @if($archive->description)
            <p class="text-lg text-blue-100 max-w-3xl mx-auto mb-6">{{ $archive->description }}</p>
        @endif
        <div class="flex items-center justify-center space-x-2 text-sm mt-4 font-semibold text-blue-200">
            <a href="{{ route('home') }}" class="hover:text-white transition">Home</a>
            <i class="fas fa-chevron-right text-xs mx-2"></i>
            <a href="{{ route('blogs') }}" class="hover:text-white transition">Blogs</a>
            <i class="fas fa-chevron-right text-xs mx-2"></i>
            <span class="text-emerald-400">{{ $archive->name }}</span>
        </div>
    </div>
</section>

<!-- MAIN CONTENT & SIDEBAR -->
<main class="mx-auto max-w-7xl px-5 py-16 lg:px-10">
    <div class="flex flex-col lg:flex-row gap-12">
        
        <!-- BLOG LIST (70%) -->
        <section class="lg:w-2/3">
            
            <h2 class="text-2xl font-bold uppercase tracking-tight text-gray-900 mb-8 border-b-2 border-emerald-500 inline-block pb-2">
                Blogs from {{ $archive->name }}
            </h2>

            @if(request('search'))
                <div class="mb-8 p-4 bg-emerald-50 border border-emerald-100 rounded text-emerald-800 font-medium flex justify-between items-center">
                    <span>Search results for: "<strong>{{ request('search') }}</strong>" in {{ $archive->name }}</span>
                    <a href="{{ route('blog.archive', $archive->slug) }}" class="text-emerald-600 hover:text-emerald-800 text-sm underline">Clear Search</a>
                </div>
            @endif

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                @forelse($blogs as $blog)
                    <x-blog-card :blog="$blog" />
                @empty
                    <div class="col-span-full bg-gray-50 border border-gray-100 rounded-lg p-12 text-center shadow-sm">
                        <i class="fas fa-archive text-4xl text-gray-300 mb-4"></i>
                        <p class="text-slate-500 font-medium text-lg">No blogs found in this archive.</p>
                    </div>
                @endforelse
            </div>

            <!-- Pagination -->
            @if($blogs->hasPages())
                <div class="mt-8">
                    {{ $blogs->links('pagination::tailwind') }}
                </div>
            @endif
        </section>

        <!-- SIDEBAR -->
        <x-blog-sidebar 
            :recentBlogs="$recentBlogs ?? collect()" 
            :categories="$categories ?? collect()" 
            :tags="$tags ?? collect()" 
            :archives="$archives ?? collect()" 
        />
    </div>
</main>
@endsection
