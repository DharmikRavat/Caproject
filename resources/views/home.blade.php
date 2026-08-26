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
                    {{ data_get($heroBanner, 'title') ?: 'Expertise Through Experience' }}
                </h1>
                <p class="text-sm text-gray-200 mb-8 font-normal">
                    {{ data_get($heroBanner, 'subtitle') ?: 'Expert Consultancy services for direct and indirect taxes.' }}
                </p>
                <a href="{{ data_get($heroBanner, 'link') ?: route('contact') }}" class="bg-theme-green hover-bg-theme-green text-white font-bold py-2.5 px-7 rounded shadow transition inline-block text-sm">
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
                <h2 class="text-2xl font-bold text-gray-800">About Us–Chartered Accountant In Pune</h2>
                <div class="text-xs text-gray-600 leading-relaxed text-justify space-y-3">
                    @if(isset($siteSettings['about_us_text']) && strlen(strip_tags($siteSettings['about_us_text'])) > 50)
                        {!! nl2br(e($siteSettings['about_us_text'])) !!}
                    @else
                        <p>Jitesh Tellsara & Associates LLP, Chartered Accountant in Pune is a professionally managed firm catering to domestic and international clients with wide range of services in domestic and international taxation, regulatory and advisory services and cross border transaction related services. The team at JTA LLP is a Firm of CA in Vimannagar and has dedicated, experienced and expert professionals and associates like Chartered Accountants, Company Secretary and Consultants and high-end infrastructure to provide end to end services to your business.</p>
                        <p>With effort of gaining deep understanding of your business, our qualified team is committed to provide valuable, consistent and efficient services based on its in-depth knowledge and wide experience in the areas of audit, taxation, regulatory compliances and related business services. Our objective is to help our clients to focus on and achieve their business and financial goals by providing them services that is personalized and tailored to meet our client's requirements and suit their business the best.</p>
                    @endif
                </div>
                <a href="{{ route('about') }}" class="bg-theme-green hover-bg-theme-green text-white font-bold py-2 px-6 rounded shadow transition text-xs inline-block">
                    Read more
                </a>
            </div>
            <div class="lg:col-span-4">
                @php
                    $aboutImg = isset($siteSettings['about_us_image']) ? Storage::url($siteSettings['about_us_image']) : 'https://images.unsplash.com/photo-1556761175-5973dc0f32e7?auto=format&fit=crop&w=600&q=80';
                @endphp
                <img src="{{ $aboutImg }}" alt="About Us Chartered Accountant Pune" class="w-full h-64 rounded object-cover shadow">
            </div>
        </section>

        <!-- ========================================== -->
        <!-- 3. CA SERVICES WE OFFER                    -->
        <!-- ========================================== -->
        <section class="relative">
            <h2 class="text-xl font-bold text-gray-800 mb-6">CA Services We Offer</h2>
            
            <!-- Carousel Navigation Arrows -->
            <div class="carousel-arrow arrow-left"><i class="fa-solid fa-chevron-left text-xs"></i></div>
            <div class="carousel-arrow arrow-right"><i class="fa-solid fa-chevron-right text-xs"></i></div>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Srv 1: Corporate Laws -->
                <div class="border border-gray-200 rounded overflow-hidden shadow-sm text-center flex flex-col h-full bg-white pb-6 hover:shadow-md transition">
                    <img src="https://images.unsplash.com/photo-1589829085413-56de8ae18c73?auto=format&fit=crop&w=600&q=80" alt="Corporate Laws" class="w-full h-40 object-cover mb-4">
                    <div class="px-5 flex flex-col flex-grow">
                        <h3 class="font-bold text-gray-800 text-[15px] mb-2">Corporate Laws</h3>
                        <p class="text-[11px] text-gray-500 leading-relaxed mb-4 flex-grow text-center">
                            We assist businesses in maintaining full compliance with corporate regulations, offering strategic guidance on governance frameworks and statutory filings.
                        </p>
                        <a href="{{ route('services') }}?category=corporate_laws" class="navy-bg text-white text-[10px] font-bold py-2 px-6 rounded-sm mx-auto shadow hover:bg-blue-900 transition w-max">
                            Read More
                        </a>
                    </div>
                </div>

                <!-- Srv 2: Taxation Services -->
                <div class="border border-gray-200 rounded overflow-hidden shadow-sm text-center flex flex-col h-full bg-white pb-6 hover:shadow-md transition">
                    <img src="https://images.unsplash.com/photo-1554224155-6726b3ff858f?auto=format&fit=crop&w=600&q=80" alt="Taxation Services" class="w-full h-40 object-cover mb-4">
                    <div class="px-5 flex flex-col flex-grow">
                        <h3 class="font-bold text-gray-800 text-[15px] mb-2">Taxation Services</h3>
                        <p class="text-[11px] text-gray-500 leading-relaxed mb-4 flex-grow text-center">
                            Comprehensive solutions for direct and indirect tax planning, enabling optimized tax structures while strictly adhering to current legal mandates.
                        </p>
                        <a href="{{ route('services') }}?category=direct_tax" class="navy-bg text-white text-[10px] font-bold py-2 px-6 rounded-sm mx-auto shadow hover:bg-blue-900 transition w-max">
                            Read More
                        </a>
                    </div>
                </div>

                <!-- Srv 3: Business Registration -->
                <div class="border border-gray-200 rounded overflow-hidden shadow-sm text-center flex flex-col h-full bg-white pb-6 hover:shadow-md transition">
                    <img src="https://images.unsplash.com/photo-1460925895917-afdab827c52f?auto=format&fit=crop&w=600&q=80" alt="Business Registration" class="w-full h-40 object-cover mb-4">
                    <div class="px-5 flex flex-col flex-grow">
                        <h3 class="font-bold text-gray-800 text-[15px] mb-2">Business Registration</h3>
                        <p class="text-[11px] text-gray-500 leading-relaxed mb-4 flex-grow text-center">
                            End-to-end support for startup registrations, ensuring smooth entity formation and complete financial and operational compliance from day one.
                        </p>
                        <a href="{{ route('services') }}?category=business_registration" class="navy-bg text-white text-[10px] font-bold py-2 px-6 rounded-sm mx-auto shadow hover:bg-blue-900 transition w-max">
                            Read More
                        </a>
                    </div>
                </div>
            </div>
        </section>

        <!-- ========================================== -->
        <!-- 4. BUSINESS REGISTRATION SERVICES          -->
        <!-- ========================================== -->
        <section>
            <h2 class="text-xl font-bold text-gray-800 mb-6">Business Registration Services We Offer</h2>
            <div class="grid grid-cols-2 md:grid-cols-5 gap-4">
                <!-- Biz 1 -->
                <a href="{{ route('services') }}?category=business_registration" class="border rounded-lg overflow-hidden shadow-sm text-center flex flex-col hover:shadow-md transition group">
                    <div class="h-24 bg-white flex items-center justify-center p-1">
                        <img src="https://images.unsplash.com/photo-1454165804606-c3d57bc86b40?auto=format&fit=crop&w=300&q=80" alt="IEC Registration" class="h-full w-full object-cover rounded">
                    </div>
                    <div class="navy-card text-white text-[10px] font-bold py-3 px-2 flex-grow flex items-center justify-center group-hover:bg-blue-900 transition">
                        IEC Registration
                    </div>
                </a>
                <!-- Biz 2 -->
                <a href="{{ route('services') }}?category=business_registration" class="border rounded-lg overflow-hidden shadow-sm text-center flex flex-col hover:shadow-md transition group">
                    <div class="h-24 bg-white flex items-center justify-center p-1">
                        <img src="https://images.unsplash.com/photo-1556742049-0cfed4f6a45d?auto=format&fit=crop&w=300&q=80" alt="Trademark Registration" class="h-full w-full object-cover rounded">
                    </div>
                    <div class="navy-card text-white text-[10px] font-bold py-3 px-2 flex-grow flex items-center justify-center group-hover:bg-blue-900 transition">
                        Trademark Registration
                    </div>
                </a>
                <!-- Biz 3 -->
                <a href="{{ route('services') }}?category=business_registration" class="border rounded-lg overflow-hidden shadow-sm text-center flex flex-col hover:shadow-md transition group">
                    <div class="h-24 bg-white flex items-center justify-center p-1">
                        <img src="https://images.unsplash.com/photo-1628348070889-cb656235b4eb?auto=format&fit=crop&w=300&q=80" alt="GST Registration" class="h-full w-full object-cover rounded">
                    </div>
                    <div class="navy-card text-white text-[10px] font-bold py-3 px-2 flex-grow flex items-center justify-center group-hover:bg-blue-900 transition">
                        GST Registration
                    </div>
                </a>
                <!-- Biz 4 -->
                <a href="{{ route('services') }}?category=business_registration" class="border rounded-lg overflow-hidden shadow-sm text-center flex flex-col hover:shadow-md transition group">
                    <div class="h-24 bg-white flex items-center justify-center p-1">
                        <img src="https://images.unsplash.com/photo-1600880292203-757bb62b4baf?auto=format&fit=crop&w=300&q=80" alt="Udyog Aadhar Registration" class="h-full w-full object-cover rounded">
                    </div>
                    <div class="navy-card text-white text-[10px] font-bold py-3 px-2 flex-grow flex items-center justify-center group-hover:bg-blue-900 transition">
                        Udyog Aadhar Registration
                    </div>
                </a>
                <!-- Biz 5 -->
                <a href="{{ route('services') }}?category=business_registration" class="border rounded-lg overflow-hidden shadow-sm text-center flex flex-col hover:shadow-md transition group">
                    <div class="h-24 bg-white flex items-center justify-center p-1">
                        <img src="https://images.unsplash.com/photo-1554224154-26032ffc0d07?auto=format&fit=crop&w=300&q=80" alt="PF Registration" class="h-full w-full object-cover rounded">
                    </div>
                    <div class="navy-card text-white text-[10px] font-bold py-3 px-2 flex-grow flex items-center justify-center group-hover:bg-blue-900 transition">
                        PF Registration
                    </div>
                </a>
            </div>
        </section>

        <!-- ========================================== -->
        <!-- 5. COMPANY FORMATION SERVICES              -->
        <!-- ========================================== -->
        <section class="relative">
            <h2 class="text-xl font-bold text-gray-800 mb-6">Company Formation Services We Offer</h2>
            
            <!-- Carousel Navigation Arrows -->
            <div class="carousel-arrow arrow-left"><i class="fa-solid fa-chevron-left text-xs"></i></div>
            <div class="carousel-arrow arrow-right"><i class="fa-solid fa-chevron-right text-xs"></i></div>
            
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6">
                <!-- Form 1 -->
                <a href="{{ route('services') }}?category=company_formation" class="fancy-border-card text-center block">
                    <img src="https://images.unsplash.com/photo-1486406146926-c627a92ad1ab?auto=format&fit=crop&w=400&q=80" alt="Section 8 Company Registration" class="w-full h-28 mb-3">
                    <h4 class="font-bold text-[12px] text-gray-800 pb-2 px-2">Section 8 Company Registration</h4>
                </a>
                <!-- Form 2 -->
                <a href="{{ route('services') }}?category=company_formation" class="fancy-border-card text-center block">
                    <img src="https://images.unsplash.com/photo-1556761175-5973dc0f32e7?auto=format&fit=crop&w=400&q=80" alt="Sole Proprietorship Firm Registration" class="w-full h-28 mb-3">
                    <h4 class="font-bold text-[12px] text-gray-800 pb-2 px-2">Sole Proprietorship Firm Registration</h4>
                </a>
                <!-- Form 3 -->
                <a href="{{ route('services') }}?category=company_formation" class="fancy-border-card text-center block">
                    <img src="https://images.unsplash.com/photo-1497366216548-37526070297c?auto=format&fit=crop&w=400&q=80" alt="Private Limited Company" class="w-full h-28 mb-3">
                    <h4 class="font-bold text-[12px] text-gray-800 pb-2 px-2">Private Limited Company</h4>
                </a>
                <!-- Form 4 -->
                <a href="{{ route('services') }}?category=company_formation" class="fancy-border-card text-center block">
                    <img src="https://images.unsplash.com/photo-1522071820081-009f0129c71c?auto=format&fit=crop&w=400&q=80" alt="One Person Company" class="w-full h-28 mb-3">
                    <h4 class="font-bold text-[12px] text-gray-800 pb-2 px-2">One Person Company</h4>
                </a>
            </div>
        </section>

        <!-- ========================================== -->
        <!-- 6. VERTICALS WE SERVE                      -->
        <!-- ========================================== -->
        <section class="relative">
            <h2 class="text-xl font-bold text-gray-800 mb-2">Verticals We Serve-Chartered Accountant Pune</h2>
            <p class="text-[11px] text-gray-500 mb-8 max-w-4xl text-justify">
                By combining their business expertise and local knowledge, our professionals can assess reality and the relative challenges of industries and accurately filter through a dynamic process and mitigate the impact of external threats to various vertical in mitigating future risks.
            </p>
            
            <!-- Carousel Navigation Arrows -->
            <div class="carousel-arrow arrow-left"><i class="fa-solid fa-chevron-left text-xs"></i></div>
            <div class="carousel-arrow arrow-right"><i class="fa-solid fa-chevron-right text-xs"></i></div>
            
            <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                <!-- Vert 1 -->
                <a href="{{ route('industries') }}" class="fancy-border-card text-center block">
                    <img src="https://images.unsplash.com/photo-1542838132-92c53300491e?auto=format&fit=crop&w=400&q=80" alt="FMCG" class="w-full h-32 mb-3">
                    <h4 class="font-bold text-[12px] text-gray-800 pb-2">FMCG</h4>
                </a>
                <!-- Vert 2 -->
                <a href="{{ route('industries') }}" class="fancy-border-card text-center block">
                    <img src="https://images.unsplash.com/photo-1601597111158-2fceff292cdc?auto=format&fit=crop&w=400&q=80" alt="Banking & Finance" class="w-full h-32 mb-3">
                    <h4 class="font-bold text-[12px] text-gray-800 pb-2">Banking & Finance</h4>
                </a>
                <!-- Vert 3 -->
                <a href="{{ route('industries') }}" class="fancy-border-card text-center block">
                    <img src="https://images.unsplash.com/photo-1504384308090-c894fdcc538d?auto=format&fit=crop&w=400&q=80" alt="IT & IT Related Services" class="w-full h-32 mb-3">
                    <h4 class="font-bold text-[12px] text-gray-800 pb-2">IT & IT Related Services</h4>
                </a>
                <!-- Vert 4 -->
                <a href="{{ route('industries') }}" class="fancy-border-card text-center block">
                    <img src="https://images.unsplash.com/photo-1473341304170-971dccb5ac1e?auto=format&fit=crop&w=400&q=80" alt="Green Energy" class="w-full h-32 mb-3">
                    <h4 class="font-bold text-[12px] text-gray-800 pb-2">Green Energy</h4>
                </a>
            </div>
        </section>

        <!-- ========================================== -->
        <!-- 7. HAPPY CLIENTS                           -->
        <!-- ========================================== -->
        <section class="bg-gray-50 py-10 px-6 rounded relative overflow-hidden">
            <h2 class="text-xl font-bold text-gray-800 mb-6 text-center">Happy Clients</h2>
            
            <div class="text-center mb-8">
                <div class="text-lg font-bold tracking-widest text-gray-800 mb-1 uppercase">EXCELLENT</div>
                <div class="flex justify-center text-yellow-400 text-lg mb-1 gap-1">
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                </div>
                <div class="text-[10px] text-gray-500 mb-2">Based on 122 reviews</div>
                <img src="https://upload.wikimedia.org/wikipedia/commons/2/2f/Google_2015_logo.svg" alt="Google Reviews" class="h-4 mx-auto">
            </div>

            <!-- Carousel Navigation Arrows -->
            <div class="carousel-arrow arrow-left bg-white"><i class="fa-solid fa-chevron-left text-xs"></i></div>
            <div class="carousel-arrow arrow-right bg-white"><i class="fa-solid fa-chevron-right text-xs"></i></div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Review 1 -->
                <div class="bg-white p-4 rounded shadow-sm border border-gray-100 hover:shadow transition">
                    <div class="flex items-center gap-3 mb-2">
                        <div class="w-8 h-8 bg-blue-100 text-blue-900 rounded-full flex items-center justify-center font-bold text-xs">S</div>
                        <div>
                            <h4 class="text-[11px] font-bold text-gray-800">Sunil Gandhi</h4>
                            <div class="text-[9px] text-gray-400">2 months ago</div>
                        </div>
                        <img src="https://upload.wikimedia.org/wikipedia/commons/5/53/Google_%22G%22_Logo.svg" alt="Google" class="h-3.5 ml-auto opacity-80">
                    </div>
                    <div class="text-yellow-400 text-[9px] mb-2 flex gap-0.5">
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                    </div>
                    <p class="text-[10px] text-gray-500 leading-relaxed">
                        Jitesh Tellsara &amp; Associates LLP, CA in Pune are very professional. They are very supportive in their services. I highly recommend them to all my friends.
                    </p>
                </div>

                <!-- Review 2 -->
                <div class="bg-white p-4 rounded shadow-sm border border-gray-100 hover:shadow transition">
                    <div class="flex items-center gap-3 mb-2">
                        <div class="w-8 h-8 bg-green-100 text-green-900 rounded-full flex items-center justify-center font-bold text-xs">P</div>
                        <div>
                            <h4 class="text-[11px] font-bold text-gray-800">Parth Patel</h4>
                            <div class="text-[9px] text-gray-400">3 months ago</div>
                        </div>
                        <img src="https://upload.wikimedia.org/wikipedia/commons/5/53/Google_%22G%22_Logo.svg" alt="Google" class="h-3.5 ml-auto opacity-80">
                    </div>
                    <div class="text-yellow-400 text-[9px] mb-2 flex gap-0.5">
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                    </div>
                    <p class="text-[10px] text-gray-500 leading-relaxed">
                        I have engaged with them for direct &amp; indirect taxes for last 2 years. They are finding very active. They are very knowledgeable, responsive and reliable.
                    </p>
                </div>

                <!-- Review 3 -->
                <div class="bg-white p-4 rounded shadow-sm border border-gray-100 hover:shadow transition">
                    <div class="flex items-center gap-3 mb-2">
                        <div class="w-8 h-8 bg-amber-100 text-amber-900 rounded-full flex items-center justify-center font-bold text-xs">M</div>
                        <div>
                            <h4 class="text-[11px] font-bold text-gray-800">Mayank Chaudhary</h4>
                            <div class="text-[9px] text-gray-400">4 months ago</div>
                        </div>
                        <img src="https://upload.wikimedia.org/wikipedia/commons/5/53/Google_%22G%22_Logo.svg" alt="Google" class="h-3.5 ml-auto opacity-80">
                    </div>
                    <div class="text-yellow-400 text-[9px] mb-2 flex gap-0.5">
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                    </div>
                    <p class="text-[10px] text-gray-500 leading-relaxed">
                        Highly professional and responsive team. They handled my accounting needs efficiently. Would highly recommend their CA services to business owners.
                    </p>
                </div>
            </div>
        </section>

    </div>

@endsection
