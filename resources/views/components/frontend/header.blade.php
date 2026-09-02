<header x-data="{ mobileOpen: false, servicesOpen: false, activeCat: null }" class="sticky top-0 z-50 w-full">
    <!-- Top Navy Bar -->
    <div class="navy-bg text-white text-sm py-2 px-6">
        <div class="max-w-7xl mx-auto flex flex-col sm:flex-row justify-between items-center gap-2">
            <div class="flex flex-wrap justify-center sm:justify-start items-center gap-4 sm:gap-6 text-xs sm:text-sm">
                <a href="mailto:{{ $siteSettings['contact_email'] ?? '' }}" class="flex items-center gap-1.5 hover:text-green-300 transition">
                    <i class="fa-solid fa-envelope text-theme-green"></i> 
                    <span>{{ $siteSettings['contact_email'] ?? '' }}</span>
                </a>
                <a href="tel:{{ $siteSettings['contact_phone'] ?? '' }}" class="flex items-center gap-1.5 hover:text-green-300 transition">
                    <i class="fa-solid fa-phone text-theme-green"></i> 
                    <span>{{ $siteSettings['contact_phone'] ?? '' }}</span>
                </a>
            </div>
            <div class="hidden md:flex items-center space-x-3 text-xs text-gray-300">
                <span>{{ $siteSettings['header_office_timing'] ?? '' }}</span>
            </div>
        </div>
    </div>
    
    <!-- Main Sticky Navbar -->
    <nav class="bg-white shadow-sm border-b">
        <div class="max-w-7xl mx-auto px-6 py-6 flex justify-between items-center">
            <!-- Brand Logo -->
            <a href="{{ route('home') }}" class="flex items-center space-x-4 group">
                @if(isset($siteSettings['site_logo']) && $siteSettings['site_logo'])
                    <img src="{{ Storage::url($siteSettings['site_logo']) }}" alt="Site Logo" class="h-14 md:h-16 object-contain">
                @else
                    <div class="border-2 border-blue-900 text-blue-900 font-extrabold px-4 py-2 rounded text-4xl font-serif tracking-tighter group-hover:bg-blue-900 group-hover:text-white transition">
                        CA
                    </div>
                    <div class="leading-tight">
                        <div class="font-bold text-blue-900 text-lg tracking-wide uppercase">{{ $siteSettings['site_name'] ?? 'JITESH TELISARA & ASSOCIATES LLP' }}</div>
                        <div class="text-base text-theme-green font-bold uppercase tracking-wider">{{ $siteSettings['site_tagline'] ?? 'Chartered Accountants' }}</div>
                    </div>
                @endif
            </a>

            <!-- Desktop Nav Items -->
            <div class="hidden md:flex space-x-8 text-base font-bold uppercase text-gray-700 items-center">
                <a href="{{ route('home') }}" class="hover:text-green-600 transition">Home</a>
                <!-- Services Mega Menu -->
                <div class="relative group" @mouseenter="servicesOpen = true" @mouseleave="servicesOpen = false">
                    <a href="{{ route('services.index') }}" class="flex items-center gap-1 hover:text-green-600 transition">
                        Services <i class="fa-solid fa-chevron-down text-[10px] ml-0.5 transition-transform duration-300" :class="servicesOpen ? 'rotate-180 text-theme-green' : ''"></i>
                    </a>
                    
                    <!-- Mega Menu Dropdown -->
                    <div x-show="servicesOpen" 
                         x-transition:enter="transition ease-out duration-200" 
                         x-transition:enter-start="opacity-0 translate-y-2" 
                         x-transition:enter-end="opacity-100 translate-y-0"
                         x-transition:leave="transition ease-in duration-150"
                         x-transition:leave-start="opacity-100 translate-y-0"
                         x-transition:leave-end="opacity-0 translate-y-2"
                         class="absolute top-full left-0 w-[360px] pt-4 z-50" 
                         style="display: none;"
                         @mouseenter="servicesOpen = true" 
                         @mouseleave="servicesOpen = false"
                         x-init="activeCat = null">
                        
                        <div class="bg-[#1a2533] shadow-2xl border-t-4 border-theme-green relative">
                            @if(isset($globalServiceCategories))
                                @foreach($globalServiceCategories as $category)
                                    <!-- Category Row -->
                                    <div class="relative w-full" @mouseenter="activeCat = {{ $category->id }}">
                                        <!-- Left Side Item -->
                                        <div class="px-6 py-3 cursor-pointer transition-colors flex items-center justify-between border-b border-gray-600/20"
                                             :class="activeCat === {{ $category->id }} ? 'bg-[#22c55e] text-white' : 'text-gray-200 hover:bg-[#233142]'">
                                            <a href="{{ route('services.category', $category->slug) }}" class="font-normal block text-[15px] leading-tight w-full">{{ $category->name }}</a>
                                            <i class="fa-solid fa-caret-right text-xs opacity-70" x-show="activeCat === {{ $category->id }}"></i>
                                        </div>
                                        
                                        <!-- Right Side (Services for THIS category) -->
                                        <div x-show="activeCat === {{ $category->id }}" 
                                             class="absolute left-full top-0 w-[440px] bg-[#1a2533] shadow-2xl z-50 border-l border-[#22c55e]/50"
                                             style="display: none;">
                                            @if($category->services->count() > 0)
                                                <div class="flex flex-col">
                                                    @foreach($category->services as $service)
                                                        <a href="{{ route('services.show', ['category_slug' => $category->slug, 'service_slug' => $service->slug]) }}" 
                                                           class="px-6 py-3 text-gray-200 hover:bg-[#233142] hover:text-white transition-colors text-[15px] block border-b border-gray-600/20">
                                                            {{ $service->name }}
                                                        </a>
                                                    @endforeach
                                                </div>
                                            @else
                                                <div class="px-6 py-4 text-gray-400 italic text-sm border-b border-gray-600/20">
                                                    No specific services added yet.
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
                <a href="{{ route('about') }}" class="hover:text-green-600 transition">About Us</a>
                <a href="{{ route('blogs') }}" class="hover:text-green-600 transition">Blogs</a>
                <a href="{{ route('careers') }}" class="hover:text-green-600 transition">Career</a>
                <a href="{{ route('links') }}" class="hover:text-green-600 transition">Links</a>
                <a href="{{ route('contact') }}" class="hover:text-green-600 transition">Contact Us</a>
            </div>

            <!-- Mobile Hamburger Button -->
            <button @click="mobileOpen = !mobileOpen" class="md:hidden text-gray-700 hover:text-blue-900 focus:outline-none p-2">
                <i class="fa-solid" :class="mobileOpen ? 'fa-xmark text-2xl' : 'fa-bars text-xl'"></i>
            </button>
        </div>

        <!-- Mobile Menu -->
        <div x-show="mobileOpen" x-cloak class="md:hidden bg-white border-t px-6 py-4 space-y-3 text-base font-bold uppercase text-gray-700 shadow-lg">
            <a href="{{ route('home') }}" class="block py-2 hover:text-green-600">Home</a>
            <!-- Mobile Services Accordion -->
            <div x-data="{ mobileServicesOpen: false }">
                <div class="flex items-center justify-between py-2 cursor-pointer hover:text-green-600"
                     @click="mobileServicesOpen = !mobileServicesOpen">
                    <a href="{{ route('services.index') }}" class="block" @click.stop>Services</a>
                    <button class="p-1 focus:outline-none">
                        <i class="fa-solid fa-chevron-down text-sm transition-transform duration-300" :class="mobileServicesOpen ? 'rotate-180 text-theme-green' : 'text-gray-400'"></i>
                    </button>
                </div>
                
                <!-- Mobile Categories Dropdown -->
                <div x-show="mobileServicesOpen" x-collapse class="pl-4 pr-2 space-y-2 mt-1 mb-2 border-l-2 border-gray-100">
                    @if(isset($globalServiceCategories))
                        @foreach($globalServiceCategories as $category)
                            <div x-data="{ catOpen: false }" class="pt-1 pb-1">
                                <div class="flex items-center justify-between cursor-pointer text-sm text-gray-600 hover:text-theme-green"
                                     @click="catOpen = !catOpen">
                                    <a href="{{ route('services.category', $category->slug) }}" class="block font-semibold" @click.stop>{{ $category->name }}</a>
                                    <button class="p-1 focus:outline-none">
                                        <i class="fa-solid fa-plus text-xs transition-transform duration-300" x-show="!catOpen"></i>
                                        <i class="fa-solid fa-minus text-xs transition-transform duration-300" x-show="catOpen" style="display: none;"></i>
                                    </button>
                                </div>
                                
                                <!-- Mobile Services List -->
                                <div x-show="catOpen" x-collapse class="pl-4 mt-2 space-y-2 bg-gray-50 p-3 rounded">
                                    @if($category->services->count() > 0)
                                        @foreach($category->services as $service)
                                            <a href="{{ route('services.show', ['category_slug' => $category->slug, 'service_slug' => $service->slug]) }}" class="block text-xs font-medium text-gray-500 hover:text-theme-green py-1">
                                                {{ $service->name }}
                                            </a>
                                        @endforeach
                                    @else
                                        <p class="text-xs text-gray-400 italic">No services available.</p>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
            <a href="{{ route('about') }}" class="block py-2 hover:text-green-600">About Us</a>
            <a href="{{ route('blogs') }}" class="block py-2 hover:text-green-600">Blogs</a>
            <a href="{{ route('careers') }}" class="block py-2 hover:text-green-600">Career</a>
            <a href="{{ route('links') }}" class="block py-2 hover:text-green-600">Links</a>
            <a href="{{ route('contact') }}" class="block py-2 hover:text-green-600">Contact Us</a>
        </div>
    </nav>
</header>
