<!-- ========================================== -->
<!-- OUR SERVICES SECTION                       -->
<!-- ========================================== -->
<section class="mt-16 overflow-hidden reveal-on-scroll">
    <div class="text-center mb-10">
        <h2 class="text-3xl font-bold text-blue-900 uppercase tracking-wide">Our Services</h2>
        <div class="w-16 h-1 bg-theme-green mx-auto mt-3"></div>
    </div>
    
    <style>
        .hide-scroll-bar { -ms-overflow-style: none; scrollbar-width: none; }
        .hide-scroll-bar::-webkit-scrollbar { display: none; }
    </style>
    
    <div class="relative group">
        <!-- Left Arrow -->
        <button class="absolute -left-5 top-1/2 -translate-y-1/2 z-10 w-10 h-10 bg-white rounded-full shadow-md text-theme-green hover:bg-theme-green hover:text-white transition flex items-center justify-center opacity-0 group-hover:opacity-100 hidden md:flex" id="prevBtn-servicesCarousel" aria-label="Previous">
            <i class="fas fa-chevron-left"></i>
        </button>

        <div id="servicesCarousel" class="flex overflow-x-auto snap-x snap-mandatory gap-6 pb-8 hide-scroll-bar pt-4 px-2">
            <!-- Original Set -->
        @foreach($serviceCategories as $cat)
            <div class="service-card snap-start shrink-0 w-full md:w-[calc(50%-12px)] lg:w-[calc(33.333%-16px)] bg-white rounded-lg shadow-md border border-gray-100 hover:-translate-y-2 transition duration-300 flex flex-col h-full group overflow-hidden">
                @if($cat->image)
                    <div class="w-full h-48 overflow-hidden relative">
                        <img src="{{ \Illuminate\Support\Str::startsWith($cat->image, ['http://', 'https://']) ? $cat->image : Storage::url($cat->image) }}" class="w-full h-full object-cover group-hover:scale-110 transition duration-500" alt="{{ $cat->name }}">
                        <div class="absolute inset-0 bg-black bg-opacity-10 group-hover:bg-opacity-0 transition"></div>
                    </div>
                @elseif($cat->icon)
                    <div class="w-full h-48 bg-blue-50 flex items-center justify-center text-theme-green text-5xl group-hover:bg-theme-green group-hover:text-white transition duration-500">
                        <i class="{{ $cat->icon }}"></i>
                    </div>
                @else
                    <div class="w-full h-48 bg-blue-50 flex items-center justify-center text-theme-green text-4xl group-hover:bg-theme-green group-hover:text-white transition duration-500">
                        <i class="fas fa-briefcase"></i>
                    </div>
                @endif
                
                <div class="p-8 flex flex-col items-center text-center flex-grow">
                    <h3 class="text-xl font-bold text-blue-900 mb-3">{{ $cat->name }}</h3>
                    <p class="text-sm text-gray-500 mb-6 flex-grow">{{ Str::limit($cat->short_description ?? strip_tags($cat->description), 120) }}</p>
                    
                    <a href="{{ route('services.category', $cat->slug) }}" class="mt-auto block bg-blue-900 text-white font-bold py-2.5 px-6 rounded-full hover:bg-theme-green transition text-sm">
                        Read More
                    </a>
                </div>
            </div>
        @endforeach
        
        <!-- Duplicated Set for Seamless Infinite Scroll -->
        @foreach($serviceCategories as $cat)
            <div class="service-card snap-start shrink-0 w-full md:w-[calc(50%-12px)] lg:w-[calc(33.333%-16px)] bg-white rounded-lg shadow-md border border-gray-100 hover:-translate-y-2 transition duration-300 flex flex-col h-full group overflow-hidden" aria-hidden="true">
                @if($cat->image)
                    <div class="w-full h-48 overflow-hidden relative">
                        <img src="{{ \Illuminate\Support\Str::startsWith($cat->image, ['http://', 'https://']) ? $cat->image : Storage::url($cat->image) }}" class="w-full h-full object-cover group-hover:scale-110 transition duration-500" alt="{{ $cat->name }}">
                        <div class="absolute inset-0 bg-black bg-opacity-10 group-hover:bg-opacity-0 transition"></div>
                    </div>
                @else
                    <div class="w-full h-48 bg-blue-50 flex items-center justify-center text-theme-green text-4xl group-hover:bg-theme-green group-hover:text-white transition duration-500">
                        <i class="fas fa-briefcase"></i>
                    </div>
                @endif
                
                <div class="p-8 flex flex-col items-center text-center flex-grow">
                    <h3 class="text-xl font-bold text-blue-900 mb-3">{{ $cat->name }}</h3>
                    <p class="text-sm text-gray-500 mb-6 flex-grow">{{ Str::limit($cat->short_description ?? strip_tags($cat->description), 120) }}</p>
                    
                    <a href="{{ route('services.category', $cat->slug) }}" class="mt-auto block bg-blue-900 text-white font-bold py-2.5 px-6 rounded-full hover:bg-theme-green transition text-sm" tabindex="-1">
                        Read More
                    </a>
                </div>
            </div>
        @endforeach
        </div>

        <!-- Right Arrow -->
        <button class="absolute -right-5 top-1/2 -translate-y-1/2 z-10 w-10 h-10 bg-white rounded-full shadow-md text-theme-green hover:bg-theme-green hover:text-white transition flex items-center justify-center opacity-0 group-hover:opacity-100 hidden md:flex" id="nextBtn-servicesCarousel" aria-label="Next">
            <i class="fas fa-chevron-right"></i>
        </button>
    </div>
