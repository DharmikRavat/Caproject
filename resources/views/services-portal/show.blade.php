@extends('layouts.app')

@section('content')
<!-- Breadcrumb -->
<div class="bg-gray-100 border-b border-gray-200">
    <div class="max-w-7xl mx-auto px-6 py-4 flex items-center text-sm font-semibold text-gray-500">
        <a href="{{ route('home') }}" class="hover:text-blue-900 transition"><i class="fas fa-home"></i></a>
        <i class="fas fa-chevron-right text-xs mx-2"></i>
        <a href="{{ route('services.index') }}" class="hover:text-blue-900 transition">Services</a>
        <i class="fas fa-chevron-right text-xs mx-2"></i>
        <a href="{{ route('services.category', $category->slug) }}" class="hover:text-blue-900 transition">{{ $category->name }}</a>
        <i class="fas fa-chevron-right text-xs mx-2"></i>
        <span class="text-theme-green">{{ $service->name }}</span>
    </div>
</div>

@php
    $bgImage = 'https://images.unsplash.com/photo-1556761175-5973dc0f32e7?auto=format&fit=crop&w=1600&q=80'; // Default placeholder

    if ($service->header_image) {
        $bgImage = \Illuminate\Support\Str::startsWith($service->header_image, ['http://', 'https://']) ? $service->header_image : Storage::url($service->header_image);
    } elseif ($service->featured_image) {
        $bgImage = \Illuminate\Support\Str::startsWith($service->featured_image, ['http://', 'https://']) ? $service->featured_image : Storage::url($service->featured_image);
    } elseif ($category->header_image) {
        $bgImage = \Illuminate\Support\Str::startsWith($category->header_image, ['http://', 'https://']) ? $category->header_image : Storage::url($category->header_image);
    }
@endphp

<!-- Service Hero -->
<div class="py-24 text-white relative bg-cover bg-center shadow-inner" style="background-image: url('{{ $bgImage }}');">
    <div class="absolute inset-0 bg-black bg-opacity-60"></div>
    <div class="max-w-7xl mx-auto px-6 relative z-10 flex flex-col md:flex-row gap-12 items-center">
        <div class="flex-1 text-center md:text-left">
            <h1 class="text-4xl font-extrabold uppercase tracking-tight mb-4 text-theme-green">{{ $service->name }}</h1>
            @if($service->short_description)
                <p class="text-blue-100 text-lg mb-6 leading-relaxed max-w-3xl">{{ $service->short_description }}</p>
            @endif
            <div class="flex gap-4 mt-8 justify-center md:justify-start">
                <a href="{{ route('contact') }}" class="bg-theme-green text-white font-bold py-3 px-8 rounded hover:bg-green-600 transition shadow-lg inline-block uppercase text-sm">Enquire Now</a>
            </div>
        </div>
    </div>
</div>

<div class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-6 flex flex-col lg:flex-row gap-12">
        
        <!-- Main Content -->
        <div class="lg:w-2/3">
            @if($service->description)
                <div class="prose max-w-none text-gray-600 mb-12">
                    {!! $service->description !!}
                </div>
            @endif

            <!-- Dynamic Sections -->
            @foreach($service->sections as $section)
                <div class="mb-12">
                    @if($section->title)
                        <h2 class="text-2xl font-bold text-blue-900 mb-4 border-b pb-2">{{ $section->title }}</h2>
                    @endif
                    @if($section->subtitle)
                        <h3 class="text-lg font-semibold text-gray-700 mb-3">{{ $section->subtitle }}</h3>
                    @endif
                    <div class="prose max-w-none text-gray-600">
                        {!! $section->content !!}
                    </div>
                </div>
            @endforeach

            <!-- Process Steps -->
            @if($service->processSteps->count() > 0)
                <div class="mb-12">
                    <h2 class="text-2xl font-bold text-blue-900 mb-6 border-b pb-2">Process / Procedure</h2>
                    <div class="space-y-6 relative before:absolute before:inset-0 before:ml-5 before:-translate-x-px md:before:mx-auto md:before:translate-x-0 before:h-full before:w-0.5 before:bg-gradient-to-b before:from-transparent before:via-gray-300 before:to-transparent">
                        @foreach($service->processSteps as $index => $step)
                            <div class="relative flex items-center justify-between md:justify-normal md:odd:flex-row-reverse group is-active">
                                <div class="flex items-center justify-center w-10 h-10 rounded-full border-4 border-white bg-theme-green text-white font-bold shadow shrink-0 md:order-1 md:group-odd:-translate-x-1/2 md:group-even:translate-x-1/2 relative z-10">
                                    {{ $index + 1 }}
                                </div>
                                <div class="w-[calc(100%-4rem)] md:w-[calc(50%-2.5rem)] bg-white p-5 rounded border border-gray-100 shadow-sm">
                                    <h4 class="font-bold text-gray-800 text-lg mb-1">{{ $step->title }}</h4>
                                    <p class="text-sm text-gray-500">{{ $step->description }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            <!-- FAQs -->
            @if($service->faqs->count() > 0)
                <div class="mb-12" x-data="{ activeFaq: null }">
                    <h2 class="text-2xl font-bold text-blue-900 mb-6 border-b pb-2">Frequently Asked Questions</h2>
                    <div class="space-y-4">
                        @foreach($service->faqs as $faq)
                            <div class="border border-gray-200 rounded bg-white overflow-hidden">
                                <button @click="activeFaq = activeFaq === {{ $faq->id }} ? null : {{ $faq->id }}" class="w-full flex justify-between items-center p-4 text-left font-bold text-gray-800 hover:bg-gray-50 focus:outline-none">
                                    <span>{{ $faq->question }}</span>
                                    <i class="fas fa-chevron-down text-theme-green transition-transform" :class="activeFaq === {{ $faq->id }} ? 'rotate-180' : ''"></i>
                                </button>
                                <div x-show="activeFaq === {{ $faq->id }}" x-collapse class="p-4 border-t border-gray-100 text-gray-600 text-sm bg-gray-50 prose max-w-none">
                                    {!! $faq->answer !!}
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>

        <!-- Sidebar -->
        <div class="lg:w-1/3 space-y-8">
            <!-- Documents Required -->
            @if($service->documents->count() > 0)
                <div class="bg-gray-50 rounded-lg p-6 border border-gray-200">
                    <h3 class="text-xl font-bold text-blue-900 mb-4 flex items-center"><i class="fas fa-file-invoice text-theme-green mr-2"></i> Documents Required</h3>
                    <ul class="space-y-3">
                        @foreach($service->documents as $doc)
                            <li class="flex items-start text-sm text-gray-600">
                                <i class="fas fa-check-circle text-theme-green mt-1 mr-3"></i>
                                <div>
                                    <strong class="text-gray-800 block">{{ $doc->title }}</strong>
                                    @if($doc->description)
                                        <span class="text-xs text-gray-500">{{ $doc->description }}</span>
                                    @endif
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endif

        </div>
        
    </div>
</div>
@endsection
