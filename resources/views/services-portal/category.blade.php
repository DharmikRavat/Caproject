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
        @if($category->short_description)
            <p class="text-blue-100 max-w-2xl mx-auto text-lg">{{ $category->short_description }}</p>
        @endif
        
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

        @if($category->services->isEmpty())
            <div class="bg-white border border-gray-100 rounded-lg p-12 text-center shadow-sm">
                <i class="fas fa-tools text-4xl text-gray-300 mb-4"></i>
                <p class="text-slate-500 font-medium text-lg">Services coming soon.</p>
            </div>
        @else
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($category->services as $service)
                    @php
                        $serviceImage = 'https://images.unsplash.com/photo-1454165804606-c3d57bc86b40?auto=format&fit=crop&w=800&q=80'; // Fallback
                        if ($service->featured_image) {
                            $serviceImage = \Illuminate\Support\Str::startsWith($service->featured_image, ['http://', 'https://']) ? $service->featured_image : Storage::url($service->featured_image);
                        } elseif ($service->image) {
                            $serviceImage = \Illuminate\Support\Str::startsWith($service->image, ['http://', 'https://']) ? $service->image : Storage::url($service->image);
                        }
                    @endphp
                    <article class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-xl transition-all duration-300 flex flex-col h-full group transform hover:-translate-y-1">
                        <div class="relative h-48 overflow-hidden bg-gray-100">
                            <img src="{{ $serviceImage }}" alt="{{ $service->name }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-500" loading="lazy">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent opacity-60"></div>
                            @if($service->icon)
                                <div class="absolute bottom-4 left-4 bg-white p-2 rounded-lg shadow-md">
                                    <img src="{{ Storage::url($service->icon) }}" class="w-8 h-8 object-contain">
                                </div>
                            @endif
                        </div>
                        <div class="p-6 flex flex-col flex-grow relative">
                            <h3 class="text-xl font-bold text-gray-900 leading-snug mb-3 group-hover:text-blue-700 transition">
                                <a href="{{ route('services.show', [$category->slug, $service->slug]) }}" class="after:absolute after:inset-0">{{ $service->name }}</a>
                            </h3>
                            <p class="text-sm text-gray-600 mb-6 line-clamp-3 leading-relaxed">
                                {{ $service->short_description ?? Str::limit(strip_tags($service->description), 120) }}
                            </p>
                            <div class="mt-auto pt-4 border-t border-gray-50 flex items-center text-blue-700 font-bold text-xs uppercase tracking-wider group-hover:text-blue-900 transition">
                                Explore Service <i class="fas fa-arrow-right ml-2 transform group-hover:translate-x-1 transition-transform"></i>
                            </div>
                        </div>
                    </article>
                @endforeach
            </div>
        @endif
    </div>
</div>
@endsection
