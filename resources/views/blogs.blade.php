@extends('layouts.app')

@section('content')
@php
    $featuredBlog = $blogs->first();
    $blogImage = function ($blog) {
        $image = data_get($blog, 'image');
        return $image && \Illuminate\Support\Str::startsWith($image, ['http://', 'https://'])
            ? $image
            : ($image ? Storage::url($image) : 'https://images.unsplash.com/photo-1554224155-8d04cb21cd6c?auto=format&fit=crop&w=1000&q=80');
    };
@endphp

<section class="relative overflow-hidden bg-slate-800 bg-cover bg-center px-5 py-14 lg:px-10" style="background-image: linear-gradient(rgba(13,35,58,.78), rgba(13,35,58,.78)), url('https://images.unsplash.com/photo-1499951360447-b19be8fe80f5?auto=format&fit=crop&w=1600&q=80');">
    <div class="mx-auto max-w-7xl">
        <p class="mb-3 text-sm text-slate-300"><a href="{{ route('home') }}" class="hover:text-white">Home</a> <span class="mx-2 text-emerald-400">/</span> Blogs</p>
        <h1 class="text-4xl font-bold tracking-tight text-white md:text-5xl">Blogs</h1>
    </div>
</section>

<main class="mx-auto max-w-7xl px-5 py-14 lg:px-10">
    <div class="grid gap-12 lg:grid-cols-[1fr_280px]">
        <section>
                <div class="mb-7 flex items-end justify-between border-b border-slate-200 pb-4"><div><p class="mb-2 text-xs font-bold uppercase tracking-[.18em] text-emerald-600">From our desk</p><h2 class="text-3xl font-bold text-slate-900">Latest Blogs</h2></div></div>
            <div class="space-y-12">
                @forelse($blogs as $blog)
                    <article class="border-b border-slate-200 pb-10">
                        <img src="{{ $blogImage($blog) }}" alt="{{ $blog->title }}" class="max-h-96 w-full object-cover" loading="lazy">
                        <div class="mt-4 flex flex-wrap items-center gap-x-5 gap-y-2 text-xs font-semibold uppercase text-slate-500"><span><i class="far fa-user mr-1 text-emerald-600"></i>{{ $blog->author ?: 'Team' }}</span><span><i class="far fa-calendar mr-1 text-emerald-600"></i>{{ $blog->created_at->format('d M Y') }}</span>@if($blog->category)<span class="text-emerald-600">{{ $blog->category->name }}</span>@endif</div>
                        <h2 class="mt-3 text-2xl font-bold uppercase leading-snug text-slate-900">{{ $blog->title }}</h2><p class="mt-3 text-sm leading-7 text-slate-600">{{ Str::limit($blog->excerpt ?? $blog->content, 260) }}</p><a href="{{ route('blog.show', $blog->slug) }}" class="mt-5 inline-flex items-center gap-2 bg-emerald-600 px-5 py-2.5 text-xs font-bold text-white transition hover:bg-emerald-700">Read More <i class="fas fa-arrow-right"></i></a>
                    </article>
                @empty
                    <p class="text-slate-600">More insights will be published soon.</p>
                @endforelse
            </div>
            @if($blogs->hasPages())<div class="mt-8">{{ $blogs->links() }}</div>@endif
        </section>
        <aside>
            <div class="space-y-10">
                <div><h2 class="border-b border-slate-200 pb-3 text-sm font-bold uppercase tracking-wider text-slate-900">Search</h2><form action="{{ route('blogs') }}" method="GET" class="relative mt-4"><input type="search" name="search" value="{{ request('search') }}" placeholder="Search..." class="w-full border border-slate-200 p-3 pr-10 text-sm focus:border-emerald-500 focus:outline-none"><button type="submit" aria-label="Search blogs" class="absolute right-3 top-3 text-slate-400 hover:text-emerald-600"><i class="fas fa-search"></i></button></form></div>
                <div><h2 class="border-b border-slate-200 pb-3 text-sm font-bold uppercase tracking-wider text-slate-900">Recent Posts</h2><div class="mt-4 space-y-4">@foreach($recentBlogs as $recent)<a href="{{ route('blog.show', $recent->slug) }}" class="group flex gap-3"><img src="{{ $blogImage($recent) }}" alt="" class="h-12 w-16 object-cover"><span><strong class="block text-xs leading-5 text-slate-700 group-hover:text-emerald-600">{{ Str::limit($recent->title, 38) }}</strong><small class="text-[10px] text-slate-400">{{ $recent->created_at->format('d M Y') }}</small></span></a>@endforeach</div></div>
                <div><h2 class="border-b border-slate-200 pb-3 text-sm font-bold uppercase tracking-wider text-slate-900">Categories</h2><ul class="mt-4 space-y-3 text-sm text-slate-600">@forelse($categories as $category)<li class="flex justify-between border-b border-slate-100 pb-2"><a href="{{ route('blogs', ['category' => $category->slug]) }}" class="hover:text-emerald-600 transition">{{ $category->name }}</a></li>@empty<li>No categories yet.</li>@endforelse</ul></div>
                <div><h2 class="border-b border-slate-200 pb-3 text-sm font-bold uppercase tracking-wider text-slate-900">Tag Cloud</h2><div class="mt-4 flex flex-wrap gap-2">@forelse($tags as $tag)<a href="{{ route('blogs', ['tag' => $tag->slug]) }}" class="bg-emerald-600 px-3 py-1.5 text-[10px] font-bold uppercase text-white hover:bg-emerald-700">{{ $tag->name }}</a>@empty<span class="text-sm text-slate-500">No tags yet.</span>@endforelse</div></div>
                <div><h2 class="border-b border-slate-200 pb-3 text-sm font-bold uppercase tracking-wider text-slate-900">Archives</h2><ul class="mt-4 space-y-3 text-sm text-slate-600">@forelse($archives as $archive)<li class="flex justify-between border-b border-slate-100 pb-2"><a href="{{ route('blogs', ['month' => $archive->month]) }}" class="hover:text-emerald-600 transition">{{ \Carbon\Carbon::createFromFormat('Y-m', $archive->month)->format('F Y') }}</a></li>@empty<li>No archives yet.</li>@endforelse</ul></div>
            </div>
        </aside>
    </div>
</main>
@endsection
