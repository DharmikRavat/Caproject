<header x-data="{ mobileOpen: false, servicesOpen: false, activeCat: null }">
    <!-- Top Navy Bar -->
    <div class="navy-bg text-white text-[11px] py-2 px-6">
        <div class="max-w-7xl mx-auto flex justify-between items-center">
            <div class="flex flex-wrap items-center gap-6">
                <a href="mailto:{{ $siteSettings['contact_email'] ?? 'cajiteshtellsara@gmail.com' }}" class="flex items-center gap-1.5 hover:text-green-300 transition">
                    <i class="fa-solid fa-envelope text-theme-green"></i> 
                    <span>{{ $siteSettings['contact_email'] ?? 'cajiteshtellsara@gmail.com' }}</span>
                </a>
                <a href="tel:{{ $siteSettings['contact_phone'] ?? '+917875037800' }}" class="flex items-center gap-1.5 hover:text-green-300 transition">
                    <i class="fa-solid fa-phone text-theme-green"></i> 
                    <span>{{ $siteSettings['contact_phone'] ?? '+91-7875037800' }}</span>
                </a>
            </div>
            <div class="hidden sm:flex items-center space-x-3 text-[10px] text-gray-300">
                <span>Office: Mon - Sat (9:30 AM - 6:30 PM)</span>
            </div>
        </div>
    </div>
    
    <!-- Main Sticky Navbar -->
    <nav class="bg-white shadow-sm border-b sticky top-0 z-40">
        <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
            <!-- Brand Logo -->
            <a href="{{ route('home') }}" class="flex items-center space-x-3 group">
                <div class="border-2 border-blue-900 text-blue-900 font-extrabold px-2 py-0.5 rounded text-xl font-serif tracking-tighter group-hover:bg-blue-900 group-hover:text-white transition">
                    CA
                </div>
                <div class="leading-tight">
                    <div class="font-bold text-blue-900 text-[13px] tracking-wide uppercase">JITESH TELLSARA &amp; ASSOCIATES LLP</div>
                    <div class="text-[11px] text-theme-green font-bold uppercase tracking-wider">Chartered Accountants</div>
                </div>
            </a>

            <!-- Desktop Nav Items -->
            <div class="hidden md:flex space-x-6 text-[11px] font-bold uppercase text-gray-700 items-center">
                <a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'text-theme-green font-extrabold border-b-2 border-theme-green pb-1' : 'hover:text-green-600 transition' }}">Home</a>
                
                <!-- Services Multi-Level Dropdown -->
                <div class="relative group" @mouseenter="servicesOpen = true" @mouseleave="servicesOpen = false; activeCat = null">
                    <a href="{{ route('services') }}" class="hover:text-green-600 transition flex items-center gap-1 py-1 {{ request()->routeIs('services', 'service.show') ? 'text-theme-green border-b-2 border-theme-green' : '' }}">
                        Services <i class="fa-solid fa-caret-down text-[10px]"></i>
                    </a>
                    
                    <!-- Main Dropdown Box -->
                    <div x-show="servicesOpen" x-transition.opacity.duration.150ms class="absolute top-full left-0 w-72 bg-[#1a3251] shadow-2xl rounded-b-md py-2 z-50 text-white text-[12px] font-medium uppercase">
                        @foreach($headerServices as $categoryKey => $catServices)
                            <div class="relative group/sub" @mouseenter="activeCat = '{{ $categoryKey }}'">
                                <a href="{{ route('services') }}?category={{ urlencode($categoryKey) }}" class="flex items-center justify-between px-4 py-2.5 hover:bg-[#1f375d] hover:text-green-400 transition border-b border-gray-700/40 last:border-0">
                                    <span class="truncate">{{ $serviceCategories[$categoryKey] ?? \Illuminate\Support\Str::headline($categoryKey) }}</span>
                                    <i class="fa-solid fa-chevron-right text-[9px] text-gray-400"></i>
                                </a>

                                <!-- Sub-menu Flyout for Individual Services -->
                                <div x-show="activeCat === '{{ $categoryKey }}'" x-transition.opacity.duration.100ms class="absolute left-full top-0 w-80 bg-[#15273e] shadow-2xl rounded-md py-2 text-[11px] font-normal border border-gray-700/60 max-h-[420px] overflow-y-auto z-50">
                                    <div class="px-4 py-1.5 font-bold text-[10px] text-green-400 tracking-wider border-b border-gray-700/60 mb-1">
                                        {{ $serviceCategories[$categoryKey] ?? \Illuminate\Support\Str::headline($categoryKey) }}
                                    </div>
                                    @foreach($catServices as $srv)
                                        <a href="{{ route('service.show', $srv->slug) }}" class="block px-4 py-1.5 text-gray-200 hover:bg-[#1f375d] hover:text-green-300 transition truncate capitalize">
                                            {{ $srv->title }}
                                        </a>
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <a href="{{ route('about') }}" class="{{ request()->routeIs('about') ? 'text-theme-green font-extrabold border-b-2 border-theme-green pb-1' : 'hover:text-green-600 transition' }}">About Us</a>
                <a href="{{ route('blogs') }}" class="{{ request()->routeIs('blogs', 'blog.show') ? 'text-theme-green font-extrabold border-b-2 border-theme-green pb-1' : 'hover:text-green-600 transition' }}">Blogs</a>
                <a href="{{ route('careers') }}" class="{{ request()->routeIs('careers', 'career.show') ? 'text-theme-green font-extrabold border-b-2 border-theme-green pb-1' : 'hover:text-green-600 transition' }}">Career</a>
                <a href="{{ route('links') }}" class="{{ request()->routeIs('links') ? 'text-theme-green font-extrabold border-b-2 border-theme-green pb-1' : 'hover:text-green-600 transition' }}">Links</a>
                <a href="{{ route('contact') }}" class="{{ request()->routeIs('contact') ? 'text-theme-green font-extrabold border-b-2 border-theme-green pb-1' : 'hover:text-green-600 transition' }}">Contact Us</a>
            </div>

            <!-- Mobile Hamburger Button -->
            <button @click="mobileOpen = !mobileOpen" class="md:hidden text-gray-700 hover:text-blue-900 focus:outline-none p-2">
                <i class="fa-solid" :class="mobileOpen ? 'fa-xmark text-2xl' : 'fa-bars text-xl'"></i>
            </button>
        </div>

        <!-- Mobile Menu -->
        <div x-show="mobileOpen" x-cloak class="md:hidden bg-white border-t px-6 py-4 space-y-3 text-xs font-bold uppercase text-gray-700 shadow-lg">
            <a href="{{ route('home') }}" class="block py-2 {{ request()->routeIs('home') ? 'text-theme-green' : 'hover:text-green-600' }}">Home</a>
            
            <div x-data="{ mServicesOpen: false }">
                <button @click="mServicesOpen = !mServicesOpen" class="w-full flex items-center justify-between py-2 {{ request()->routeIs('services', 'service.show') ? 'text-theme-green' : 'hover:text-green-600' }}">
                    <span>Services</span>
                    <i class="fa-solid text-[10px]" :class="mServicesOpen ? 'fa-chevron-up' : 'fa-chevron-down'"></i>
                </button>
                <div x-show="mServicesOpen" x-cloak class="pl-3 border-l-2 border-green-500 space-y-2 py-2">
                    @foreach($headerServices as $categoryKey => $catServices)
                        <div x-data="{ subOpen: false }">
                            <button @click="subOpen = !subOpen" class="w-full flex items-center justify-between py-1 text-[11px] text-gray-600 hover:text-green-600">
                                <span>{{ $serviceCategories[$categoryKey] ?? \Illuminate\Support\Str::headline($categoryKey) }}</span>
                                <i class="fa-solid text-[8px]" :class="subOpen ? 'fa-chevron-up' : 'fa-chevron-down'"></i>
                            </button>
                            <div x-show="subOpen" x-cloak class="pl-2 space-y-1 py-1">
                                @foreach($catServices as $srv)
                                    <a href="{{ route('service.show', $srv->slug) }}" class="block py-1 text-[10px] text-gray-500 hover:text-green-600 font-normal">
                                        {{ $srv->title }}
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <a href="{{ route('about') }}" class="block py-2 {{ request()->routeIs('about') ? 'text-theme-green' : 'hover:text-green-600' }}">About Us</a>
            <a href="{{ route('blogs') }}" class="block py-2 {{ request()->routeIs('blogs') ? 'text-theme-green' : 'hover:text-green-600' }}">Blogs</a>
            <a href="{{ route('careers') }}" class="block py-2 {{ request()->routeIs('careers') ? 'text-theme-green' : 'hover:text-green-600' }}">Career</a>
            <a href="{{ route('links') }}" class="block py-2 {{ request()->routeIs('links') ? 'text-theme-green' : 'hover:text-green-600' }}">Links</a>
            <a href="{{ route('contact') }}" class="block py-2 {{ request()->routeIs('contact') ? 'text-theme-green' : 'hover:text-green-600' }}">Contact Us</a>
        </div>
    </nav>
</header>
