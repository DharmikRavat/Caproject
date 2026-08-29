@if($items && $items->count() > 0)
<section class="mt-20 overflow-hidden bg-gray-50 py-16">
    <div class="max-w-7xl mx-auto px-6">
        @php
            $alignClass = isset($align) && $align === 'left' ? 'text-left' : 'text-center';
            $marginClass = isset($align) && $align === 'left' ? '' : 'mx-auto';
            $descClass = isset($align) && $align === 'left' ? 'max-w-full text-justify text-[15px] leading-relaxed' : 'max-w-4xl mx-auto text-base';
        @endphp
        <div class="{{ $alignClass }} mb-10">
            @if(isset($description))
                <h2 class="text-3xl font-bold text-blue-900 uppercase tracking-wide">{{ $title }}</h2>
                <div class="w-16 h-1 bg-theme-green {{ $marginClass }} mt-3 mb-6"></div>
                <p class="text-gray-600 {{ $descClass }}">{{ $description }}</p>
            @else
                <h2 class="text-3xl font-bold text-blue-900 uppercase tracking-wide">{{ $title }}</h2>
                <div class="w-16 h-1 bg-theme-green {{ $marginClass }} mt-3"></div>
            @endif
        </div>
        
        <style>
            .hide-scroll-bar { -ms-overflow-style: none; scrollbar-width: none; }
            .hide-scroll-bar::-webkit-scrollbar { display: none; }
        </style>
        
        <div class="relative group">
            <!-- Left Arrow -->
            <button class="absolute -left-5 top-1/2 -translate-y-1/2 z-10 w-10 h-10 bg-white rounded-full shadow-md text-gray-700 hover:bg-theme-green hover:text-white transition flex items-center justify-center opacity-0 group-hover:opacity-100 hidden md:flex" id="prevBtn-{{ $carouselId }}" aria-label="Previous">
                <i class="fas fa-chevron-left"></i>
            </button>
            
            <div id="{{ $carouselId }}" class="flex overflow-x-auto snap-x snap-mandatory gap-6 pb-8 hide-scroll-bar pt-4 px-2">
                <!-- Original Set -->
            @foreach($items as $item)
                @php
                    $isIndustry = $item instanceof \App\Models\Industry;
                    $itemImage = $isIndustry ? $item->image : $item->featured_image;
                    $itemUrl = $isIndustry ? 'javascript:void(0)' : route('services.show', ['category_slug' => $categorySlug ?? '', 'service_slug' => $item->slug]);
                    $isDark = ($theme ?? 'light') === 'dark';
                @endphp
                <div class="br-service-card snap-start shrink-0 w-[240px] md:w-[260px] {{ $isDark ? 'bg-[#1a2842] border-[#1a2842]' : 'bg-white border-gray-300' }} rounded-xl shadow-md border hover:shadow-xl hover:-translate-y-2 transition duration-300 flex flex-col h-full group overflow-hidden cursor-pointer p-3" onclick="window.location.href='{{ $itemUrl }}'">
                    @if($itemImage)
                        <div class="w-full h-[150px] overflow-hidden rounded-lg relative">
                            <img src="{{ \Illuminate\Support\Str::startsWith($itemImage, ['http://', 'https://']) ? $itemImage : Storage::url($itemImage) }}" class="w-full h-full object-cover group-hover:scale-110 transition duration-500" alt="{{ $item->name }}">
                        </div>
                    @elseif($item->icon)
                        <div class="w-full h-[150px] {{ $isDark ? 'bg-blue-50/10 text-white' : 'bg-blue-50 text-theme-green' }} rounded-lg flex items-center justify-center text-5xl group-hover:text-theme-green transition duration-500">
                            <i class="{{ $item->icon }}"></i>
                        </div>
                    @else
                        <div class="w-full h-[150px] {{ $isDark ? 'bg-blue-50/10 text-white' : 'bg-blue-50 text-theme-green' }} rounded-lg flex items-center justify-center text-5xl group-hover:text-theme-green transition duration-500">
                            <i class="fas fa-file-signature"></i>
                        </div>
                    @endif
                    
                    <div class="pt-4 pb-2 flex flex-col items-center justify-center text-center flex-grow">
                        <h3 class="text-sm md:text-base font-bold {{ $isDark ? 'text-white' : 'text-gray-800' }} group-hover:text-theme-green transition duration-300 leading-tight">{{ $item->name }}</h3>
                        @if($isIndustry && $item->description)
                            <p class="text-xs {{ $isDark ? 'text-gray-300' : 'text-gray-500' }} mt-2 line-clamp-2">{{ Str::limit($item->description, 60) }}</p>
                        @endif
                    </div>
                </div>
            @endforeach
            </div>
            
            <!-- Right Arrow -->
            <button class="absolute -right-5 top-1/2 -translate-y-1/2 z-10 w-10 h-10 bg-white rounded-full shadow-md text-gray-700 hover:bg-theme-green hover:text-white transition flex items-center justify-center opacity-0 group-hover:opacity-100 hidden md:flex" id="nextBtn-{{ $carouselId }}" aria-label="Next">
                <i class="fas fa-chevron-right"></i>
            </button>
        </div>
