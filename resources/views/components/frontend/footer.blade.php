    <!-- Footer -->
    <footer class="navy-bg text-gray-300 text-xs pt-12 pb-6 px-6 mt-10">
        <div class="max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-4 gap-8 pb-8 border-b border-gray-600">
            <div>
                <h5 class="font-bold text-white uppercase mb-4 tracking-wider flex items-center gap-2">
                    About <span class="w-6 h-0.5 bg-gray-500 inline-block"></span>
                </h5>
                <p class="text-[11px] text-gray-400 leading-relaxed pr-4 text-justify mb-4">
                    {{ $siteSettings['footer_about_text'] ?? ($siteSettings['about_us_text'] ?? 'Jitesh Telisara & Associates LLP is a CA in Pune, a professionally managed firm catering to domestic and international clients with a wide range of services in domestic and international taxation, regulatory and advisory services, and cross-border transaction-related services.') }}
                </p>
                
                <!-- Social Links -->
                <div class="flex items-center gap-3 mt-4">
                    @if(!empty($siteSettings['facebook_link']))
                        <a href="{{ $siteSettings['facebook_link'] }}" target="_blank" class="w-8 h-8 rounded-full bg-blue-900/50 flex items-center justify-center text-gray-400 hover:bg-blue-600 hover:text-white transition">
                            <i class="fa-brands fa-facebook-f text-sm"></i>
                        </a>
                    @endif
                    @if(!empty($siteSettings['twitter_link']))
                        <a href="{{ $siteSettings['twitter_link'] }}" target="_blank" class="w-8 h-8 rounded-full bg-blue-900/50 flex items-center justify-center text-gray-400 hover:bg-sky-500 hover:text-white transition">
                            <i class="fa-brands fa-twitter text-sm"></i>
                        </a>
                    @endif
                    @if(!empty($siteSettings['linkedin_link']))
                        <a href="{{ $siteSettings['linkedin_link'] }}" target="_blank" class="w-8 h-8 rounded-full bg-blue-900/50 flex items-center justify-center text-gray-400 hover:bg-blue-700 hover:text-white transition">
                            <i class="fa-brands fa-linkedin-in text-sm"></i>
                        </a>
                    @endif
                </div>
            </div>

            <div>
                <h5 class="font-bold text-white uppercase mb-4 tracking-wider flex items-center gap-2">
                    Services <span class="w-6 h-0.5 bg-gray-500 inline-block"></span>
                </h5>
                <ul class="space-y-2 text-gray-400 text-[11px]">
                    @if(isset($globalServiceCategories))
                        @foreach($globalServiceCategories->take(7) as $category)
                            <li><a href="{{ route('services.category', $category->slug) }}" class="hover:text-white transition flex items-center"><i class="fa-solid fa-caret-right mr-1.5 text-[9px] text-gray-500"></i> {{ $category->name }}</a></li>
                        @endforeach
                    @endif
                </ul>
            </div>

            <div>
                <h5 class="font-bold text-white uppercase mb-4 tracking-wider flex items-center gap-2">
                    Quick Links <span class="w-6 h-0.5 bg-gray-500 inline-block"></span>
                </h5>
                <ul class="space-y-2 text-gray-400 text-[11px]">
                    <li><a href="{{ route('home') }}" class="hover:text-white transition flex items-center"><i class="fa-solid fa-caret-right mr-1.5 text-[9px] text-gray-500"></i> Home</a></li>
                    <li><a href="{{ route('about') }}" class="hover:text-white transition flex items-center"><i class="fa-solid fa-caret-right mr-1.5 text-[9px] text-gray-500"></i> About Us</a></li>
                    <li><a href="{{ route('blogs') }}" class="hover:text-white transition flex items-center"><i class="fa-solid fa-caret-right mr-1.5 text-[9px] text-gray-500"></i> Blogs</a></li>
                    <li><a href="{{ route('contact') }}" class="hover:text-white transition flex items-center"><i class="fa-solid fa-caret-right mr-1.5 text-[9px] text-gray-500"></i> Contact Us</a></li>
                    <li><a href="{{ route('links') }}" class="hover:text-white transition flex items-center"><i class="fa-solid fa-caret-right mr-1.5 text-[9px] text-gray-500"></i> Links</a></li>
                    <li><a href="{{ route('careers') }}" class="hover:text-white transition flex items-center"><i class="fa-solid fa-caret-right mr-1.5 text-[9px] text-gray-500"></i> Careers</a></li>
                </ul>
            </div>
            <div>
                <h5 class="font-bold text-white uppercase mb-4 tracking-wider flex items-center gap-2">
                    Head Office <span class="w-6 h-0.5 bg-gray-500 inline-block"></span>
                </h5>
                <div class="space-y-3 text-gray-400 text-[11px]">
                    <p class="flex items-start gap-2.5">
                        <i class="fa-solid fa-location-dot text-theme-green mt-1 text-xs shrink-0"></i> 
                        <span>{{ $siteSettings['contact_address'] ?? '' }}</span>
                    </p>
                    <p class="flex items-center gap-2.5">
                        <i class="fa-solid fa-phone text-theme-green text-xs shrink-0"></i> 
                        <a href="tel:{{ $siteSettings['contact_phone'] ?? '' }}" class="hover:text-white transition">{{ $siteSettings['contact_phone'] ?? '' }}</a>
                    </p>
                    <p class="flex items-center gap-2.5">
                        <i class="fa-solid fa-envelope text-theme-green text-xs shrink-0"></i> 
                        <a href="mailto:{{ $siteSettings['contact_email'] ?? '' }}" class="hover:text-white transition">{{ $siteSettings['contact_email'] ?? '' }}</a>
                    </p>
                </div>
            </div>
        </div>
        <div class="max-w-7xl mx-auto flex flex-col sm:flex-row justify-between items-center gap-4 mt-4 text-[10px] text-gray-400">
            <span>{{ $siteSettings['footer_copyright_text'] ?? '' }}</span>
            <a href="{{ route('contact') }}" class="bg-white text-blue-900 px-3.5 py-1.5 rounded-full font-bold shadow-md flex items-center gap-2 hover:bg-gray-100 transition">
                <span>Get In Touch</span> 
                <span class="bg-[#5c7ebb] text-white rounded-full w-5 h-5 flex items-center justify-center"><i class="fa-solid fa-comment-dots text-[9px]"></i></span>
            </a>
        </div>
    </footer>
