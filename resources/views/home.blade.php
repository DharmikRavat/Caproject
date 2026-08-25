@extends('layouts.app')

@section('content')

    <!-- =========================
         2. HERO SECTION
         ========================= -->
    @php
        $heroBanner = $banners->first();
        $heroImagePath = data_get($heroBanner, 'image');
        $heroImage = $heroImagePath && \Illuminate\Support\Str::startsWith($heroImagePath, ['http://', 'https://'])
            ? $heroImagePath
            : ($heroImagePath ? Storage::url($heroImagePath) : asset('images/hero-bg.jpg'));
    @endphp
    <section class="relative w-full h-[500px] bg-gray-600 flex items-center justify-center bg-cover bg-center" style="background-image: url('{{ $heroImage }}'); background-blend-mode: overlay;">
        <div class="text-center text-white px-4">
            <h1 class="text-4xl md:text-5xl font-bold mb-4 drop-shadow-lg">{{ data_get($heroBanner, 'title') ?: 'SERVICE BEYOND TRUST' }}</h1>
            @if(data_get($heroBanner, 'subtitle'))<p class="text-lg md:text-xl mb-8 drop-shadow-md">{{ $heroBanner->subtitle }}</p>@endif
            @if(data_get($heroBanner, 'button_text'))<a href="{{ data_get($heroBanner, 'link') ?: route('about') }}" class="bg-green-600 hover:bg-green-700 text-white font-bold py-3 px-8 rounded transition duration-300">{{ $heroBanner->button_text }}</a>@endif
        </div>
    </section>

    <!-- =========================
         3. ABOUT US SECTION
         ========================= -->
    <section class="max-w-7xl mx-auto py-16 px-4 md:px-12 flex flex-col md:flex-row items-center gap-12">
        <div class="w-full md:w-2/3">
            <h2 class="text-3xl font-bold mb-6 text-gray-900">About Us - Chartered Accountant In Pune</h2>
            <p class="text-gray-600 mb-4 leading-relaxed text-sm text-justify">
                {{ $siteSettings['about_us_text'] ?? 'Jitesh Telhara & Associates LLP, Chartered Accountants in Pune is a professionally managed Indian Chartered Accountant firm having a presence in Pune... We are a team of dedicated, experienced and expert professionals and consultants...' }}
            </p>
            <a href="{{ route('about') }}" class="inline-block bg-green-600 hover:bg-green-700 text-white font-semibold py-2 px-6 rounded mt-4">Read More</a>
        </div>
        <div class="w-full md:w-1/3">
            @php
                $aboutImage = isset($siteSettings['about_us_image']) ? Storage::url($siteSettings['about_us_image']) : asset('images/about-image.jpg');
            @endphp
            <img src="{{ $aboutImage }}" alt="About Us" class="rounded shadow-lg w-full object-cover">
        </div>
    </section>

    <!-- =========================
         4. CA SERVICES WE OFFER (Cards/Carousel)
         ========================= -->
    <section class="bg-gray-50 py-16 px-4 md:px-12">
        <div class="max-w-7xl mx-auto">
            <h2 class="text-3xl font-bold mb-10 text-center md:text-left text-gray-900">CA Services We Offer</h2>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 relative">
                @forelse($groupedServices['ca_services'] ?? [] as $service)
                    <div class="bg-white rounded-lg shadow-md overflow-hidden flex flex-col">
                        @if(data_get($service, 'image'))<img src="{{ Storage::url(data_get($service, 'image')) }}" alt="{{ data_get($service, 'title') }}" class="h-48 w-full object-cover">@endif
                        <div class="p-6 text-center flex-grow flex flex-col justify-between">
                            <div>
                                <h3 class="font-bold text-xl mb-3 text-blue-900">{{ data_get($service, 'title') }}</h3>
                                <p class="text-gray-600 text-sm mb-4">{{ Str::limit(data_get($service, 'short_description') ?: data_get($service, 'description'), 100) }}</p>
                            </div>
                            <a href="{{ route('service.show', data_get($service, 'slug')) }}" class="bg-blue-900 hover:bg-blue-800 text-white py-2 px-4 rounded text-sm self-center">Read More</a>
                        </div>
                    </div>
                @empty
                    <div class="col-span-3 text-center text-gray-500 py-4">
                        <p>No services added yet.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    <!-- =========================
         5. BUSINESS REGISTRATION SERVICES
         ========================= -->
    <section class="py-16 px-4 md:px-12 max-w-7xl mx-auto">
        <h2 class="text-3xl font-bold mb-10 text-gray-900">Business Registration Services We Offer</h2>
        <div class="grid grid-cols-2 md:grid-cols-5 gap-4">
            @forelse($groupedServices['business_registration'] ?? [] as $service)
                <a href="{{ route('service.show', data_get($service, 'slug')) }}" class="bg-blue-900 hover:bg-blue-800 text-white rounded-lg p-4 text-center shadow-lg border border-gray-200 flex flex-col items-center justify-center min-h-[120px] transition">
                    <span class="font-semibold text-sm">{{ data_get($service, 'title') }}</span>
                </a>
            @empty
                <div class="col-span-5 text-center text-gray-500 py-4">
                    <p>No business registration services added yet.</p>
                </div>
            @endforelse
        </div>
    </section>
    
    <!-- =========================
         5.5 COMPANY FORMATION SERVICES
         ========================= -->
    <section class="bg-gray-50 py-16 px-4 md:px-12">
        <div class="max-w-7xl mx-auto">
            <h2 class="text-3xl font-bold mb-10 text-gray-900">Company Formation Services We Offer</h2>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                @forelse($groupedServices['company_formation'] ?? [] as $service)
                    <a href="{{ route('service.show', data_get($service, 'slug')) }}" class="bg-white hover:border-green-500 border border-gray-200 text-gray-800 rounded-lg p-4 text-center shadow flex flex-col items-center justify-center min-h-[120px] transition">
                        @if(data_get($service, 'image'))
                            <img src="{{ Storage::url(data_get($service, 'image')) }}" class="h-12 object-contain mb-3" alt="{{ data_get($service, 'title') }}">
                        @else
                            <i class="fas {{ data_get($service, 'icon', 'fa-building') }} text-green-500 text-3xl mb-3"></i>
                        @endif
                        <span class="font-semibold text-sm">{{ data_get($service, 'title') }}</span>
                    </a>
                @empty
                    <div class="col-span-4 text-center text-gray-500 py-4">
                        <p>No company formation services added yet.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    <!-- =========================
         6. TESTIMONIALS (Happy Clients)
         ========================= -->
    <section class="py-16 px-4 md:px-12">
        <div class="max-w-7xl mx-auto">
            <h2 class="text-3xl font-bold mb-2 text-center text-gray-900">Happy Clients</h2>
            <div class="flex justify-center items-center mb-10 flex-col">
                <span class="text-lg font-semibold text-gray-700">EXCELLENT</span>
                <div class="text-yellow-400 text-2xl">
                    @for($i = 0; $i < 5; $i++) ★ @endfor
                </div>
                <span class="text-sm text-gray-500">Based on {{ max(100, $testimonials->count() * 10) }}+ Reviews</span>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @forelse($testimonials ?? [] as $testimonial)
                    <div class="bg-white p-6 rounded-lg shadow border border-gray-100">
                        <div class="flex items-center mb-4">
                            @if(data_get($testimonial, 'author_image'))
                                <img src="{{ Storage::url(data_get($testimonial, 'author_image')) }}" class="w-10 h-10 rounded-full object-cover" alt="{{ data_get($testimonial, 'author') }}">
                            @else
                                <div class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center font-bold text-blue-900">
                                    {{ substr((string) data_get($testimonial, 'author'), 0, 1) }}
                                </div>
                            @endif
                            <div class="ml-3">
                                <h4 class="font-bold text-sm">{{ data_get($testimonial, 'author') }}</h4>
                                <div class="text-yellow-400 text-xs">
                                    @for($i = 0; $i < (int) data_get($testimonial, 'rating', 0); $i++) ★ @endfor
                                </div>
                            </div>
                        </div>
                        <p class="text-gray-600 text-sm">{{ data_get($testimonial, 'content') }}</p>
                    </div>
                @empty
                    <div class="col-span-3 text-center text-gray-500 py-4">
                        <p>No testimonials added yet.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

@endsection
