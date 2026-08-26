@extends('layouts.app')

@section('content')
<section class="links-hero" style="background-image: linear-gradient(rgba(22, 45, 75, .72), rgba(22, 45, 75, .72)), url('https://images.unsplash.com/photo-1451187580459-43490279c0fa?auto=format&fit=crop&w=1600&q=80');">
    <div class="container">
        <p class="links-kicker">RESOURCE CENTRE</p>
        <h1>{{ $siteSettings['links_title'] ?? 'Links' }}</h1>
        <p class="links-breadcrumb"><a href="{{ route('home') }}">Home</a><span>/</span> Links</p>
    </div>
</section>

<section class="section-band">
    <div class="container narrow-container">
        <p class="links-intro">{{ $siteSettings['links_intro'] ?? "Trying to find a high quality, useful site on the web can often be a time-consuming experience. To save you the trouble we've compiled a list of websites that we've found to be valuable sources of information. Clicking on a link will open a new window for you." }}</p>
        <div class="row g-5 links-grid">
            @foreach(['gov' => 'Government Websites', 'financial' => 'Financial Institutions', 'ca' => 'CA Governance', 'news' => 'News', 'finance' => 'Finance'] as $category => $heading)
                <div class="col-md-6">
                    <div class="links-heading"><h2>{{ $heading }}</h2><span></span></div>
                    <ul class="list-unstyled links-list mb-0">
                        @forelse($links->get($category, collect()) as $link)
                            <li><i class="fas fa-chevron-right"></i><a href="{{ $link->url }}" target="_blank" rel="noopener noreferrer">{{ $link->title }}</a></li>
                        @empty
                            <li class="links-empty">No links have been published yet.</li>
                        @endforelse
                    </ul>
                </div>
            @endforeach
        </div>
        <p class="links-footer">{{ $siteSettings['links_footer'] ?? '' }}</p>
    </div>
</section>
<style>
    .links-hero { min-height: 275px; padding: 74px 0; background-position: center; background-size: cover; color: #fff; display: flex; align-items: center; }
    .links-hero h1 { margin: 8px 0 10px; font-size: clamp(2rem, 4vw, 2.65rem); font-weight: 800; }
    .links-kicker { color: #16a34a; font-size: .68rem; font-weight: 800; letter-spacing: 1.8px; margin: 0; }
    .links-breadcrumb { color: #dbe4ec; font-size: .78rem; font-weight: 600; margin: 0; }
    .links-breadcrumb a { color: #fff; text-decoration: none; }.links-breadcrumb span { padding: 0 9px; color: #9eb0c0; }
    .links-intro { color: #68737a; font-size: .82rem; line-height: 1.9; margin: 0 0 46px; }
    .links-grid { align-items: start; }.links-heading { border-bottom: 1px solid #e2e7ea; margin-bottom: 16px; padding-bottom: 11px; }
    .links-heading h2 { color: #27323a; font-size: 1.35rem; font-weight: 700; margin: 0; }.links-heading span { background: #16a34a; display: block; height: 2px; margin-top: 10px; width: 42px; }
    .links-list li { align-items: center; border-bottom: 1px solid #f0f2f3; display: flex; min-height: 47px; padding: 10px 0; }
    .links-list li > i { color: #4b5563; font-size: .65rem; margin-right: 14px; }.links-list a { color: #16a34a; font-size: .84rem; font-weight: 600; text-decoration: none; transition: color .2s; }.links-list a:hover { color: #15803d; }
    .external-icon { color: #9aa4aa; font-size: .63rem; margin-left: 9px; }.links-empty { color: #68737a; font-size: .78rem; }.links-footer { border-top: 1px solid #e2e7ea; color: #68737a; font-size: .72rem; line-height: 1.9; margin: 48px 0 0; padding-top: 24px; text-align: justify; }
    @media (max-width: 767px) { .links-hero { min-height: 230px; padding: 54px 0; }.links-intro { margin-bottom: 34px; }.links-grid { row-gap: 38px !important; } }
</style>
@endsection