</section>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        (function() {
            const carousel = document.getElementById('{{ $carouselId }}');
            if (!carousel) return;
            
            let slideTimer;
            const originalTotalItems = {{ $items->count() }};
            
            function startAutoScroll(totalItems) {
                slideTimer = setInterval(function() {
                    scrollNext(totalItems);
                }, 3000); 
            }
            
            function scrollNext(totalItems) {
                const cards = carousel.querySelectorAll('.br-service-card');
                if (cards.length === 0) return;
                
                const cardWidth = cards[0].offsetWidth + 24; // Width + gap
                const maxScroll = cardWidth * totalItems;
                
                carousel.scrollBy({ left: cardWidth, behavior: 'smooth' });
                
                setTimeout(() => {
                    if (carousel.scrollLeft >= maxScroll - 10) {
                        carousel.scrollTo({ left: carousel.scrollLeft - maxScroll, behavior: 'instant' });
                    }
                }, 600);
            }
            
            function scrollPrev() {
                const cards = carousel.querySelectorAll('.br-service-card');
                if (cards.length === 0) return;
                
                const cardWidth = cards[0].offsetWidth + 24; 
                carousel.scrollBy({ left: -cardWidth, behavior: 'smooth' });
            }

            // Only initialize scrolling and cloning if content overflows the container
            if (carousel.scrollWidth > carousel.clientWidth) {
                // Clone the original items for seamless infinite scroll
                const originalCards = Array.from(carousel.querySelectorAll('.br-service-card'));
                originalCards.forEach(card => {
                    let clone = card.cloneNode(true);
                    clone.setAttribute('aria-hidden', 'true');
                    carousel.appendChild(clone);
                });

                startAutoScroll(originalTotalItems);

                carousel.addEventListener('mouseenter', () => clearInterval(slideTimer));
                carousel.addEventListener('mouseleave', () => startAutoScroll(originalTotalItems));
                carousel.addEventListener('touchstart', () => clearInterval(slideTimer));
                carousel.addEventListener('touchend', () => startAutoScroll(originalTotalItems));
                
                const prevBtn = document.getElementById('prevBtn-{{ $carouselId }}');
                const nextBtn = document.getElementById('nextBtn-{{ $carouselId }}');
                
                if (prevBtn) {
                    prevBtn.addEventListener('click', () => {
                        clearInterval(slideTimer);
                        scrollPrev();
                        startAutoScroll(originalTotalItems);
                    });
                    prevBtn.addEventListener('mouseenter', () => clearInterval(slideTimer));
                }
                
                if (nextBtn) {
                    nextBtn.addEventListener('click', () => {
                        clearInterval(slideTimer);
                        scrollNext(originalTotalItems);
                        startAutoScroll(originalTotalItems);
                    });
                    nextBtn.addEventListener('mouseenter', () => clearInterval(slideTimer));
                }
            } else {
                const prevBtn = document.getElementById('prevBtn-{{ $carouselId }}');
                const nextBtn = document.getElementById('nextBtn-{{ $carouselId }}');
                if(prevBtn) prevBtn.style.display = 'none';
                if(nextBtn) nextBtn.style.display = 'none';
            }
        })();
    });
</script>
@endif
