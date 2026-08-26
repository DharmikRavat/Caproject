@extends('layouts.app')

@section('content')
<!-- Page Header -->
<section class="navy-bg text-white py-14 px-6 relative">
    <div class="max-w-7xl mx-auto text-center space-y-3">
        <span class="text-xs font-bold uppercase tracking-widest text-theme-green bg-green-950/60 px-3 py-1 rounded-full border border-green-500/30 inline-block">
            Our Services &amp; Practices
        </span>
        <h1 class="text-3xl md:text-4xl font-bold tracking-tight">Financial &amp; Compliance Solutions Designed For Growth</h1>
        <p class="text-sm text-gray-300 max-w-2xl mx-auto">
            Comprehensive Chartered Accountancy services spanning taxation, regulatory compliance, audits, corporate laws, and business registrations.
        </p>
    </div>
</section>

<!-- Category Filter Navigation -->
<div class="bg-gray-50 border-b border-gray-200 sticky top-[73px] z-30">
    <div class="max-w-7xl mx-auto px-6 py-3 flex items-center gap-2 overflow-x-auto text-xs font-semibold whitespace-nowrap scrollbar-none">
        <a href="{{ route('services') }}" class="px-4 py-2 rounded-full transition {{ !request()->filled('category') ? 'bg-blue-900 text-white' : 'bg-white text-gray-700 hover:bg-gray-100 border border-gray-300' }}">
            All Services
        </a>
        @foreach($serviceCategories as $catKey => $catName)
            <a href="{{ route('services') }}?category={{ urlencode($catKey) }}" class="px-4 py-2 rounded-full transition {{ request()->query('category') === $catKey ? 'bg-blue-900 text-white' : 'bg-white text-gray-700 hover:bg-gray-100 border border-gray-300' }}">
                {{ $catName }}
            </a>
        @endforeach
    </div>
</div>

<!-- Services Grid -->
<div class="max-w-7xl mx-auto px-6 py-12">
    @if(request()->filled('category'))
        <div class="mb-8 flex items-center justify-between border-b pb-4">
            <h2 class="text-2xl font-bold text-gray-800">
                {{ $serviceCategories[request()->query('category')] ?? \Illuminate\Support\Str::headline(request()->query('category')) }}
            </h2>
            <a href="{{ route('services') }}" class="text-xs font-bold text-theme-green hover:underline">
                View all categories &rarr;
            </a>
        </div>
    @endif

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($services as $service)
            <div class="bg-white rounded-lg border border-gray-200 shadow-sm hover:shadow-md transition flex flex-col justify-between p-6">
                <div class="space-y-3">
                    <div class="w-10 h-10 rounded-lg bg-blue-50 text-blue-900 flex items-center justify-center text-lg font-bold">
                        <i class="fa-solid fa-briefcase text-theme-green"></i>
                    </div>
                    <h3 class="text-lg font-bold text-gray-800">
                        {{ $service->title }}
                    </h3>
                    <p class="text-xs text-gray-600 leading-relaxed">
                        {{ Str::limit($service->short_description ?: $service->description, 130) }}
                    </p>
                </div>

                <div class="mt-6 pt-4 border-t border-gray-100 flex items-center justify-between">
                    <span class="text-[10px] font-bold uppercase text-gray-400">
                        {{ $serviceCategories[$service->category] ?? \Illuminate\Support\Str::headline($service->category) }}
                    </span>
                    <a href="{{ route('service.show', $service->slug) }}" class="text-xs font-bold text-blue-900 hover:text-green-600 transition flex items-center gap-1">
                        Read Details <i class="fa-solid fa-chevron-right text-[9px]"></i>
                    </a>
                </div>
            </div>
        @empty
            <div class="col-span-3 text-center py-12 text-gray-500">
                <p class="text-base">No services found in this category.</p>
                <a href="{{ route('services') }}" class="mt-3 inline-block bg-blue-900 text-white px-5 py-2 rounded text-xs font-bold">Show All Services</a>
            </div>
        @endforelse
    </div>
</div>
@endsection
