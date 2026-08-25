@extends('layouts.app')

@section('content')
<main class="mx-auto max-w-4xl px-5 py-14 lg:px-10">
    <a href="{{ route('blogs') }}" class="inline-flex items-center gap-2 text-sm font-bold text-blue-900 hover:text-emerald-600"><i class="fas fa-arrow-left text-xs"></i> Back to blogs</a>
    @if($blog->image)<img src="{{ \Illuminate\Support\Str::startsWith($blog->image, ['http://', 'https://']) ? $blog->image : Storage::url($blog->image) }}" alt="{{ $blog->title }}" class="mt-8 h-72 w-full object-cover md:h-96">@endif
    <p class="mt-8 text-sm font-bold uppercase tracking-[.18em] text-emerald-600">{{ $blog->author ?: 'Team' }}</p>
    <h1 class="mt-3 text-4xl font-bold leading-tight text-slate-900 md:text-5xl">{{ $blog->title }}</h1>
    <p class="mt-4 text-sm text-slate-500">Published {{ $blog->created_at->format('d M Y') }}</p>
    <div class="mt-10 whitespace-pre-line text-base leading-8 text-slate-600">{{ $blog->content }}</div>
</main>
@endsection
