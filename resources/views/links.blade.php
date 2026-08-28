@extends('layouts.app')

@section('content')
<!-- Hero Section -->
<section class="links-hero">
    <div class="breadcrumbs">
        <a href="{{ route('home') }}">Home</a> &gt; Links
    </div>
    <h1>{{ $siteSettings['links_title'] ?? 'Links' }}</h1>
</section>

<!-- Main Content -->
<main class="content-container">
    <p class="intro-text">
        {{ $siteSettings['links_intro'] ?? "Trying to find a high quality, useful site on the web can often be a time-consuming experience. To save you the trouble we've compiled a list of websites that we've found to be valuable sources of information. Clicking on a link will open a new window for you." }}
    </p>

    <div class="links-grid">
        
        <!-- Left Column -->
        <div>
            @foreach(['gov' => 'Government Websites', 'ca' => 'CA Governance'] as $category => $heading)
            <div class="link-section">
                <h2>{{ $heading }}</h2>
                <ul class="link-list">
                    @forelse($links->get($category, collect()) as $link)
                        <li><a href="{{ $link->url }}" target="_blank" rel="noopener noreferrer"><span class="icon">&#10095;</span> {{ $link->title }}</a></li>
                    @empty
                        <li><a href="#"><span class="icon">&#10095;</span> No links have been published yet.</a></li>
                    @endforelse
                </ul>
            </div>
            @endforeach
        </div>

        <!-- Right Column -->
        <div>
            @foreach(['financial' => 'Financial Institutions', 'news' => 'News', 'finance' => 'Finance'] as $category => $heading)
            <div class="link-section">
                <h2>{{ $heading }}</h2>
                <ul class="link-list">
                    @forelse($links->get($category, collect()) as $link)
                        <li><a href="{{ $link->url }}" target="_blank" rel="noopener noreferrer"><span class="icon">&#10095;</span> {{ $link->title }}</a></li>
                    @empty
                        <li><a href="#"><span class="icon">&#10095;</span> No links have been published yet.</a></li>
                    @endforelse
                </ul>
            </div>
            @endforeach
        </div>

    </div>

    <!-- Long Description Text -->
    <p class="bottom-description">
        {{ $siteSettings['links_footer'] ?? 'Jitesh Telisara & Associates LLP, Chartered Accountant in Pune is a professionally managed firm catering to domestic and international clients with wide range of services in domestic and international taxation, regulatory and advisory services and cross border transaction related services. The team at JTA LLP is a Firm of CA in Vimannagar and has dedicated, experienced and expert professionals and associates like Chartered Accountants, Company Secretary and Consultants and high-end infrastructure to provide end to end services to your business. With effort of gaining deep understanding of your business, our qualified team is committed to provide valuable.' }}
    </p>
</main>

<style>
    /* --- Hero Section --- */
    .links-hero {
        background: linear-gradient(rgba(36, 53, 77, 0.7), rgba(36, 53, 77, 0.7)), url('https://via.placeholder.com/1500x300/1a2b42/ffffff?text=Background+Pattern') center/cover;
        color: #ffffff;
        padding: 60px 5%;
        text-align: left;
    }
    .breadcrumbs { font-size: 12px; margin-bottom: 15px; }
    .breadcrumbs a { color: #ffffff; text-decoration: none; }
    .links-hero h1 { font-size: 32px; font-weight: 700; margin: 0; }

    /* --- Main Content Container --- */
    .content-container {
        padding: 50px 5%;
        max-width: 1400px;
        margin: 0 auto;
    }
    .intro-text {
        font-size: 14px;
        color: #777;
        margin-bottom: 40px;
    }

    /* --- Two Column Links Grid --- */
    .links-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 60px;
        margin-bottom: 50px;
    }
    .link-section { margin-bottom: 40px; }
    .link-section h2 {
        font-size: 22px;
        color: #24354d;
        margin-bottom: 15px;
        font-weight: 700;
    }
    .link-list { list-style: none; padding: 0; margin: 0; border-top: 1px solid #eaeaea; }
    .link-list li { border-bottom: 1px solid #eaeaea; }
    .link-list a {
        display: flex;
        align-items: center;
        text-decoration: none;
        color: #27ae60;
        padding: 12px 5px;
        font-size: 14px;
        transition: background-color 0.2s ease;
    }
    .link-list a:hover { background-color: #f9f9f9; }
    .link-list .icon {
        color: #555;
        font-size: 12px;
        margin-right: 15px;
    }

    /* --- Bottom Paragraph --- */
    .bottom-description {
        font-size: 13px;
        color: #666;
        text-align: justify;
        line-height: 1.8;
        margin-bottom: 20px;
    }

    /* --- Responsive Design --- */
    @media (max-width: 900px) {
        .links-grid { grid-template-columns: 1fr; gap: 30px; }
    }
</style>
@endsection