<header x-data="{ mobileOpen: false, servicesOpen: false, activeCat: null }">
    <!-- Top Navy Bar -->
    <div class="navy-bg text-white text-[11px] py-2 px-6">
        <div class="max-w-7xl mx-auto flex justify-between items-center">
            <div class="flex flex-wrap items-center gap-6">
                <a href="mailto:{{ $siteSettings['contact_email'] ?? '' }}" class="flex items-center gap-1.5 hover:text-green-300 transition">
                    <i class="fa-solid fa-envelope text-theme-green"></i> 
                    <span>{{ $siteSettings['contact_email'] ?? '' }}</span>
                </a>
                <a href="tel:{{ $siteSettings['contact_phone'] ?? '' }}" class="flex items-center gap-1.5 hover:text-green-300 transition">
                    <i class="fa-solid fa-phone text-theme-green"></i> 
                    <span>{{ $siteSettings['contact_phone'] ?? '' }}</span>
                </a>
            </div>
            <div class="hidden sm:flex items-center space-x-3 text-[10px] text-gray-300">
                <span>{{ $siteSettings['header_office_timing'] ?? '' }}</span>
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
            


            <a href="{{ route('about') }}" class="block py-2 {{ request()->routeIs('about') ? 'text-theme-green' : 'hover:text-green-600' }}">About Us</a>
            <a href="{{ route('blogs') }}" class="block py-2 {{ request()->routeIs('blogs') ? 'text-theme-green' : 'hover:text-green-600' }}">Blogs</a>
            <a href="{{ route('careers') }}" class="block py-2 {{ request()->routeIs('careers') ? 'text-theme-green' : 'hover:text-green-600' }}">Career</a>
            <a href="{{ route('links') }}" class="block py-2 {{ request()->routeIs('links') ? 'text-theme-green' : 'hover:text-green-600' }}">Links</a>
            <a href="{{ route('contact') }}" class="block py-2 {{ request()->routeIs('contact') ? 'text-theme-green' : 'hover:text-green-600' }}">Contact Us</a>
        </div>
    </nav>
</header>
