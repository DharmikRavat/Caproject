@extends('layouts.app')

@section('title', $blog->meta_title ?? $blog->title)
@section('meta_description', $blog->meta_description ?? Str::limit(strip_tags($blog->content), 160))
@section('meta_keywords', $blog->meta_keywords ?? '')

@push('meta')
    <meta property="og:locale" content="en_US" />
    <meta property="og:type" content="article" />
    <meta property="og:title" content="{{ $blog->meta_title ?? $blog->title }}" />
    <meta property="og:description" content="{{ $blog->meta_description ?? Str::limit(strip_tags($blog->content), 160) }}" />
    <meta property="og:url" content="{{ url()->current() }}" />
    <meta property="og:site_name" content="{{ $siteSettings['site_name'] ?? 'CA Jitesh Telisara' }}" />
    <meta property="og:updated_time" content="{{ $blog->updated_at->toIso8601String() }}" />
    <meta property="article:published_time" content="{{ $blog->published_date ? \Carbon\Carbon::parse($blog->published_date)->toIso8601String() : $blog->created_at->toIso8601String() }}" />
    <meta property="article:modified_time" content="{{ $blog->updated_at->toIso8601String() }}" />
    
    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:title" content="{{ $blog->meta_title ?? $blog->title }}" />
    <meta name="twitter:description" content="{{ $blog->meta_description ?? Str::limit(strip_tags($blog->content), 160) }}" />
    <meta name="twitter:label1" content="Time to read" />
    <meta name="twitter:data1" content="{{ ceil(str_word_count(strip_tags($blog->content)) / 200) }} minute(s)" />

    @if($blog->og_image)
        <meta property="og:image" content="{{ Storage::url($blog->og_image) }}" />
        <meta name="twitter:image" content="{{ Storage::url($blog->og_image) }}" />
    @elseif($blog->image)
        <meta property="og:image" content="{{ Storage::url($blog->image) }}" />
        <meta name="twitter:image" content="{{ Storage::url($blog->image) }}" />
    @endif

    <script type="application/ld+json" class="rank-math-schema">
    {
      "@context": "https://schema.org",
      "@graph": [
        {
          "@type": "Article",
          "headline": "{{ $blog->meta_title ?? $blog->title }}",
          "keywords": "{{ $blog->meta_keywords ?? '' }}",
          "datePublished": "{{ $blog->published_date ? \Carbon\Carbon::parse($blog->published_date)->toIso8601String() : $blog->created_at->toIso8601String() }}",
          "dateModified": "{{ $blog->updated_at->toIso8601String() }}",
          "author": {
            "@type": "Person",
            "name": "{{ $blog->author ?? 'admin' }}"
          },
          "description": "{{ $blog->meta_description ?? Str::limit(strip_tags($blog->content), 160) }}",
          "name": "{{ $blog->meta_title ?? $blog->title }}",
          "url": "{{ url()->current() }}"
          @if($blog->og_image || $blog->image)
          ,"image": "{{ Storage::url($blog->og_image ?? $blog->image) }}"
          @endif
        }
      ]
    }
    </script>
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
