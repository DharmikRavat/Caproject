@if($items && $items->count() > 0)
<section class="mt-20 overflow-hidden bg-white py-16">
    <div class="max-w-7xl mx-auto px-6">
        <div class="text-center mb-10">
            <h2 class="text-3xl font-bold text-blue-900 uppercase tracking-wide">Happy Clients</h2>
            <div class="w-16 h-1 bg-theme-green mx-auto mt-3 mb-8"></div>
            
            <!-- Rating Summary -->
            <div class="flex flex-col items-center justify-center mb-6">
                <span class="text-lg font-bold text-gray-800 tracking-wider">EXCELLENT</span>
                <div class="flex text-yellow-400 text-2xl my-2">
                    @for($i = 0; $i < 5; $i++)
                        @if($i < floor($averageRating))
                            <i class="fas fa-star"></i>
                        @elseif($i < ceil($averageRating))
                            <i class="fas fa-star-half-alt"></i>
                        @else
                            <i class="far fa-star text-gray-300"></i>
                        @endif
                    @endfor
                </div>
                <span class="text-sm text-gray-600 font-medium">Based on {{ $totalReviews }} reviews</span>
                <div class="mt-2 text-xl font-bold">
                    <span class="text-blue-500">G</span><span class="text-red-500">o</span><span class="text-yellow-500">o</span><span class="text-blue-500">g</span><span class="text-green-500">l</span><span class="text-red-500">e</span>
                </div>
            </div>
        </div>
        
        <style>
            .hide-scroll-bar { -ms-overflow-style: none; scrollbar-width: none; }
            .hide-scroll-bar::-webkit-scrollbar { display: none; }
            
            /* Custom left/right buttons for desktop */
            .carousel-btn {
                position: absolute;
                top: 50%;
                transform: translateY(-50%);
                width: 40px;
                height: 40px;
                background-color: white;
                border-radius: 50%;
                box-shadow: 0 4px 6px rgba(0,0,0,0.1);
                display: flex;
                align-items: center;
                justify-content: center;
                cursor: pointer;
                z-index: 10;
                color: #333;
                transition: all 0.3s ease;
            }
            .carousel-btn:hover {
                background-color: #f3f4f6;
                color: #000;
            }
            .carousel-btn-prev { left: -20px; }
            .carousel-btn-next { right: -20px; }
            
            @media(max-width: 768px) {
                .carousel-btn { display: none; }
            }
        </style>
        
        <div class="relative">
            <!-- Left Arrow -->
            <button id="testiPrevBtn" class="carousel-btn carousel-btn-prev" aria-label="Previous client reviews">
                <i class="fas fa-chevron-left"></i>
            </button>
            
            <div id="testimonialCarousel" class="flex overflow-x-auto snap-x snap-mandatory gap-6 pb-8 hide-scroll-bar pt-4 px-2">
                <!-- Original Set -->
                @foreach($items as $item)
                    <div class="testimonial-card snap-start shrink-0 w-[300px] md:w-[350px] bg-white rounded-xl shadow-[0_2px_15px_-3px_rgba(0,0,0,0.07),0_10px_20px_-2px_rgba(0,0,0,0.04)] border border-gray-100 hover:-translate-y-1 transition duration-300 flex flex-col h-full group p-6 relative">
                        
                        <div class="flex items-center justify-between mb-4">
                            <div class="flex items-center space-x-3">
                                @if($item->author_image)
                                    <img src="{{ Storage::url($item->author_image) }}" alt="{{ $item->author }}" class="w-12 h-12 rounded-full object-cover">
                                @else
                                    <div class="w-12 h-12 rounded-full bg-blue-100 text-blue-800 flex items-center justify-center font-bold text-lg">
                                        {{ substr($item->author, 0, 1) }}
                                    </div>
                                @endif
                                <div>
                                    <h4 class="font-bold text-gray-800 leading-tight">{{ $item->author }}</h4>
                                    @if($item->review_date)
                                        <span class="text-xs text-gray-500">{{ \Carbon\Carbon::parse($item->review_date)->diffForHumans() }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="text-xl font-bold opacity-70">
                                @if(strtolower($item->source) === 'google')
                                    <span class="text-blue-500 text-base"><i class="fab fa-google"></i></span>
                                @else
                                    <span class="text-gray-400 text-sm"><i class="fas fa-quote-right"></i></span>
                                @endif
                            </div>
                        </div>
                        
                        <div class="flex text-yellow-400 text-sm mb-3">
                            @for($i=1; $i<=5; $i++)
                                @if($i <= $item->rating)
                                    <i class="fas fa-star"></i>
                                @else
                                    <i class="far fa-star text-gray-300"></i>
                                @endif
                            @endfor
                        </div>
                        
                        <div class="text-gray-600 text-sm leading-relaxed flex-grow">
                            @if(strlen($item->content) > 120)
                                <span class="review-preview">{{ Str::limit($item->content, 120) }}</span>
                                <span class="review-full hidden">{{ $item->content }}</span>
                                <button type="button" class="read-more-btn text-blue-600 font-semibold hover:underline block mt-2 text-xs">Read more</button>
                            @else
                                {{ $item->content }}
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
            
            <!-- Right Arrow -->
            <button id="testiNextBtn" class="carousel-btn carousel-btn-next" aria-label="Next client reviews">
                <i class="fas fa-chevron-right"></i>
            </button>
        </div>
    </div>
</section>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Read More Logic
        document.querySelectorAll('.read-more-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                const parent = this.parentElement;
                const preview = parent.querySelector('.review-preview');
                const full = parent.querySelector('.review-full');
                
                if (full.classList.contains('hidden')) {
                    full.classList.remove('hidden');
                    preview.classList.add('hidden');
                    this.innerText = 'Read less';
                } else {
                    full.classList.add('hidden');
                    preview.classList.remove('hidden');
                    this.innerText = 'Read more';
                }
            });
        });

        // Carousel Auto-scroll Logic
        (function() {
            const carousel = document.getElementById('testimonialCarousel');
            if (!carousel) return;
            
            let slideTimer;
            const originalTotalItems = {{ $items->count() }};
            
            function startAutoScroll(totalItems) {
                slideTimer = setInterval(function() {
                    scrollNext(totalItems);
                }, 3500); 
            }

            function scrollNext(totalItems) {
                const cards = carousel.querySelectorAll('.testimonial-card');
                if (cards.length === 0) return;
                
                const cardWidth = cards[0].offsetWidth + 24; 
                const maxScroll = cardWidth * totalItems;
                
                carousel.scrollBy({ left: cardWidth, behavior: 'smooth' });
                
                setTimeout(() => {
                    if (carousel.scrollLeft >= maxScroll - 10) {
                        carousel.scrollTo({ left: carousel.scrollLeft - maxScroll, behavior: 'instant' });
                    }
                }, 600);
            }

            function scrollPrev() {
                const cards = carousel.querySelectorAll('.testimonial-card');
                if (cards.length === 0) return;
                
                const cardWidth = cards[0].offsetWidth + 24; 
                carousel.scrollBy({ left: -cardWidth, behavior: 'smooth' });
            }

            // Only initialize scrolling and cloning if content overflows the container
            if (carousel.scrollWidth > carousel.clientWidth) {
                // Clone the original items for seamless infinite scroll
                const originalCards = Array.from(carousel.querySelectorAll('.testimonial-card'));
                originalCards.forEach(card => {
                    let clone = card.cloneNode(true);
                    clone.setAttribute('aria-hidden', 'true');
                    
                    // Reattach read more listeners to clones
                    const btn = clone.querySelector('.read-more-btn');
                    if (btn) {
                        btn.addEventListener('click', function() {
                            const parent = this.parentElement;
                            const preview = parent.querySelector('.review-preview');
                            const full = parent.querySelector('.review-full');
                            if (full.classList.contains('hidden')) {
                                full.classList.remove('hidden');
                                preview.classList.add('hidden');
                                this.innerText = 'Read less';
                            } else {
                                full.classList.add('hidden');
                                preview.classList.remove('hidden');
                                this.innerText = 'Read more';
                            }
                        });
                    }
                    
                    carousel.appendChild(clone);
                });

                startAutoScroll(originalTotalItems);

                // Hover pause
                carousel.addEventListener('mouseenter', () => clearInterval(slideTimer));
                carousel.addEventListener('mouseleave', () => startAutoScroll(originalTotalItems));
                carousel.addEventListener('touchstart', () => clearInterval(slideTimer));
                carousel.addEventListener('touchend', () => startAutoScroll(originalTotalItems));
                
                // Manual Navigation
                const prevBtn = document.getElementById('testiPrevBtn');
                const nextBtn = document.getElementById('testiNextBtn');
                
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
                // Hide arrows if no scrolling needed
                document.getElementById('testiPrevBtn')?.classList.add('hidden');
                document.getElementById('testiNextBtn')?.classList.add('hidden');
            }
        })();
    });
</script>
@endif
