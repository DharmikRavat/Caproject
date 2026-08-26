<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Home - Jitesh Tellsara & Associates LLP</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <style>
        .navy-bg { background-color: #1a3251; }
        .navy-card { background-color: #1f375d; }
        .text-theme-green { color: #22c55e; }
        .bg-theme-green { background-color: #22c55e; }
        .hover-bg-theme-green:hover { background-color: #16a34a; }
        
        .hero-overlay { background: linear-gradient(to right, rgba(0,0,0,0.75) 0%, rgba(0,0,0,0.2) 100%); }
        
        /* Carousel Arrows */
        .carousel-arrow {
            position: absolute; top: 50%; transform: translateY(-50%);
            width: 32px; height: 32px; background: white;
            border: 1px solid #e5e7eb; border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            color: #9ca3af; cursor: pointer; box-shadow: 0 2px 4px rgba(0,0,0,0.05); z-index: 10;
            transition: all 0.2s ease;
        }
        .carousel-arrow:hover { background: #f9fafb; color: #4b5563; }
        .arrow-left { left: -16px; }
        .arrow-right { right: -16px; }

        /* Fancy Border for Cards (Top-left & Bottom-right radius) */
        .fancy-border-card {
            border: 1px solid #d1d5db;
            border-radius: 16px 0 16px 0;
            padding: 4px;
            background: white;
            transition: box-shadow 0.3s ease, transform 0.2s ease;
        }
        .fancy-border-card:hover { 
            box-shadow: 0 6px 16px rgba(0,0,0,0.08); 
            transform: translateY(-2px);
        }
        .fancy-border-card img {
            border-radius: 12px 0 12px 0;
            object-fit: cover;
        }
    </style>
</head>
<body class="bg-white text-gray-700 font-sans antialiased overflow-x-hidden">

    @include('components.frontend.header')

    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="navy-bg text-gray-300 text-xs pt-12 pb-6 px-6 mt-10">
        <div class="max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-4 gap-8 pb-8 border-b border-gray-600">
            <div>
                <h5 class="font-bold text-white uppercase mb-4 tracking-wider flex items-center gap-2">
                    About <span class="w-6 h-0.5 bg-gray-500 inline-block"></span>
                </h5>
                <p class="text-[11px] text-gray-400 leading-relaxed pr-4 text-justify">
                    {{ $siteSettings['about_us_text'] ?? 'Jitesh Tellsara & Associates LLP is a CA in Pune, professionally managed firm catering to domestic and international clients with a wide range of services in domestic and international taxation, regulatory and advisory services.' }}
                </p>
            </div>
            <div>
                <h5 class="font-bold text-white uppercase mb-4 tracking-wider flex items-center gap-2">
                    Services <span class="w-6 h-0.5 bg-gray-500 inline-block"></span>
                </h5>
                <ul class="space-y-2 text-gray-400 text-[11px]">
                    <li><a href="{{ route('services') }}?category=business_registration" class="hover:text-white transition flex items-center"><i class="fa-solid fa-caret-right mr-1.5 text-[9px] text-gray-500"></i> Business Registration</a></li>
                    <li><a href="{{ route('services') }}?category=company_formation" class="hover:text-white transition flex items-center"><i class="fa-solid fa-caret-right mr-1.5 text-[9px] text-gray-500"></i> Company Formation</a></li>
                    <li><a href="{{ route('services') }}?category=audit_assurance" class="hover:text-white transition flex items-center"><i class="fa-solid fa-caret-right mr-1.5 text-[9px] text-gray-500"></i> Audit & Assurance</a></li>
                    <li><a href="{{ route('services') }}?category=direct_tax" class="hover:text-white transition flex items-center"><i class="fa-solid fa-caret-right mr-1.5 text-[9px] text-gray-500"></i> Direct Tax</a></li>
                    <li><a href="{{ route('services') }}?category=corporate_laws" class="hover:text-white transition flex items-center"><i class="fa-solid fa-caret-right mr-1.5 text-[9px] text-gray-500"></i> Corporate Laws</a></li>
                    <li><a href="{{ route('services') }}?category=consultancy" class="hover:text-white transition flex items-center"><i class="fa-solid fa-caret-right mr-1.5 text-[9px] text-gray-500"></i> Consultancy</a></li>
                </ul>
            </div>
            <div>
                <h5 class="font-bold text-white uppercase mb-4 tracking-wider flex items-center gap-2">
                    Quick Links <span class="w-6 h-0.5 bg-gray-500 inline-block"></span>
                </h5>
                <ul class="space-y-2 text-gray-400 text-[11px]">
                    <li><a href="{{ route('home') }}" class="hover:text-white transition flex items-center"><i class="fa-solid fa-caret-right mr-1.5 text-[9px] text-gray-500"></i> Home</a></li>
                    <li><a href="{{ route('about') }}" class="hover:text-white transition flex items-center"><i class="fa-solid fa-caret-right mr-1.5 text-[9px] text-gray-500"></i> About Us</a></li>
                    <li><a href="{{ route('blogs') }}" class="hover:text-white transition flex items-center"><i class="fa-solid fa-caret-right mr-1.5 text-[9px] text-gray-500"></i> Blogs</a></li>
                    <li><a href="{{ route('contact') }}" class="hover:text-white transition flex items-center"><i class="fa-solid fa-caret-right mr-1.5 text-[9px] text-gray-500"></i> Contact Us</a></li>
                    <li><a href="{{ route('careers') }}" class="hover:text-white transition flex items-center"><i class="fa-solid fa-caret-right mr-1.5 text-[9px] text-gray-500"></i> Career</a></li>
                </ul>
            </div>
            <div>
                <h5 class="font-bold text-white uppercase mb-4 tracking-wider flex items-center gap-2">
                    Head Office <span class="w-6 h-0.5 bg-gray-500 inline-block"></span>
                </h5>
                <div class="space-y-3 text-gray-400 text-[11px]">
                    <p class="flex items-start gap-2.5">
                        <i class="fa-solid fa-location-dot text-theme-green mt-1 text-xs shrink-0"></i> 
                        <span>{{ $siteSettings['contact_address'] ?? 'Office No. 10, Ganga Trueno Business Park, New Airport Road, Viman Nagar, Pune-411014' }}</span>
                    </p>
                    <p class="flex items-center gap-2.5">
                        <i class="fa-solid fa-phone text-theme-green text-xs shrink-0"></i> 
                        <a href="tel:{{ $siteSettings['contact_phone'] ?? '+917875037800' }}" class="hover:text-white transition">{{ $siteSettings['contact_phone'] ?? '+91-7875037800' }}</a>
                    </p>
                    <p class="flex items-center gap-2.5">
                        <i class="fa-solid fa-envelope text-theme-green text-xs shrink-0"></i> 
                        <a href="mailto:{{ $siteSettings['contact_email'] ?? 'cajiteshtellsara@gmail.com' }}" class="hover:text-white transition">{{ $siteSettings['contact_email'] ?? 'cajiteshtellsara@gmail.com' }}</a>
                    </p>
                </div>
            </div>
        </div>
        <div class="max-w-7xl mx-auto flex flex-col sm:flex-row justify-between items-center gap-4 mt-4 text-[10px] text-gray-400">
            <span>Copyrights © {{ date('Y') }} All rights reserved to Jitesh Tellsara & Associates LLP</span>
            <a href="{{ route('contact') }}" class="bg-white text-blue-900 px-3.5 py-1.5 rounded-full font-bold shadow-md flex items-center gap-2 hover:bg-gray-100 transition">
                <span>Get In Touch</span> 
                <span class="bg-[#5c7ebb] text-white rounded-full w-5 h-5 flex items-center justify-center"><i class="fa-solid fa-comment-dots text-[9px]"></i></span>
            </a>
        </div>
    </footer>

</body>
</html>
