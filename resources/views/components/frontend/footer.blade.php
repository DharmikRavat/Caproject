    <!-- Footer -->
    <footer class="navy-bg text-white text-base pt-16 pb-10 px-6 mt-16">
        <div class="max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-4 gap-12 pb-10 border-b border-gray-600">
            <div>
                <h5 class="font-bold text-white uppercase mb-5 tracking-wider flex items-center gap-2">
                    About <span class="w-8 h-0.5 bg-gray-500 inline-block"></span>
                </h5>
                <p class="text-sm text-white leading-relaxed pr-4 text-justify mb-4" style="display: -webkit-box; -webkit-line-clamp: 7; -webkit-box-orient: vertical; overflow: hidden;">
                    {{ $siteSettings['footer_about_text'] ?? ($siteSettings['about_us_text'] ?? 'Jitesh Telisara & Associates LLP is a CA in Pune, a professionally managed firm catering to domestic and international clients with a wide range of services in domestic and international taxation, regulatory and advisory services, and cross-border transaction-related services.') }}
                </p>
            </div>

            <div>
                <h5 class="font-bold text-white uppercase mb-5 tracking-wider flex items-center gap-2">
                    Services <span class="w-8 h-0.5 bg-gray-500 inline-block"></span>
                </h5>
                <ul class="space-y-4 text-white text-sm">
                    @if(isset($globalServiceCategories))
                        @foreach($globalServiceCategories->take(7) as $category)
                            <li><a href="{{ route('services.category', $category->slug) }}" class="hover:text-gray-300 transition flex items-center"><i class="fa-solid fa-caret-right mr-3 text-xs text-gray-400"></i> {{ $category->name }}</a></li>
                        @endforeach
                    @endif
                </ul>
            </div>

            <div>
                <h5 class="font-bold text-white uppercase mb-5 tracking-wider flex items-center gap-2">
                    Quick Links <span class="w-8 h-0.5 bg-gray-500 inline-block"></span>
                </h5>
                <ul class="space-y-4 text-white text-sm">
                    <li><a href="{{ route('home') }}" class="hover:text-gray-300 transition flex items-center"><i class="fa-solid fa-caret-right mr-3 text-xs text-gray-400"></i> Home</a></li>
                    <li><a href="{{ route('about') }}" class="hover:text-gray-300 transition flex items-center"><i class="fa-solid fa-caret-right mr-3 text-xs text-gray-400"></i> About Us</a></li>
                    <li><a href="{{ route('blogs') }}" class="hover:text-gray-300 transition flex items-center"><i class="fa-solid fa-caret-right mr-3 text-xs text-gray-400"></i> Blogs</a></li>
                    <li><a href="{{ route('contact') }}" class="hover:text-gray-300 transition flex items-center"><i class="fa-solid fa-caret-right mr-3 text-xs text-gray-400"></i> Contact Us</a></li>
                    <li><a href="{{ route('links') }}" class="hover:text-gray-300 transition flex items-center"><i class="fa-solid fa-caret-right mr-3 text-xs text-gray-400"></i> Links</a></li>
                    <li><a href="{{ route('careers') }}" class="hover:text-gray-300 transition flex items-center"><i class="fa-solid fa-caret-right mr-3 text-xs text-gray-400"></i> Careers</a></li>
                </ul>
            </div>
            <div>
                <h5 class="font-bold text-white uppercase mb-5 tracking-wider flex items-center gap-2">
                    Head Office <span class="w-8 h-0.5 bg-gray-500 inline-block"></span>
                </h5>
                <div class="space-y-5 text-white text-sm">
                    <p class="flex items-start gap-4">
                        <i class="fa-solid fa-location-dot text-theme-green mt-1 text-base shrink-0"></i> 
                        <span>{{ $siteSettings['contact_address'] ?? '' }}</span>
                    </p>
                    <p class="flex items-center gap-4">
                        <i class="fa-solid fa-phone text-theme-green text-base shrink-0"></i> 
                        <a href="tel:{{ $siteSettings['contact_phone'] ?? '' }}" class="hover:text-gray-300 transition">{{ $siteSettings['contact_phone'] ?? '' }}</a>
                    </p>
                    <p class="flex items-center gap-4">
                        <i class="fa-solid fa-envelope text-theme-green text-base shrink-0"></i> 
                        <a href="mailto:{{ $siteSettings['contact_email'] ?? '' }}" class="hover:text-gray-300 transition">{{ $siteSettings['contact_email'] ?? '' }}</a>
                    </p>
                </div>
            </div>
        </div>
        <div class="max-w-7xl mx-auto flex flex-col sm:flex-row justify-between items-center gap-4 mt-6 text-xs text-white">
            <span>{{ $siteSettings['footer_copyright_text'] ?? '' }}</span>
        </div>
    </footer>
