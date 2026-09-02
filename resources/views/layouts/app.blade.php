<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Home') - {{ $siteSettings['site_name'] ?? 'Jitesh Telisara & Associates LLP' }}</title>
    <meta name="description" content="@yield('meta_description', 'Explore expert insights from certified Chartered Accountants. Stay updated with tax laws, auditing standards, GST tips, personal finance strategies, and business compliance guides.')">
    <meta name="keywords" content="@yield('meta_keywords', 'CA near me, CA firms near me, Chartered Accountant firms near me, CA office near me, CA in Kharadi, Chartered Accountant in Kharadi')">
    <meta name="robots" content="follow, index, max-snippet:-1, max-video-preview:-1, max-image-preview:large">
    <link rel="canonical" href="@yield('canonical', url()->current())">
    @stack('meta')
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/@alpinejs/collapse@3.x.x/dist/cdn.min.js"></script>
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
<body class="bg-white text-gray-700 font-sans antialiased">

    @include('components.frontend.header')

    <main class="bg-white">
        @yield('content')
    </main>

    @include('components.frontend.footer')

</body>
</html>
