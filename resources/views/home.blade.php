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
        <section class="mt-16 overflow-hidden reveal-on-scroll">
            <div class="text-center mb-10">
                <h2 class="text-3xl font-bold text-blue-900 uppercase tracking-wide">Our Services</h2>
                <div class="w-16 h-1 bg-theme-green mx-auto mt-3"></div>
            </div>
            
            <style>
                .hide-scroll-bar { -ms-overflow-style: none; scrollbar-width: none; }
                .hide-scroll-bar::-webkit-scrollbar { display: none; }
            </style>
            
            <div class="relative group">
                <!-- Left Arrow -->
                <button class="absolute -left-5 top-1/2 -translate-y-1/2 z-10 w-10 h-10 bg-white rounded-full shadow-md text-theme-green hover:bg-theme-green hover:text-white transition flex items-center justify-center opacity-0 group-hover:opacity-100 hidden md:flex" id="prevBtn-servicesCarousel" aria-label="Previous">
                    <i class="fas fa-chevron-left"></i>
                </button>

                <div id="servicesCarousel" class="flex overflow-x-auto snap-x snap-mandatory gap-6 pb-8 hide-scroll-bar pt-4 px-2">
                    <!-- Original Set -->
                @foreach($serviceCategories as $cat)
                    <div class="service-card snap-start shrink-0 w-full md:w-[calc(50%-12px)] lg:w-[calc(33.333%-16px)] bg-white rounded-lg shadow-md border border-gray-100 hover:-translate-y-2 transition duration-300 flex flex-col h-full group overflow-hidden">
                        @if($cat->image)
                            <div class="w-full h-48 overflow-hidden relative">
                                <img src="{{ \Illuminate\Support\Str::startsWith($cat->image, ['http://', 'https://']) ? $cat->image : Storage::url($cat->image) }}" class="w-full h-full object-cover group-hover:scale-110 transition duration-500" alt="{{ $cat->name }}">
                                <div class="absolute inset-0 bg-black bg-opacity-10 group-hover:bg-opacity-0 transition"></div>
                            </div>
                        @elseif($cat->icon)
                            <div class="w-full h-48 bg-blue-50 flex items-center justify-center text-theme-green text-5xl group-hover:bg-theme-green group-hover:text-white transition duration-500">
                                <i class="{{ $cat->icon }}"></i>
                            </div>
                        @else
                            <div class="w-full h-48 bg-blue-50 flex items-center justify-center text-theme-green text-4xl group-hover:bg-theme-green group-hover:text-white transition duration-500">
                                <i class="fas fa-briefcase"></i>
                            </div>
                        @endif
                        
                        <div class="p-8 flex flex-col items-center text-center flex-grow">
                            <h3 class="text-xl font-bold text-blue-900 mb-3">{{ $cat->name }}</h3>
                            <p class="text-sm text-gray-500 mb-6 flex-grow">{{ Str::limit($cat->short_description ?? strip_tags($cat->description), 120) }}</p>
                            
                            <a href="{{ route('services.category', $cat->slug) }}" class="mt-auto block bg-blue-900 text-white font-bold py-2.5 px-6 rounded-full hover:bg-theme-green transition text-sm">
                                Read More
                            </a>
                        </div>
                    </div>
                @endforeach
                
                <!-- Duplicated Set for Seamless Infinite Scroll -->
                @foreach($serviceCategories as $cat)
                    <div class="service-card snap-start shrink-0 w-full md:w-[calc(50%-12px)] lg:w-[calc(33.333%-16px)] bg-white rounded-lg shadow-md border border-gray-100 hover:-translate-y-2 transition duration-300 flex flex-col h-full group overflow-hidden" aria-hidden="true">
                        @if($cat->image)
                            <div class="w-full h-48 overflow-hidden relative">
                                <img src="{{ \Illuminate\Support\Str::startsWith($cat->image, ['http://', 'https://']) ? $cat->image : Storage::url($cat->image) }}" class="w-full h-full object-cover group-hover:scale-110 transition duration-500" alt="{{ $cat->name }}">
                                <div class="absolute inset-0 bg-black bg-opacity-10 group-hover:bg-opacity-0 transition"></div>
                            </div>
                        @else
                            <div class="w-full h-48 bg-blue-50 flex items-center justify-center text-theme-green text-4xl group-hover:bg-theme-green group-hover:text-white transition duration-500">
                                <i class="fas fa-briefcase"></i>
                            </div>
                        @endif
                        
                        <div class="p-8 flex flex-col items-center text-center flex-grow">
                            <h3 class="text-xl font-bold text-blue-900 mb-3">{{ $cat->name }}</h3>
                            <p class="text-sm text-gray-500 mb-6 flex-grow">{{ Str::limit($cat->short_description ?? strip_tags($cat->description), 120) }}</p>
                            
                            <a href="{{ route('services.category', $cat->slug) }}" class="mt-auto block bg-blue-900 text-white font-bold py-2.5 px-6 rounded-full hover:bg-theme-green transition text-sm" tabindex="-1">
                                Read More
                            </a>
                        </div>
                    </div>
                @endforeach
                </div>

                <!-- Right Arrow -->
                <button class="absolute -right-5 top-1/2 -translate-y-1/2 z-10 w-10 h-10 bg-white rounded-full shadow-md text-theme-green hover:bg-theme-green hover:text-white transition flex items-center justify-center opacity-0 group-hover:opacity-100 hidden md:flex" id="nextBtn-servicesCarousel" aria-label="Next">
                    <i class="fas fa-chevron-right"></i>
                </button>
            </div>
        </section>
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
            const carousel = document.getElementById('servicesCarousel');
            let slideTimer;
            const totalOriginalItems = {{ $serviceCategories->count() }};
            
            function startAutoScroll() {
                slideTimer = setInterval(function() {
                    scrollNext();
                }, 3000); // Scroll exactly 1 box every 3 seconds
            }

            function scrollNext() {
                const cards = carousel.querySelectorAll('.service-card');
                if (cards.length === 0) return;
                
                // Card width + gap (24px)
                const cardWidth = cards[0].offsetWidth + 24;
                const maxScroll = cardWidth * totalOriginalItems;
                
                // Smoothly scroll one box
                carousel.scrollBy({ left: cardWidth, behavior: 'smooth' });
                
                // Wait for the smooth scroll animation to finish (about 600ms)
                setTimeout(() => {
                    // If we have scrolled completely through the original set, jump back to start instantly
                    // The user won't notice because the duplicated set looks identical
                    if (carousel.scrollLeft >= maxScroll - 10) {
                        carousel.scrollTo({ left: carousel.scrollLeft - maxScroll, behavior: 'instant' });
                    }
                }, 600);
            }

            function scrollPrev() {
                const cards = carousel.querySelectorAll('.service-card');
                if (cards.length === 0) return;
                
                const cardWidth = cards[0].offsetWidth + 24;
                carousel.scrollBy({ left: -cardWidth, behavior: 'smooth' });
            }

            if (carousel.scrollWidth > carousel.clientWidth) {
                startAutoScroll();

                carousel.addEventListener('mouseenter', () => clearInterval(slideTimer));
                carousel.addEventListener('mouseleave', () => startAutoScroll());
                carousel.addEventListener('touchstart', () => clearInterval(slideTimer));
                carousel.addEventListener('touchend', () => startAutoScroll());

                const prevBtn = document.getElementById('prevBtn-servicesCarousel');
                const nextBtn = document.getElementById('nextBtn-servicesCarousel');
                
                if (prevBtn) {
                    prevBtn.addEventListener('click', () => {
                        clearInterval(slideTimer);
                        scrollPrev();
                        startAutoScroll();
                    });
                    prevBtn.addEventListener('mouseenter', () => clearInterval(slideTimer));
                }
                
                if (nextBtn) {
                    nextBtn.addEventListener('click', () => {
                        clearInterval(slideTimer);
                        scrollNext();
                        startAutoScroll();
                    });
                    nextBtn.addEventListener('mouseenter', () => clearInterval(slideTimer));
                }
            } else {
                const prevBtn = document.getElementById('prevBtn-servicesCarousel');
                const nextBtn = document.getElementById('nextBtn-servicesCarousel');
                if(prevBtn) prevBtn.style.display = 'none';
                if(nextBtn) nextBtn.style.display = 'none';
            }

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
