@props(['recentBlogs', 'categories', 'tags', 'archives'])

<!-- SIDEBAR (30%) -->
<aside class="lg:w-1/3 space-y-10">
    <!-- Search Widget -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
        <h3 class="text-lg font-bold text-gray-900 mb-4 pb-2 border-b border-gray-100 relative after:absolute after:bottom-[-1px] after:left-0 after:w-12 after:h-[2px] after:bg-emerald-500">Search Articles</h3>
        <form action="{{ route('blogs') }}" method="GET" class="relative">
            <input type="search" name="search" value="{{ request('search') }}" placeholder="Search topics..." class="w-full bg-gray-50 border border-gray-200 rounded px-4 py-3 text-sm focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500 focus:outline-none transition">
            <button type="submit" aria-label="Search" class="absolute right-3 top-3 text-emerald-600 hover:text-emerald-800 transition">
                <i class="fas fa-search"></i>
            </button>
        </form>
    </div>

    <!-- Recent Posts Widget -->
    @if(isset($recentBlogs) && $recentBlogs->count() > 0)
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
            <h3 class="text-lg font-bold text-gray-900 mb-4 pb-2 border-b border-gray-100 relative after:absolute after:bottom-[-1px] after:left-0 after:w-12 after:h-[2px] after:bg-emerald-500">Recent Posts</h3>
            <div class="space-y-5">
                @foreach($recentBlogs as $recent)
                    <a href="{{ route('blog.show', $recent->slug) }}" class="flex gap-4 group">
                        <div class="w-20 h-20 shrink-0 rounded overflow-hidden">
                            @php
                                $img = data_get($recent, 'image');
                                $imgSrc = $img && \Illuminate\Support\Str::startsWith($img, ['http://', 'https://']) ? $img : ($img ? Storage::url($img) : 'https://images.unsplash.com/photo-1554224155-8d04cb21cd6c?auto=format&fit=crop&w=100&q=80');
                            @endphp
                            <img src="{{ $imgSrc }}" alt="{{ $recent->title }}" class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
                        </div>
                        <div class="flex flex-col justify-center">
                            <h4 class="text-sm font-bold text-gray-800 leading-tight group-hover:text-emerald-600 transition line-clamp-2 mb-1">{{ $recent->title }}</h4>
                            <span class="text-[10px] font-bold uppercase tracking-wider text-emerald-500">
                                {{ $recent->published_date ? \Carbon\Carbon::parse($recent->published_date)->format('M d, Y') : $recent->created_at->format('M d, Y') }}
                            </span>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    @endif

    <!-- Categories Widget -->
    @if(isset($categories) && $categories->count() > 0)
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
            <h3 class="text-lg font-bold text-gray-900 mb-4 pb-2 border-b border-gray-100 relative after:absolute after:bottom-[-1px] after:left-0 after:w-12 after:h-[2px] after:bg-emerald-500">Categories</h3>
            <ul class="space-y-3">
                @foreach($categories as $cat)
                    <li>
                        <a href="{{ route('blog.category', $cat->slug) }}" class="flex items-center justify-between text-gray-600 hover:text-emerald-600 transition group font-medium text-sm {{ request()->is('blogs/category/' . $cat->slug) ? 'text-emerald-600 font-bold' : '' }}">
                            <span><i class="fas fa-angle-right text-xs mr-2 {{ request()->is('blogs/category/' . $cat->slug) ? 'text-emerald-600' : 'text-emerald-400' }} group-hover:translate-x-1 transition-transform"></i> {{ $cat->name }}</span>
                            <span class="bg-gray-100 text-gray-500 text-xs px-2 py-0.5 rounded group-hover:bg-emerald-100 group-hover:text-emerald-700 transition">{{ $cat->blogs_count }}</span>
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Tag Cloud Widget -->
    @if(isset($tags) && $tags->count() > 0)
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
            <h3 class="text-lg font-bold text-gray-900 mb-4 pb-2 border-b border-gray-100 relative after:absolute after:bottom-[-1px] after:left-0 after:w-12 after:h-[2px] after:bg-emerald-500">Tag Cloud</h3>
            <div class="flex flex-wrap gap-2">
                @foreach($tags as $tag)
                    <a href="{{ route('blog.tag', $tag->slug) }}" class="{{ request()->is('blogs/tag/' . $tag->slug) ? 'bg-emerald-600 text-white' : 'bg-gray-100 text-gray-600 hover:bg-emerald-600 hover:text-white' }} px-3 py-1.5 text-[11px] font-bold uppercase rounded transition">
                        {{ $tag->name }}
                    </a>
                @endforeach
            </div>
        </div>
    @endif

    <!-- Archives Widget -->
    @if(isset($archives) && $archives->count() > 0)
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
            <h3 class="text-lg font-bold text-gray-900 mb-4 pb-2 border-b border-gray-100 relative after:absolute after:bottom-[-1px] after:left-0 after:w-12 after:h-[2px] after:bg-emerald-500">Archives</h3>
            <ul class="space-y-3">
                @foreach($archives as $archive)
                    <li>
                        <a href="{{ route('blog.archive', $archive->slug) }}" class="flex items-center justify-between text-gray-600 hover:text-emerald-600 transition group font-medium text-sm {{ request()->is('blogs/archive/' . $archive->slug) ? 'text-emerald-600 font-bold' : '' }}">
                            <span><i class="fas fa-angle-right text-xs mr-2 {{ request()->is('blogs/archive/' . $archive->slug) ? 'text-emerald-600' : 'text-emerald-400' }} group-hover:translate-x-1 transition-transform"></i> {{ $archive->name }}</span>
                            <span class="bg-gray-100 text-gray-500 text-xs px-2 py-0.5 rounded group-hover:bg-emerald-100 group-hover:text-emerald-700 transition">{{ $archive->blogs_count }}</span>
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>
    @endif
</aside>