</section>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        if (window.servicesCarouselInitialized) return; // Prevent multiple bindings if component is included twice
        window.servicesCarouselInitialized = true;
        
        const carousel = document.getElementById('servicesCarousel');
        if(!carousel) return;
        
        let slideTimer;
        const totalOriginalItems = {{ $serviceCategories->count() }};
        
        function startAutoScroll() {
            slideTimer = setInterval(function() {
                scrollNext();
            }, 3000); // Scroll exactly 1 box every 3 seconds
        }

        function scrollNext() {
            const cards = carousel.querySelectorAll('.service-card');
            if (cards.length === 0) return;
            
            // Card width + gap (24px)
            const cardWidth = cards[0].offsetWidth + 24;
            const maxScroll = cardWidth * totalOriginalItems;
            
            // Smoothly scroll one box
            carousel.scrollBy({ left: cardWidth, behavior: 'smooth' });
            
            // Wait for the smooth scroll animation to finish (about 600ms)
            setTimeout(() => {
                // If we have scrolled completely through the original set, jump back to start instantly
                // The user won't notice because the duplicated set looks identical
                if (carousel.scrollLeft >= maxScroll - 10) {
                    carousel.scrollTo({ left: carousel.scrollLeft - maxScroll, behavior: 'instant' });
                }
            }, 600);
        }

        function scrollPrev() {
            const cards = carousel.querySelectorAll('.service-card');
            if (cards.length === 0) return;
            
            const cardWidth = cards[0].offsetWidth + 24;
            carousel.scrollBy({ left: -cardWidth, behavior: 'smooth' });
        }

        if (carousel.scrollWidth > carousel.clientWidth) {
            startAutoScroll();

            carousel.addEventListener('mouseenter', () => clearInterval(slideTimer));
            carousel.addEventListener('mouseleave', () => startAutoScroll());
            carousel.addEventListener('touchstart', () => clearInterval(slideTimer));
            carousel.addEventListener('touchend', () => startAutoScroll());

            const prevBtn = document.getElementById('prevBtn-servicesCarousel');
            const nextBtn = document.getElementById('nextBtn-servicesCarousel');
            
            if (prevBtn) {
                prevBtn.addEventListener('click', () => {
                    clearInterval(slideTimer);
                    scrollPrev();
                    startAutoScroll();
                });
                prevBtn.addEventListener('mouseenter', () => clearInterval(slideTimer));
            }
            
            if (nextBtn) {
                nextBtn.addEventListener('click', () => {
                    clearInterval(slideTimer);
                    scrollNext();
                    startAutoScroll();
                });
                nextBtn.addEventListener('mouseenter', () => clearInterval(slideTimer));
            }
        } else {
            const prevBtn = document.getElementById('prevBtn-servicesCarousel');
            const nextBtn = document.getElementById('nextBtn-servicesCarousel');
            if(prevBtn) prevBtn.style.display = 'none';
            if(nextBtn) nextBtn.style.display = 'none';
        }
    });
</script>
