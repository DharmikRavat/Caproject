@extends('layouts.app')

@section('content')
<div class="bg-gray-50 py-12">
    <div class="max-w-7xl mx-auto px-6">
        <div class="text-center mb-12">
            <h1 class="text-4xl font-extrabold text-blue-900 mb-4 uppercase tracking-tight">Our Services</h1>
            <p class="text-gray-600 max-w-2xl mx-auto text-lg">Comprehensive financial, taxation, and business advisory services tailored to your specific needs.</p>
        </div>

        <div class="space-y-16">
            @forelse($categories as $cat)
                @php
                    $catImage = $cat->image 
                        ? (\Illuminate\Support\Str::startsWith($cat->image, ['http://', 'https://']) ? $cat->image : Storage::url($cat->image))
                        : 'https://images.unsplash.com/photo-1454165804606-c3d57bc86b40?auto=format&fit=crop&w=800&q=80';
                @endphp
                
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                    <!-- Main Category Header -->
                    <div class="flex flex-col md:flex-row items-center gap-6 p-6 border-b border-gray-100 bg-gray-50">
                        <div class="w-full md:w-32 h-32 shrink-0 rounded-lg overflow-hidden shadow-sm">
                            <img src="{{ $catImage }}" alt="{{ $cat->name }}" class="w-full h-full object-cover">
                        </div>
                        <div class="flex-grow text-center md:text-left">
                            <h2 class="text-3xl font-extrabold text-blue-900 mb-2">{{ $cat->name }}</h2>
                            <p class="text-gray-600 max-w-3xl">{{ Str::limit($cat->short_description ?? strip_tags($cat->description), 150) }}</p>
                        </div>
                        <div class="shrink-0 mt-4 md:mt-0">
                            <a href="{{ route('services.category', $cat->slug) }}" class="inline-block bg-blue-900 text-white font-bold py-2.5 px-6 rounded-full hover:bg-theme-green transition whitespace-nowrap shadow-sm">
                                View Category
                            </a>
                        </div>
                    </div>

                    <!-- Services Grid -->
                    <div class="p-6">
                        @if($cat->services->count() > 0)
                            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                                @foreach($cat->services as $service)
                                    <a href="{{ route('services.show', ['category_slug' => $cat->slug, 'service_slug' => $service->slug]) }}" class="bg-gray-50 rounded-lg border border-gray-200 p-5 hover:shadow-md hover:border-theme-green transition group flex flex-col h-full">
                                        <h3 class="text-lg font-bold text-gray-800 group-hover:text-theme-green mb-3 leading-tight">{{ $service->name }}</h3>
                                        <p class="text-sm text-gray-500 flex-grow">{{ Str::limit($service->short_description ?? strip_tags($service->description), 80) }}</p>
                                        <div class="mt-4 text-theme-green text-sm font-semibold flex items-center">
                                            Read More <i class="fas fa-chevron-right ml-1 text-xs transition-transform group-hover:translate-x-1"></i>
                                        </div>
                                    </a>
                                @endforeach
                            </div>
                        @else
                            <p class="text-gray-500 italic">No specific services added to this category yet.</p>
                        @endif
                    </div>
                </div>
            @empty
                <div class="text-center text-gray-500 py-12">
                    <p>No main categories found at the moment.</p>
                </div>
            @endforelse
        </div>
    </div>
</div>
@endsection
