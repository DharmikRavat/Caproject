@extends('layouts.app')

@section('content')
<!-- Detail Header -->
<section class="navy-bg text-white py-12 px-6">
    <div class="max-w-7xl mx-auto flex flex-col md:flex-row md:items-center md:justify-between gap-4">
        <div>
            <span class="text-xs font-bold uppercase tracking-wider text-theme-green mb-2 block">
                {{ $serviceCategories[$service->category] ?? \Illuminate\Support\Str::headline($service->category) }}
            </span>
            <h1 class="text-3xl font-bold">{{ $service->title }}</h1>
        </div>
        <a href="{{ route('services') }}" class="text-xs font-bold text-gray-300 hover:text-white flex items-center gap-1.5 self-start md:self-auto">
            <i class="fa-solid fa-arrow-left text-[10px]"></i> Back to Services
        </a>
    </div>
</section>

<!-- Content Body -->
<div class="max-w-7xl mx-auto px-6 py-12">
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-10">
        <!-- Main Content -->
        <div class="lg:col-span-8 space-y-6">
            <div class="bg-white p-8 rounded-lg border border-gray-200 shadow-sm space-y-6">
                @if($service->short_description)
                    <p class="text-base text-gray-700 font-medium leading-relaxed border-l-4 border-green-500 pl-4 bg-green-50/50 py-3 rounded-r">
                        {{ $service->short_description }}
                    </p>
                @endif

                <div class="prose max-w-none text-sm text-gray-600 leading-relaxed space-y-4">
                    {!! nl2br(e($service->description)) !!}
                </div>

                <div class="pt-6 border-t border-gray-100 flex flex-wrap gap-4 items-center justify-between">
                    <span class="text-xs text-gray-500">Need customized assistance with {{ $service->title }}?</span>
                    <a href="{{ route('contact') }}" class="bg-theme-green hover-bg-theme-green text-white font-bold px-6 py-2.5 rounded shadow text-xs transition">
                        Enquire Now
                    </a>
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="lg:col-span-4 space-y-6">
            <!-- Consultation Box -->
            <div class="navy-card text-white p-6 rounded-lg shadow-md space-y-4">
                <h3 class="text-base font-bold flex items-center gap-2">
                    <i class="fa-solid fa-comments text-theme-green"></i> Expert CA Consultation
                </h3>
                <p class="text-xs text-gray-300 leading-relaxed">
                    Schedule a discussion with our Chartered Accountants to review your compliance, tax filings, or registrations.
                </p>
                <div class="pt-2 space-y-2 text-xs text-gray-300">
                    <p class="flex items-center gap-2">
                        <i class="fa-solid fa-phone text-theme-green"></i> {{ $siteSettings['contact_phone'] ?? '+91-7875037800' }}
                    </p>
                    <p class="flex items-center gap-2">
                        <i class="fa-solid fa-envelope text-theme-green"></i> {{ $siteSettings['contact_email'] ?? 'cajiteshtellsara@gmail.com' }}
                    </p>
                </div>
                <a href="{{ route('contact') }}" class="w-full bg-white text-blue-900 font-bold py-2.5 px-4 rounded text-center block text-xs hover:bg-gray-100 transition shadow">
                    Book a Free Consultation
                </a>
            </div>

            <!-- Other Services in this Category -->
            @php
                $relatedServices = \App\Models\Service::where('is_active', true)
                    ->where('category', $service->category)
                    ->where('id', '!=', $service->id)
                    ->take(6)
                    ->get();
            @endphp
            @if($relatedServices->isNotEmpty())
                <div class="bg-white p-6 rounded-lg border border-gray-200 shadow-sm space-y-3">
                    <h4 class="text-sm font-bold text-gray-800 border-b pb-2">Related Services</h4>
                    <ul class="space-y-2 text-xs text-gray-600">
                        @foreach($relatedServices as $rel)
                            <li>
                                <a href="{{ route('service.show', $rel->slug) }}" class="hover:text-green-600 transition flex items-center gap-2 py-1">
                                    <i class="fa-solid fa-caret-right text-[10px] text-gray-400"></i>
                                    <span>{{ $rel->title }}</span>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
