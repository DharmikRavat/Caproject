@extends('layouts.app')

@section('content')
@php
    $bgImage = 'https://images.unsplash.com/photo-1556761175-5973dc0f32e7?auto=format&fit=crop&w=1600&q=80'; // Default placeholder

    if ($category->header_image) {
        $bgImage = \Illuminate\Support\Str::startsWith($category->header_image, ['http://', 'https://']) ? $category->header_image : Storage::url($category->header_image);
    } elseif ($category->image) {
        $bgImage = \Illuminate\Support\Str::startsWith($category->image, ['http://', 'https://']) ? $category->image : Storage::url($category->image);
    }
@endphp

<div class="py-24 text-white text-center relative overflow-hidden bg-cover bg-center shadow-inner" style="background-image: url('{{ $bgImage }}');">
    <!-- Dark overlay to ensure text readability but keep image visible -->
    <div class="absolute inset-0 bg-black bg-opacity-60"></div>
    <div class="relative z-10 max-w-7xl mx-auto px-6">
        <h1 class="text-5xl font-extrabold uppercase tracking-tight mb-4 drop-shadow-lg">{{ $category->name }}</h1>

        
        <div class="flex items-center justify-center space-x-2 text-sm mt-8 font-semibold text-blue-200">
            <a href="{{ route('home') }}" class="hover:text-white transition">Home</a>
            <i class="fas fa-chevron-right text-xs"></i>
            <a href="{{ route('services.index') }}" class="hover:text-white transition">Services</a>
            <i class="fas fa-chevron-right text-xs"></i>
            <span class="text-theme-green">{{ $category->name }}</span>
        </div>
    </div>
</div>

<div class="bg-gray-50 py-16">
    <div class="max-w-7xl mx-auto px-6">
        @if($category->description)
            <div class="bg-white p-8 rounded-xl shadow-sm border border-gray-100 mb-12 prose max-w-none text-gray-600">
                {!! $category->description !!}
            </div>
        @endif


    </div>
</div>
@endsection
