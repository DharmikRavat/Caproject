@extends('layouts.app')

@section('content')

    <!-- ========================================== -->
    <!-- 1. HERO SLIDER SECTION                     -->
    <!-- ========================================== -->
    @php
        $heroBanner = $banners->first();
        $heroImagePath = data_get($heroBanner, 'image');
        $heroImage = $heroImagePath && \Illuminate\Support\Str::startsWith($heroImagePath, ['http://', 'https://'])
            ? $heroImagePath
            : ($heroImagePath ? Storage::url($heroImagePath) : 'https://images.unsplash.com/photo-1606240724602-5b21f896eae8?auto=format&fit=crop&w=1600&q=80');
    @endphp
    <section class="relative w-full h-[450px] bg-cover bg-center" style="background-image: url('{{ $heroImage }}');">
        <div class="absolute inset-0 hero-overlay"></div>
        <div class="max-w-7xl mx-auto px-6 h-full flex flex-col justify-center relative z-10">
            <div class="max-w-2xl">
                <h1 class="text-4xl md:text-5xl font-bold text-white mb-4 leading-tight uppercase tracking-wide">
                    {{ data_get($heroBanner, 'title') ?? '' }}
                </h1>
                <p class="text-sm text-gray-200 mb-8 font-normal">
                    {{ data_get($heroBanner, 'subtitle') ?? '' }}
                </p>
                <a href="{{ data_get($heroBanner, 'link') ?? route('contact') }}" class="bg-theme-green hover-bg-theme-green text-white font-bold py-2.5 px-7 rounded shadow transition inline-block text-sm">
                    {{ data_get($heroBanner, 'button_text') ?: 'Click Here' }}
                </a>
            </div>
        </div>
        <!-- Carousel Dots Indicator -->
        <div class="absolute bottom-6 left-0 right-0 flex justify-center gap-2">
            <span class="w-2 h-2 rounded-full border border-white"></span>
            <span class="w-2 h-2 rounded-full bg-white"></span>
            <span class="w-2 h-2 rounded-full border border-white"></span>
            <span class="w-2 h-2 rounded-full border border-white"></span>
        </div>
    </section>

    <!-- Main Container for Home Content -->
    <div class="max-w-7xl mx-auto px-6 py-16 space-y-16">
        
        <!-- ========================================== -->
        <!-- 2. ABOUT US SECTION                        -->
        <!-- ========================================== -->
        <section class="grid grid-cols-1 lg:grid-cols-12 gap-10 items-center">
            <div class="lg:col-span-8 space-y-6">
                <h2 class="text-2xl font-bold text-gray-800">{{ $siteSettings['about_page_title'] ?? '' }}</h2>
                <div class="text-xs text-gray-600 leading-relaxed text-justify space-y-3">
                    {!! nl2br(e($siteSettings['about_us_text'] ?? '')) !!}
                </div>
                <a href="{{ route('about') }}" class="bg-theme-green hover-bg-theme-green text-white font-bold py-2 px-6 rounded shadow transition text-xs inline-block">
                    Read more
                </a>
            </div>
            <div class="lg:col-span-4">
                @php
                    $aboutImg = isset($siteSettings['about_us_image']) && $siteSettings['about_us_image'] ? Storage::url($siteSettings['about_us_image']) : 'https://images.unsplash.com/photo-1556761175-5973dc0f32e7?auto=format&fit=crop&w=600&q=80';
                @endphp
                <img src="{{ $aboutImg }}" alt="About Us Chartered Accountant Pune" class="w-full h-64 rounded object-cover shadow">
            </div>
        </section>



    </div>

@endsection
