@extends('layouts.app')

@section('content')

    <!-- ========================================== -->
    <!-- 1. HERO SLIDER SECTION                     -->
    <!-- ========================================== -->
    <section x-data="{ 
        activeSlide: 0, 
        slides: {{ $banners->count() }},
        init() {
            if(this.slides > 1) {
                setInterval(() => {
                    this.activeSlide = this.activeSlide === this.slides - 1 ? 0 : this.activeSlide + 1;
                }, 5000);
            }
        }
    }" class="relative w-full h-[550px] md:h-[650px] overflow-hidden">
        
        @foreach($banners as $index => $banner)
            @php
                $heroImagePath = data_get($banner, 'image');
                $heroImage = $heroImagePath && \Illuminate\Support\Str::startsWith($heroImagePath, ['http://', 'https://'])
                    ? $heroImagePath
                    : ($heroImagePath ? Storage::url($heroImagePath) : 'https://images.unsplash.com/photo-1606240724602-5b21f896eae8?auto=format&fit=crop&w=1600&q=80');
            @endphp
            <div x-show="activeSlide === {{ $index }}" 
                 x-transition:enter="transition ease-out duration-1000"
                 x-transition:enter-start="opacity-0 scale-105"
                 x-transition:enter-end="opacity-100 scale-100"
                 x-transition:leave="transition ease-in duration-1000"
                 x-transition:leave-start="opacity-100"
                 x-transition:leave-end="opacity-0"
                 class="absolute inset-0 w-full h-full bg-cover bg-center" 
                 style="background-image: url('{{ $heroImage }}');"
                 x-cloak>
                
                <div class="absolute inset-0 hero-overlay"></div>
                <div class="max-w-7xl mx-auto px-6 h-full flex flex-col justify-center relative z-10">
                    <div class="max-w-2xl">
                        <h1 class="text-4xl md:text-5xl font-bold text-white mb-4 leading-tight uppercase tracking-wide">
                            {{ data_get($banner, 'title') ?? '' }}
                        </h1>
                        <p class="text-sm text-gray-200 mb-8 font-normal">
                            {{ data_get($banner, 'subtitle') ?? '' }}
                        </p>
                        <a href="{{ data_get($banner, 'link') ?? route('contact') }}" class="bg-theme-green hover-bg-theme-green text-white font-bold py-2.5 px-7 rounded shadow transition inline-block text-sm">
                            {{ data_get($banner, 'button_text') ?: 'Click Here' }}
                        </a>
                    </div>
                </div>
            </div>
        @endforeach

        @if($banners->count() > 1)
            <!-- Carousel Dots Indicator -->
            <div class="absolute bottom-6 left-0 right-0 flex justify-center gap-2 z-20">
                @foreach($banners as $index => $banner)
                    <button @click="activeSlide = {{ $index }}" 
                            class="w-2.5 h-2.5 rounded-full transition-all duration-300"
                            :class="activeSlide === {{ $index }} ? 'bg-white scale-125' : 'border border-white bg-transparent hover:bg-white/50'"
                            aria-label="Go to slide {{ $index + 1 }}">
                    </button>
                @endforeach
            </div>
        @endif
    </section>

    <style>
        .reveal-on-scroll {
            opacity: 0;
            transform: translateY(40px);
            transition: all 0.8s ease-out;
        }
        .reveal-on-scroll.is-visible {
            opacity: 1;
            transform: translateY(0);
        }
    </style>

    <!-- Main Container for Home Content -->
    <div class="max-w-7xl mx-auto px-6 py-16 space-y-16">
        
        <!-- ========================================== -->
        <!-- 2. ABOUT US SECTION                        -->
        <!-- ========================================== -->
        <section class="grid grid-cols-1 lg:grid-cols-12 gap-10 items-center reveal-on-scroll">
            <div class="lg:col-span-8 space-y-6">
                <h2 class="text-3xl font-bold text-gray-800">{{ $siteSettings['about_page_title'] ?? '' }}</h2>
                <div class="text-base text-gray-600 leading-relaxed text-justify space-y-3">
                    {!! nl2br(e($siteSettings['about_us_text'] ?? '')) !!}
                </div>
                <a href="{{ route('about') }}" class="bg-theme-green hover-bg-theme-green text-white font-bold py-2.5 px-7 rounded shadow transition text-sm inline-block">
                    Read more
                </a>
            </div>
            <div class="lg:col-span-4">
                @php
                    $aboutImg = isset($siteSettings['about_us_image']) && $siteSettings['about_us_image'] ? Storage::url($siteSettings['about_us_image']) : 'https://images.unsplash.com/photo-1556761175-5973dc0f32e7?auto=format&fit=crop&w=600&q=80';
                @endphp
                <img src="{{ $aboutImg }}" alt="About Us Chartered Accountant Pune" class="w-full h-64 rounded object-cover shadow hover:scale-105 transition duration-500">
            </div>
        </section>


        <!-- ========================================== -->
        <!-- 3. OUR SERVICES SECTION                    -->
        <!-- ========================================== -->
        @include('components.frontend.our-services')
    </div>

    <!-- ========================================== -->
    <!-- 3.1 BUSINESS REGISTRATION SERVICES         -->
    <!-- ========================================== -->
    @include('components.frontend.service-carousel', [
        'title' => 'Business Registration Services We Offer',
        'items' => $businessRegistrationServices,
        'categorySlug' => 'business-registration',
        'carouselId' => 'businessServicesCarousel',
        'theme' => 'dark'
    ])

    <!-- ========================================== -->
    <!-- 3.2 COMPANY FORMATION SERVICES             -->
    <!-- ========================================== -->
    @include('components.frontend.service-carousel', [
        'title' => 'Company Formation Services We Offer',
        'items' => $companyFormationServices,
        'categorySlug' => 'company-formation',
        'carouselId' => 'companyFormationCarousel',
        'theme' => 'light'
    ])

    <!-- ========================================== -->
    <!-- 3.3 VERTICALS WE SERVE                     -->
    <!-- ========================================== -->
    @include('components.frontend.service-carousel', [
        'title' => 'Verticals We Serve - Chartered Accountant Pune',
        'description' => 'As a leading Chartered Accountant (CA) firm in Pune, we pride ourselves on our ability to cater to a wide range of industries, understanding their unique dynamics and challenges. Our expertise extends across various verticals, including but not limited to:',
        'items' => $industries,
        'carouselId' => 'verticalsCarousel',
        'theme' => 'light',
        'align' => 'left'
    ])

    <!-- ========================================== -->
    <!-- 3.4 HAPPY CLIENTS (TESTIMONIALS)           -->
    <!-- ========================================== -->
    @include('components.frontend.testimonial-carousel', [
        'items' => $testimonials,
        'averageRating' => $averageRating,
        'totalReviews' => $totalReviews
    ])

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Scroll Reveal Animation Observer
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('is-visible');
                        observer.unobserve(entry.target);
                    }
                });
            }, { threshold: 0.15 });

            document.querySelectorAll('.reveal-on-scroll').forEach((el) => {
                observer.observe(el);
            });
        });
    </script>
@endsection
