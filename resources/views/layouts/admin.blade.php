<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'CA Firm') }}</title>
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" defer></script>
    <style>
        body { font-family: 'Poppins', sans-serif; background: #fff; color: #263238; }
        .top-bar { background-color: #17345d; color: #fff; font-size: 0.72rem; padding: 5px 0; }
        .top-bar a { color: #fff; text-decoration: none; margin-left: 15px; }
        .navbar { background: #fff; padding: 10px 0; box-shadow: 0 2px 10px rgba(0,0,0,0.08); }
        .navbar-brand { color: #17345d !important; font-weight: 800; font-size: 1.12rem; line-height: 1.05; }
        .nav-link { color: #243447 !important; font-weight: 600; margin: 0 5px; text-transform: uppercase; font-size: 0.7rem; }
        .nav-link:hover { color: #00cc66 !important; }
        
        .hero-section { 
            background: linear-gradient(rgba(16, 42, 67, 0.7), rgba(16, 42, 67, 0.7)), url('https://images.unsplash.com/photo-1554224155-8d04cb21cd6c?auto=format&fit=crop&q=80') center/cover;
            color: #fff; 
            padding: 120px 0;
            text-align: center;
        }
        .hero-section h1 { font-weight: 800; text-transform: uppercase; letter-spacing: 1px; }
        
        .section-title { color: #102a43; font-weight: 700; margin-bottom: 30px; font-size: 1.8rem; }
        
        .btn-green { background: #00cc66; color: #fff; font-weight: 600; padding: 10px 25px; border-radius: 4px; text-decoration: none; border: none; }
        .btn-green:hover { background: #00b359; color: #fff; }
        
        .btn-darkblue { background: #102a43; color: #fff; font-weight: 600; padding: 8px 20px; border-radius: 4px; text-decoration: none; border: none; }
        .btn-darkblue:hover { background: #0a1c2e; color: #fff; }

        .footer { background: #102a43; color: #fff; padding: 60px 0 20px; }
        .footer h6 { font-weight: 700; margin-bottom: 20px; text-transform: uppercase; font-size: 1rem; color: #fff; }
        .footer ul li a { color: #a1b0c0; text-decoration: none; transition: 0.3s; line-height: 2; }
        .footer ul li a:hover { color: #fff; }
        .footer p { color: #a1b0c0; }
        
        .card-service { border: none; border-radius: 8px; overflow: hidden; box-shadow: 0 5px 15px rgba(0,0,0,0.08); transition: 0.3s; height: 100%;}
        .card-service:hover { transform: translateY(-5px); }
        .card-service img { height: 200px; object-fit: cover; width: 100%; }
        
        .card-registration { border: 2px solid #102a43; border-radius: 12px; overflow: hidden; text-align: center; height: 100%; transition: 0.3s; }
        .card-registration .top-half { padding: 20px; background: #fff; height: 120px; display: flex; align-items: center; justify-content: center; }
        .card-registration .top-half img { max-height: 80px; object-fit: contain; }
        .card-registration .bottom-half { background: #102a43; color: #fff; padding: 15px; font-weight: 600; height: 100%; display: flex; align-items: center; justify-content: center; }
        
        .card-formation { border: 1px solid #e0e0e0; border-radius: 12px; text-align: center; padding: 25px 15px; height: 100%; transition: 0.3s; background: #fff; }
        .card-formation:hover { box-shadow: 0 5px 15px rgba(0,0,0,0.05); border-color: #00cc66; }
        .card-formation .icon-wrap { background: #00cc66; color: #fff; width: 80px; height: 80px; border-radius: 8px; display: inline-flex; align-items: center; justify-content: center; font-size: 2rem; margin-bottom: 15px; }
        .card-formation .icon-wrap img { width: 100%; height: 100%; object-fit: cover; border-radius: 8px; }
        .card-formation h6 { font-weight: 600; color: #102a43; margin: 0; }
        
        .card-vertical { border: 1px solid #ddd; border-radius: 12px; overflow: hidden; text-align: center; padding: 10px; background: #fff; height: 100%; }
        .card-vertical img { width: 100%; height: 150px; object-fit: cover; border-radius: 8px; margin-bottom: 15px; }
        .card-vertical h6 { font-weight: 600; color: #102a43; }
        
        .review-card { border: none; border-radius: 12px; background: #f8f9fa; padding: 20px; height: 100%; text-align: left; }
        .stars { color: #ffc107; margin-bottom: 10px; }

        .hero-panel { min-height: 275px; background: linear-gradient(135deg, #315778, #17345d); background-position: center; background-size: cover; color: #fff; display: flex; align-items: center; justify-content: center; text-align: center; position: relative; }
        .hero-content { padding: 62px 20px 72px; }
        .hero-content h1 { font-size: clamp(1.65rem, 4vw, 2.2rem); font-weight: 800; margin: 8px 0 6px; }
        .hero-content p:not(.hero-kicker) { font-size: .78rem; font-weight: 600; margin: 0 auto 18px; max-width: 420px; }
        .hero-kicker, .eyebrow { color: #0bb765; font-size: .62rem; font-weight: 800; letter-spacing: 1.5px; margin: 0; }
        .hero-dots { position: absolute; bottom: 14px; display: flex; gap: 4px; }
        .hero-dots span { width: 8px; height: 8px; border-radius: 50%; border: 1px solid #fff; opacity: .75; }
        .hero-dots .active { background: #fff; }
        .section-band { padding: 48px 0; }
        .section-light { background: #fafafa; }
        .narrow-container { max-width: 1080px; }
        .section-heading { border-bottom: 1px solid #e4e8eb; margin-bottom: 28px; padding-bottom: 12px; }
        .section-heading h2, .intro-grid h2 { color: #27323a; font-size: 1.35rem; font-weight: 700; margin: 4px 0 0; }
        .body-copy { color: #68737a; font-size: .73rem; line-height: 1.8; }
        .intro-grid { display: grid; grid-template-columns: 1.25fr .75fr; gap: 52px; align-items: center; }
        .intro-grid img { width: 100%; height: 245px; object-fit: cover; }
        .btn-accent { background: #09b85b; border: 0; border-radius: 2px; color: #fff; font-size: .68rem; font-weight: 700; padding: 9px 21px; }
        .btn-accent:hover { color: #fff; background: #078f48; }
        .service-grid, .review-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 14px; }
        .service-card { background: #fff; box-shadow: 0 4px 15px rgba(24, 42, 56, .08); }
        .service-card img { width: 100%; height: 150px; object-fit: cover; }
        .service-card-body { padding: 16px; text-align: center; }
        .service-card h3 { color: #1d3047; font-size: .85rem; font-weight: 700; }
        .service-card p { color: #727b80; font-size: .67rem; line-height: 1.6; min-height: 43px; }
        .btn-navy { background: #17345d; border-radius: 2px; color: #fff; font-size: .62rem; font-weight: 700; padding: 8px 18px; }
        .btn-navy:hover { color: #fff; background: #0d2544; }
        .registration-grid { display: grid; grid-template-columns: repeat(5, 1fr); gap: 12px; }
        .registration-card { border: 2px solid #17345d; border-radius: 8px; color: #17345d; min-height: 112px; padding: 12px 8px; display: flex; flex-direction: column; align-items: center; justify-content: space-between; text-align: center; text-decoration: none; }
        .registration-card:hover { color: #09a954; border-color: #09a954; }
        .registration-icon { color: #09b85b; font-size: 2rem; }
        .registration-card strong, .formation-card strong, .vertical-card strong { font-size: .67rem; line-height: 1.3; }
        .formation-grid { display: grid; grid-template-columns: repeat(4, 1fr); gap: 13px; }
        .formation-card { border: 1px solid #c9ced2; border-radius: 7px; min-height: 150px; padding: 10px; color: #28333a; display: flex; flex-direction: column; align-items: center; justify-content: space-between; text-align: center; text-decoration: none; }
        .formation-card:hover { border-color: #09b85b; color: #09a954; }
        .formation-card img { width: 100%; height: 84px; object-fit: cover; border-radius: 5px; }
        .formation-icon { background: #dff7e9; border-radius: 6px; color: #09a954; display: grid; place-items: center; font-size: 2.1rem; height: 84px; width: 100%; }
        .vertical-grid { display: grid; grid-template-columns: repeat(4, 1fr); gap: 13px; }
        .vertical-card { border: 1px solid #bfc6ca; border-radius: 7px; color: #28333a; padding: 9px; text-align: center; text-decoration: none; }
        .vertical-card img { width: 100%; height: 122px; border-radius: 6px; object-fit: cover; display: block; margin-bottom: 12px; }
        .rating strong { color: #27323a; font-size: .8rem; }
        .rating .stars { font-size: 1.3rem; margin: 2px 0; }
        .rating small { color: #7a8388; display: block; font-size: .65rem; }
        .rating b { display: block; font-size: 1.15rem; margin-top: 5px; }
        .rating b span { color: #4285f4; }
        .review-card { background: #fff; border-radius: 7px; box-shadow: 0 3px 13px rgba(24,42,56,.08); padding: 16px; }
        .review-top { display: grid; grid-template-columns: 32px 1fr; column-gap: 9px; align-items: center; text-align: left; }
        .review-top strong { font-size: .7rem; }.review-top small { color: #899197; font-size: .58rem; grid-column: 2; }.avatar { background: #1f76d1; border-radius: 50%; color: #fff; display: grid; font-size: .75rem; font-weight: 700; height: 30px; place-items: center; width: 30px; grid-row: span 2; }
        .review-card .stars { font-size: .75rem; margin: 10px 0 6px; }.review-card p { color: #69747a; font-size: .65rem; line-height: 1.6; margin: 0; text-align: left; }
        @media (max-width: 767px) { .intro-grid, .service-grid, .review-grid { grid-template-columns: 1fr; } .registration-grid { grid-template-columns: repeat(2, 1fr); }.formation-grid, .vertical-grid { grid-template-columns: repeat(2, 1fr); }.intro-grid { gap: 24px; }.intro-grid img { height: 210px; }.section-band { padding: 35px 0; } }
    </style>
</head>
<body>
    <div class="top-bar">
        <div class="container d-flex justify-content-between align-items-center">
            <div>
                <i class="fas fa-envelope me-2"></i> {{ $siteSettings['contact_email'] ?? '' }}
                <span class="mx-3">|</span>
                <i class="fas fa-phone-alt me-2"></i> {{ $siteSettings['contact_phone'] ?? '' }}
            </div>
            <div>
                @if(!empty($siteSettings['facebook_link']))<a href="{{ $siteSettings['facebook_link'] }}" target="_blank" rel="noopener"><i class="fab fa-facebook-f"></i></a>@endif
                @if(!empty($siteSettings['twitter_link']))<a href="{{ $siteSettings['twitter_link'] }}" target="_blank" rel="noopener"><i class="fab fa-twitter"></i></a>@endif
                @if(!empty($siteSettings['linkedin_link']))<a href="{{ $siteSettings['linkedin_link'] }}" target="_blank" rel="noopener"><i class="fab fa-linkedin-in"></i></a>@endif
            </div>
        </div>
    </div>

    <nav class="navbar navbar-expand-lg sticky-top">
        <div class="container">
            <a class="navbar-brand" href="{{ route('home') }}">
                <span style="color: #17345d;">JITESH TELSARA</span><small class="d-block" style="color: #09b85b; font-size: .55rem; letter-spacing: .4px;">& ASSOCIATES LLP | Chartered Accountants</small>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="mainNav">
                <ul class="navbar-nav mx-auto align-items-lg-center">
                    <li class="nav-item"><a class="nav-link" href="{{ route('home') }}">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('services') }}">Registration</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('about') }}">About Us</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('services') }}">RERA</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('careers') }}">Career</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('blogs') }}">Blog</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('contact') }}">Contact Us</a></li>
                </ul>
                <ul class="navbar-nav">
                    @auth
                        <li class="nav-item"><a class="btn btn-sm btn-darkblue" href="{{ route('admin.dashboard') }}">Admin Panel</a></li>
                    @else
                        <li class="nav-item"><a class="btn btn-sm btn-darkblue" href="{{ route('login') }}">Login</a></li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    <main>
        @yield('content')
    </main>

    <footer class="footer">
        <div class="container">
            <div class="row g-4">
                <div class="col-md-3">
                    <h4 class="fw-bold mb-3">Jitesh Telsara & Associates LLP</h4>
                    <p class="small">We provide professional chartered accountancy expertise for businesses, individuals, and growing organizations.</p>
                </div>
                <div class="col-md-3">
                    <h6>Services</h6>
                    <ul class="list-unstyled">
                        @foreach($footerServices as $footerService)
                            <li><a href="{{ route('service.show', $footerService->slug) }}">{{ $footerService->title }}</a></li>
                        @endforeach
                    </ul>
                </div>
                <div class="col-md-3">
                    <h6>Quick Links</h6>
                    <ul class="list-unstyled">
                        <li><a href="{{ route('home') }}">Home</a></li>
                        <li><a href="{{ route('about') }}">About Us</a></li>
                        <li><a href="{{ route('blogs') }}">Blogs</a></li>
                        <li><a href="{{ route('careers') }}">Careers</a></li>
                    </ul>
                </div>
                <div class="col-md-3">
                    <h6>Reach Us</h6>
                    <ul class="list-unstyled small">
                        <li class="mb-2"><i class="fas fa-map-marker-alt me-2"></i> {{ $siteSettings['contact_address'] ?? '' }}</li>
                        <li class="mb-2"><i class="fas fa-phone-alt me-2"></i> {{ $siteSettings['contact_phone'] ?? '' }}</li>
                        <li class="mb-2"><i class="fas fa-envelope me-2"></i> {{ $siteSettings['contact_email'] ?? '' }}</li>
                    </ul>
                </div>
            </div>
            <div class="text-center mt-5 pt-3 border-top border-secondary small text-muted">
                &copy; {{ date('Y') }} Jitesh Telhara & Associates LLP. All Rights Reserved.
            </div>
        </div>
    </footer>
</body>
</html>
