<header class="relative z-50 bg-white shadow-[0_2px_12px_rgba(15,23,42,0.08)]" x-data="{ mobileOpen: false, servicesOpen: false, mobileCategory: null }">
    <nav class="mx-auto flex min-h-[108px] max-w-7xl items-center justify-between gap-8 px-5 py-5 lg:px-10">
        <a href="{{ route('home') }}" class="shrink-0 leading-tight text-blue-950" aria-label="Jitesh Telhara and Associates LLP home">
            <span class="block text-lg font-extrabold tracking-tight sm:text-xl">JITESH TELHARA &amp; ASSOCIATES LLP</span>
            <span class="mt-1 block text-xs font-bold text-emerald-600 sm:text-sm">Chartered Accountants</span>
        </a>

        <button type="button" class="grid h-11 w-11 place-items-center rounded-lg border border-slate-200 text-xl text-blue-950 lg:hidden" @click="mobileOpen = !mobileOpen" :aria-expanded="mobileOpen.toString()" aria-controls="mobile-navigation" aria-label="Toggle menu">
            <i class="fas" :class="mobileOpen ? 'fa-times' : 'fa-bars'"></i>
        </button>

        <div class="hidden items-center lg:flex">
            <ul class="flex items-center gap-7 text-[17px] font-semibold text-slate-700 xl:gap-9">
                <li><a href="{{ route('home') }}" class="transition hover:text-emerald-600 {{ request()->routeIs('home') ? 'text-emerald-600' : '' }}">HOME</a></li>
                <li class="group relative">
                    <button type="button" class="flex items-center gap-2 py-10 transition group-hover:text-emerald-600 {{ request()->routeIs('services', 'service.show') ? 'text-emerald-600' : '' }}" aria-haspopup="true">
                        SERVICES <i class="fas fa-chevron-down text-xs"></i>
                    </button>
                    <div class="invisible absolute left-1/2 top-full flex -translate-x-1/2 pt-0 opacity-0 transition duration-150 group-hover:visible group-hover:opacity-100">
                        <div class="w-[313px] overflow-visible bg-[#1D293B] shadow-xl">
                            @forelse($headerServices as $category => $categoryServices)
                                <div class="group/category relative border-b border-slate-600 last:border-0">
                                    <a href="{{ route('services') }}?category={{ urlencode($category) }}" class="flex min-h-[58px] items-center justify-between px-[18px] text-[17px] text-white transition hover:bg-slate-700">
                                        <span>{{ \Illuminate\Support\Str::headline($category) }}</span>
                                        <i class="fas fa-chevron-right text-xs text-slate-300"></i>
                                    </a>
                                    <div class="invisible absolute left-full top-0 w-[313px] opacity-0 transition duration-150 group-hover/category:visible group-hover/category:opacity-100">
                                        <div class="overflow-hidden bg-[#1D293B] shadow-xl">
                                            @foreach($categoryServices as $headerService)
                                                <a href="{{ route('service.show', $headerService->slug) }}" class="block min-h-[58px] border-b border-slate-600 px-[18px] py-4 text-[16px] text-white transition last:border-0 hover:bg-slate-700">{{ $headerService->title }}</a>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <a href="{{ route('services') }}" class="block px-[18px] py-4 text-[16px] text-white">View services</a>
                            @endforelse
                        </div>
                    </div>
                </li>
                <li><a href="{{ route('about') }}" class="transition hover:text-emerald-600 {{ request()->routeIs('about') ? 'text-emerald-600' : '' }}">ABOUT US</a></li>
                <li><a href="{{ route('blogs') }}" class="transition hover:text-emerald-600 {{ request()->routeIs('blogs', 'blog.show') ? 'text-emerald-600' : '' }}">BLOGS</a></li>
                <li><a href="{{ route('careers') }}" class="transition hover:text-emerald-600 {{ request()->routeIs('careers', 'career.show') ? 'text-emerald-600' : '' }}">CAREERS</a></li>
                <li><a href="{{ route('services') }}" class="transition hover:text-emerald-600">LINKS</a></li>
                <li><a href="{{ route('contact') }}" class="transition hover:text-emerald-600 {{ request()->routeIs('contact') ? 'text-emerald-600' : '' }}">CONTACT US</a></li>
            </ul>
        </div>
    </nav>

    <div id="mobile-navigation" x-show="mobileOpen" x-cloak class="border-t border-slate-100 bg-white px-5 py-4 lg:hidden">
        <ul class="space-y-1 text-base font-semibold text-slate-700">
            <li><a href="{{ route('home') }}" class="block rounded px-3 py-3 hover:bg-slate-50 hover:text-emerald-600">HOME</a></li>
            <li>
                <button type="button" class="flex w-full items-center justify-between rounded px-3 py-3 hover:bg-slate-50 hover:text-emerald-600" @click="servicesOpen = !servicesOpen" :aria-expanded="servicesOpen.toString()">
                    SERVICES <i class="fas text-xs" :class="servicesOpen ? 'fa-chevron-up' : 'fa-chevron-down'"></i>
                </button>
                <div x-show="servicesOpen" x-cloak class="ml-3 border-l-2 border-emerald-100 pl-3">
                    @foreach($headerServices as $category => $categoryServices)
                        <div class="border-b border-slate-100 last:border-0">
                            <button type="button" class="flex w-full items-center justify-between py-3 text-left text-slate-700" @click="mobileCategory = mobileCategory === '{{ $category }}' ? null : '{{ $category }}'">
                                {{ \Illuminate\Support\Str::headline($category) }} <i class="fas text-xs" :class="mobileCategory === '{{ $category }}' ? 'fa-chevron-up' : 'fa-chevron-down'"></i>
                            </button>
                            <div x-show="mobileCategory === '{{ $category }}'" x-cloak class="pb-2 pl-3">
                                @foreach($categoryServices as $headerService)
                                    <a href="{{ route('service.show', $headerService->slug) }}" class="block py-2 text-sm font-medium text-slate-500 hover:text-emerald-600">{{ $headerService->title }}</a>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                </div>
            </li>
            <li><a href="{{ route('about') }}" class="block rounded px-3 py-3 hover:bg-slate-50 hover:text-emerald-600">ABOUT US</a></li>
            <li><a href="{{ route('blogs') }}" class="block rounded px-3 py-3 hover:bg-slate-50 hover:text-emerald-600">BLOGS</a></li>
            <li><a href="{{ route('careers') }}" class="block rounded px-3 py-3 hover:bg-slate-50 hover:text-emerald-600">CAREERS</a></li>
            <li><a href="{{ route('services') }}" class="block rounded px-3 py-3 hover:bg-slate-50 hover:text-emerald-600">LINKS</a></li>
            <li><a href="{{ route('contact') }}" class="block rounded px-3 py-3 hover:bg-slate-50 hover:text-emerald-600">CONTACT US</a></li>
        </ul>
    </div>
</header>
