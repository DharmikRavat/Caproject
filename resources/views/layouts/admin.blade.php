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
<body class="admin-body">
    <button class="admin-menu-toggle" type="button" data-admin-menu-toggle aria-label="Toggle admin navigation"><i class="fas fa-bars"></i></button>
    <div class="admin-shell">
        <aside class="admin-sidebar" data-admin-sidebar>
            <a href="{{ route('admin.dashboard') }}" class="admin-brand">
                <span class="fs-4 fw-bolder text-white me-2">CA</span>
                <span><strong>{{ $siteSettings['site_name'] ?? 'JITESH TELISARA' }}</strong></span>
            </a>
            <div class="admin-user">
                <i class="fas fa-user-shield"></i>
                <span>{{ auth()->user()->name ?? 'Administrator' }}<small>Administrator</small></span>
            </div>
            <nav class="admin-nav" aria-label="Admin navigation">
                <p>Workspace</p><a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}"><i class="fas fa-chart-line"></i>Dashboard</a>
                <p>Website Content</p>

                <a href="{{ route('admin.blogs.index') }}" class="{{ request()->routeIs('admin.blogs.*') ? 'active' : '' }}"><i class="fas fa-newspaper"></i>Blogs</a><a href="{{ route('admin.blog-categories.index') }}" class="{{ request()->routeIs('admin.blog-categories.*') ? 'active' : '' }}"><i class="fas fa-folder"></i>Blog Categories</a><a href="{{ route('admin.blog-tags.index') }}" class="{{ request()->routeIs('admin.blog-tags.*') ? 'active' : '' }}"><i class="fas fa-tags"></i>Blog Tags</a><a href="{{ route('admin.blog-archives.index') }}" class="{{ request()->routeIs('admin.blog-archives.*') ? 'active' : '' }}"><i class="fas fa-archive"></i>Blog Archives</a><a href="{{ route('admin.team-members.index') }}" class="{{ request()->routeIs('admin.team-members.*') ? 'active' : '' }}"><i class="fas fa-users"></i>Team Members</a><a href="{{ route('admin.banners.index') }}" class="{{ request()->routeIs('admin.banners.*') ? 'active' : '' }}"><i class="fas fa-image"></i>Banners</a><a href="{{ route('admin.service-categories.index') }}" class="{{ request()->routeIs('admin.service-categories.*') || request()->routeIs('admin.services.*') ? 'active' : '' }}"><i class="fas fa-briefcase"></i>Services & Content</a><a href="{{ route('admin.industries.index') }}" class="{{ request()->routeIs('admin.industries.*') ? 'active' : '' }}"><i class="fas fa-industry"></i>Verticals We Serve</a><a href="{{ route('admin.testimonials.index') }}" class="{{ request()->routeIs('admin.testimonials.*') ? 'active' : '' }}"><i class="fas fa-star"></i>Happy Clients</a><a href="{{ route('admin.links.edit') }}" class="{{ request()->requestUri === '/admin/links' ? 'active' : '' }}"><i class="fas fa-link"></i>Important Links</a>
                <p>Operations</p><a href="{{ route('admin.contact-enquiries.index') }}" class="{{ request()->routeIs('admin.contact-enquiries.*') ? 'active' : '' }}"><i class="fas fa-envelope"></i>Enquiries</a><a href="{{ route('admin.job-applications.index') }}" class="{{ request()->routeIs('admin.job-applications.*') ? 'active' : '' }}"><i class="fas fa-file-alt"></i>Job Applications</a>
                <a href="{{ route('admin.site-settings.index') }}" class="{{ request()->routeIs('admin.site-settings.*') ? 'active' : '' }}"><i class="fas fa-cog"></i>Site Settings</a>
                <a href="{{ route('admin.users.index') }}" class="{{ request()->routeIs('admin.users.*') ? 'active' : '' }}"><i class="fas fa-users-cog"></i>Admin Users</a>
            </nav>
            <div class="admin-sidebar-bottom"><a href="{{ route('home') }}"><i class="fas fa-globe"></i>View website</a><form method="POST" action="{{ route('logout') }}">@csrf<button type="submit"><i class="fas fa-sign-out-alt"></i>Logout</button></form></div>
        </aside>
        <div class="admin-main"><header class="admin-topbar"><div><span class="admin-page-kicker">ADMINISTRATION</span><strong>Content management workspace</strong></div><span class="admin-status"><i class="fas fa-circle"></i> System online</span></header><main>@yield('content')</main></div>
    </div>
    <style>
        /* Modern SaaS Variables */
        :root {
            --admin-bg: #f8fafc;
            --admin-text: #334155;
            --sidebar-bg: #0f172a;
            --sidebar-text: #ffffff; /* Changed to white as per user request */
            --sidebar-hover: #1e293b;
            --primary: #4f46e5;
            --primary-hover: #4338ca;
            --success: #10b981;
            --border-color: #e2e8f0;
            --card-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05), 0 2px 4px -1px rgba(0, 0, 0, 0.03);
        }

        body.admin-body { font-family: 'Poppins', sans-serif; background: var(--admin-bg); color: var(--admin-text); overflow-x: hidden; }
        .admin-shell { display: flex; min-height: 100vh; position: relative; }
        
        /* Sidebar Styling */
        .admin-sidebar { background: var(--sidebar-bg); color: var(--sidebar-text); display: flex; flex-direction: column; flex: 0 0 260px; min-height: 100vh; padding: 25px 20px; position: sticky; top: 0; z-index: 1040; transition: transform 0.3s ease; box-shadow: 2px 0 10px rgba(0,0,0,0.1); }
        .admin-brand { align-items: center; color: #fff; display: flex; gap: 12px; margin: 0 5px 30px; text-decoration: none; }
        .admin-brand-logo { height: 38px; width: 38px; object-fit: contain; border-radius: 8px; background: #fff; padding: 4px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); }
        .admin-brand strong { display: block; font-size: 13px; font-weight: 600; letter-spacing: .5px; }
        .admin-brand small { color: var(--success); display: block; font-size: 10px; font-weight: 500; margin-top: 2px; }
        
        .admin-user { align-items: center; display: flex; font-size: 13px; gap: 12px; margin: 0 5px 25px; padding: 5px 0; }
        .admin-user > i { color: var(--success); font-size: 18px; }
        .admin-user span { color: #f1f5f9; font-weight: 500; }
        .admin-user small { color: #94a3b8; display: block; font-size: 11px; margin-top: 2px; font-weight: 400; }
        
        .admin-nav { flex: 1; }
        .admin-nav p { color: #94a3b8; font-size: 11px; font-weight: 600; letter-spacing: 1.2px; margin: 25px 10px 10px; text-transform: uppercase; }
        .admin-nav a, .admin-sidebar-bottom a, .admin-sidebar-bottom button { align-items: center; background: transparent; border: 0; border-radius: 8px; color: var(--sidebar-text); display: flex; font-size: 14px; font-weight: 500; gap: 14px; margin: 4px 0; padding: 12px 15px; text-align: left; text-decoration: none; width: 100%; transition: all 0.2s ease; }
        .admin-nav a i, .admin-sidebar-bottom i { color: var(--sidebar-text); width: 18px; font-size: 15px; text-align: center; transition: color 0.2s ease; opacity: 0.9; }
        .admin-nav a:hover { background: var(--sidebar-hover); color: #ffffff; }
        .admin-nav a:hover i { color: #ffffff; opacity: 1; }
        .admin-nav a.active { background: var(--primary); color: #fff; box-shadow: 0 4px 6px rgba(79, 70, 229, 0.2); }
        .admin-nav a.active i { color: #fff; }
        
        .admin-sidebar-bottom { border-top: 1px solid rgba(255,255,255,0.08); padding-top: 15px; margin-top: auto; }
        .admin-sidebar-bottom form { margin: 0; }
        .admin-sidebar-bottom button { cursor: pointer; }
        .admin-sidebar-bottom a:hover, .admin-sidebar-bottom button:hover { color: #fff; background: var(--sidebar-hover); }
        
        /* Main Area & Topbar */
        .admin-main { flex: 1; min-width: 0; width: 100%; display: flex; flex-direction: column; }
        .admin-topbar { align-items: center; background: #fff; border-bottom: 1px solid var(--border-color); display: flex; justify-content: space-between; padding: 18px 40px; position: sticky; top: 0; z-index: 1030; }
        .admin-page-kicker { color: var(--primary); display: block; font-size: 11px; font-weight: 700; letter-spacing: 1px; text-transform: uppercase; margin-bottom: 4px; }
        .admin-topbar strong { color: #1e293b; font-size: 18px; font-weight: 600; }
        .admin-status { color: #64748b; font-size: 12px; font-weight: 500; display: flex; align-items: center; background: #f1f5f9; padding: 6px 12px; border-radius: 20px; }
        .admin-status i { color: var(--success); font-size: 8px; margin-right: 6px; }
        .admin-menu-toggle { display: none; }
        
        /* General Layout */
        main { padding: 30px 40px; flex: 1; }
        .card { border: 1px solid var(--border-color); border-radius: 12px; box-shadow: var(--card-shadow); margin-bottom: 24px; transition: transform 0.2s, box-shadow 0.2s; }
        .section-title { font-size: 1.5rem; font-weight: 600; color: #0f172a; }
        
        /* SaaS Forms */
        .form-control, .form-select { border-color: #cbd5e1; border-radius: 8px; padding: 10px 15px; font-size: 14px; color: #334155; transition: all 0.2s; }
        .form-control:focus, .form-select:focus { border-color: var(--primary); box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.1); }
        .form-label { font-weight: 500; color: #475569; font-size: 13px; margin-bottom: 6px; }
        
        /* SaaS Buttons */
        .btn { border-radius: 8px; padding: 8px 16px; font-weight: 500; font-size: 14px; transition: all 0.2s; }
        .btn-primary, .btn-primary-custom, .btn-green, .btn-darkblue { background-color: var(--primary); border: 1px solid var(--primary); color: #fff; }
        .btn-primary:hover, .btn-primary-custom:hover, .btn-green:hover, .btn-darkblue:hover { background-color: var(--primary-hover); border-color: var(--primary-hover); color: #fff; }
        
        /* Mobile Overlay */
        .admin-sidebar-overlay { display: none; position: fixed; inset: 0; background: rgba(15, 23, 42, 0.6); z-index: 1030; backdrop-filter: blur(4px); transition: opacity 0.3s; opacity: 0; }
        .admin-sidebar-overlay.show { display: block; opacity: 1; }

        @media (max-width: 991px) {
            .admin-sidebar { flex-basis: 240px; }
            .admin-topbar { padding: 16px 24px; }
            main { padding: 24px; }
        }

        @media (max-width: 768px) {
            .admin-sidebar { position: fixed; bottom: 0; left: 0; transform: translateX(-100%); }
            .admin-sidebar.open { transform: translateX(0); }
            .admin-menu-toggle { 
                background: var(--sidebar-bg); 
                border: 0; 
                border-radius: 8px; 
                color: #fff; 
                display: block; 
                font-size: 18px; 
                padding: 10px 14px; 
                position: fixed; 
                right: 15px; 
                top: 15px; 
                z-index: 1050; 
                box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            }
            .admin-topbar { padding: 16px 70px 16px 20px; }
            .admin-status { display: none; }
            main { padding: 20px 15px; }
        }
    </style>
    <div class="admin-sidebar-overlay" data-admin-sidebar-overlay></div>
    <script>
        const menuToggle = document.querySelector('[data-admin-menu-toggle]');
        const sidebar = document.querySelector('[data-admin-sidebar]');
        const overlay = document.querySelector('[data-admin-sidebar-overlay]');

        menuToggle.addEventListener('click', function() {
            sidebar.classList.toggle('open');
            overlay.classList.toggle('show');
        });

        overlay.addEventListener('click', function() {
            sidebar.classList.remove('open');
            overlay.classList.remove('show');
        });
    </script>
</body>
</html>
