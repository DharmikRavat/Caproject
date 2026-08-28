@extends('layouts.app')

@section('content')
<main class="mx-auto max-w-4xl px-5 py-14 lg:px-10">
    <a href="{{ route('blogs') }}" class="inline-flex items-center gap-2 text-sm font-bold text-blue-900 hover:text-emerald-600"><i class="fas fa-arrow-left text-xs"></i> Back to blogs</a>
    @if($blog->image)<img src="{{ \Illuminate\Support\Str::startsWith($blog->image, ['http://', 'https://']) ? $blog->image : Storage::url($blog->image) }}" alt="{{ $blog->title }}" class="mt-8 h-72 w-full object-cover md:h-96">@endif
    <p class="mt-8 text-sm font-bold uppercase tracking-[.18em] text-emerald-600">{{ $blog->author ?: 'Team' }}</p>
    <h1 class="mt-3 text-4xl font-bold leading-tight text-slate-900 md:text-5xl">{{ $blog->title }}</h1>
    <div class="mt-4 flex flex-wrap items-center gap-x-4 gap-y-2 text-sm text-slate-500">
        <p>Published {{ $blog->created_at->format('d M Y') }}</p>
        @if($blog->category)
            <span class="text-slate-300">|</span>
            <a href="{{ route('blogs', ['category' => $blog->category->slug]) }}" class="text-emerald-600 hover:underline">{{ $blog->category->name }}</a>
        @endif
    </div>
    @if($blog->tags->count() > 0)
        <div class="mt-4 flex flex-wrap gap-2">
            @foreach($blog->tags as $tag)
                <a href="{{ route('blogs', ['tag' => $tag->slug]) }}" class="bg-emerald-50 px-2.5 py-1 text-xs font-semibold text-emerald-700 hover:bg-emerald-100">{{ $tag->name }}</a>
            @endforeach
        </div>
    @endif
    <div class="mt-10 whitespace-pre-line text-base leading-8 text-slate-600">{{ $blog->content }}</div>
</main>
@endsection
