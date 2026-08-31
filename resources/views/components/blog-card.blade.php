@props(['blog'])

@php
    $img = data_get($blog, 'image');
    $imgSrc = $img && \Illuminate\Support\Str::startsWith($img, ['http://', 'https://']) ? $img : ($img ? Storage::url($img) : 'https://images.unsplash.com/photo-1554224155-8d04cb21cd6c?auto=format&fit=crop&w=1000&q=80');
@endphp

<article class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-xl transition-all duration-300 flex flex-col group transform hover:-translate-y-1 mb-10">
    <!-- Image Container -->
    <div class="relative h-48 sm:h-56 md:h-64 overflow-hidden bg-gray-100 w-full">
        <a href="{{ route('blog.show', $blog->slug) }}" class="block w-full h-full">
            <img src="{{ $imgSrc }}" alt="{{ $blog->title }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-500" loading="lazy">
        </a>
    </div>
    
    <!-- Content Container -->
    <div class="p-6 md:p-8 flex flex-col justify-center">
        <!-- Meta Data -->
        <div class="flex flex-wrap items-center gap-x-4 gap-y-2 text-xs font-bold uppercase tracking-wider text-gray-500 mb-4">
            <span class="flex items-center text-emerald-600">
                <i class="far fa-calendar-alt mr-1"></i> 
                {{ $blog->published_date ? \Carbon\Carbon::parse($blog->published_date)->format('F d, Y') : $blog->created_at->format('F d, Y') }}
            </span>
            <span class="text-gray-300">|</span>
            <span class="flex items-center">
                <i class="far fa-user mr-1"></i> BY {{ $blog->author ?: 'ADMIN' }}
            </span>
            @if($blog->category)
                <span class="text-gray-300">|</span>
                <a href="{{ route('blog.category', $blog->category->slug) }}" class="flex items-center hover:text-emerald-600 transition">
                    <i class="far fa-folder-open mr-1"></i> IN {{ $blog->category->name }}
                </a>
            @endif
        </div>
        
        <!-- Title -->
        <h2 class="text-2xl md:text-3xl font-bold text-gray-900 leading-snug mb-4 group-hover:text-emerald-700 transition">
            <a href="{{ route('blog.show', $blog->slug) }}">{{ $blog->title }}</a>
        </h2>
        
        <!-- Excerpt -->
        <p class="text-gray-600 mb-6 leading-relaxed">
            @if($blog->excerpt)
                {{ $blog->excerpt }}
            @else
                {{ Str::limit(strip_tags($blog->content), 250) }}
            @endif
        </p>
        
        <!-- Action Button -->
        <div class="mt-2">
            <a href="{{ route('blog.show', $blog->slug) }}" class="inline-flex items-center bg-emerald-600 text-white font-bold text-xs uppercase tracking-wider px-6 py-3 rounded shadow hover:bg-emerald-700 hover:shadow-lg transition">
                Read More <i class="fas fa-chevron-right ml-2 text-[10px]"></i>
            </a>
        </div>
    </div>
</article>
