<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'CA Firm') }}</title>
    <!-- Include Tailwind CSS via CDN since Vite isn't configured in this project -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Alpine.js (Optional, good for mobile menus/sliders) -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="font-sans antialiased text-gray-800 bg-white">

    @include('components.frontend.header')

    <main>
        @yield('content')
    </main>

    <!-- =========================
         7. FOOTER
         ========================= -->
    <footer class="bg-blue-900 text-gray-300 py-12 px-4 md:px-12 text-sm w-full mt-10">
        <div class="max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-4 gap-8">
            <!-- About Column -->
            <div>
                <h4 class="text-white font-bold text-lg mb-4">ABOUT</h4>
                <p class="mb-4">Jitesh Telhara & Associates LLP is a Pune based professionally managed firm catering to domestic and international clients...</p>
            </div>
            
            <!-- Services Column -->
            <div>
                <h4 class="text-white font-bold text-lg mb-4">SERVICES</h4>
                <ul class="space-y-2">
                    @foreach($footerServices as $footerService)
                        <li><a href="{{ route('service.show', $footerService->slug) }}" class="hover:text-white">- {{ $footerService->title }}</a></li>
                    @endforeach
                </ul>
            </div>

            <!-- Quick Links Column -->
            <div>
                <h4 class="text-white font-bold text-lg mb-4">QUICK LINKS</h4>
                <ul class="space-y-2">
                    <li><a href="{{ route('home') }}" class="hover:text-white">- Home</a></li>
                    <li><a href="{{ route('about') }}" class="hover:text-white">- About Us</a></li>
                    <li><a href="{{ route('blogs') }}" class="hover:text-white">- Blogs</a></li>
                    <li><a href="{{ route('contact') }}" class="hover:text-white">- Contact Us</a></li>
                </ul>
            </div>

            <!-- Contact Column -->
            <div>
                <h4 class="text-white font-bold text-lg mb-4">HEAD OFFICE</h4>
                <ul class="space-y-3">
                    <li class="flex items-start">
                        <span class="mr-2">📍</span>
                        <span>{{ $siteSettings['contact_address'] ?? '' }}</span>
                    </li>
                    <li class="flex items-center">
                        <span class="mr-2">📞</span>
                        <span>{{ $siteSettings['contact_phone'] ?? '' }}</span>
                    </li>
                    <li class="flex items-center">
                        <span class="mr-2">✉️</span>
                        <span>{{ $siteSettings['contact_email'] ?? '' }}</span>
                    </li>
                </ul>
            </div>
        </div>
        
        <!-- Bottom Bar -->
        <div class="mt-12 pt-6 border-t border-blue-800 text-center text-xs">
            <p>Copyright © {{ date('Y') }} by Jitesh Telhara & Associates LLP.</p>
        </div>
    </footer>

</body>
</html>
