<x-layout :title="$title">
    <div class="py-12 px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
        <!-- Header & Search Section -->
        <div class="max-w-3xl mx-auto text-center mb-16">
            <h1 class="text-4xl font-extrabold text-gray-900 sm:text-5xl tracking-tight mb-4">
                Blog & Artikel
            </h1>
            <p class="text-lg text-gray-500 mb-8 max-w-2xl mx-auto">
                Temukan gagasan, opini, dan karya tulis terbaik dari kader Ikatan Mahasiswa Muhammadiyah Fakultas Teknik UMJ.
            </p>

            <!-- Search Form -->
            <form action="/posts" class="relative max-w-2xl mx-auto mb-12">
                <!-- Hidden inputs for active filters -->
                @if (request('category'))
                    <input type="hidden" name="category" value="{{ request('category') }}">
                @endif
                @if (request('author'))
                    <input type="hidden" name="author" value="{{ request('author') }}">
                @endif
                
                <div class="flex items-center gap-3">
                    <div class="relative w-full group">
                        <div class="absolute inset-y-0 left-0 pl-5 flex items-center pointer-events-none">
                            <svg class="h-6 w-6 text-gray-400 group-focus-within:text-red-600 transition-colors" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <input type="text" 
                            name="search" 
                            value="{{ request('search') }}"
                            class="block w-full pl-14 pr-4 py-4 border-2 border-gray-100 rounded-full leading-5 bg-white placeholder-gray-400 focus:outline-none focus:border-red-500 focus:ring-1 focus:ring-red-500 sm:text-lg shadow-sm hover:border-gray-200 transition-all duration-200"
                            placeholder="Cari artikel menarik..." 
                            autocomplete="off">
                    </div>
                    <button type="submit" class="flex-shrink-0 p-4 bg-red-600 text-white rounded-full hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition-colors duration-200 shadow-md">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                        </svg>
                    </button>
                </div>
            </form>

            <!-- Quick Category Filters -->
            <div class="flex flex-wrap justify-center gap-3 mb-12">
                <a href="/posts" class="px-5 py-2.5 rounded-full text-sm font-semibold transition-all duration-200 {{ !request('category') ? 'bg-red-600 text-white shadow-lg ring-2 ring-red-600 ring-offset-2' : 'bg-white text-gray-600 border border-gray-200 hover:bg-gray-50 hover:border-gray-300' }}">
                    Semua
                </a>
                <a href="/posts?category=opini" class="px-5 py-2.5 rounded-full text-sm font-semibold transition-all duration-200 {{ request('category') == 'opini' ? 'bg-red-600 text-white shadow-lg ring-2 ring-red-600 ring-offset-2' : 'bg-white text-gray-600 border border-gray-200 hover:bg-gray-50 hover:border-gray-300' }}">
                    Opini
                </a>
                <a href="/posts?category=esai" class="px-5 py-2.5 rounded-full text-sm font-semibold transition-all duration-200 {{ request('category') == 'esai' ? 'bg-red-600 text-white shadow-lg ring-2 ring-red-600 ring-offset-2' : 'bg-white text-gray-600 border border-gray-200 hover:bg-gray-50 hover:border-gray-300' }}">
                    Esai
                </a>
                <!-- We could dynamically list categories here if passed from controller -->
            </div>

            <!-- Active Filter Badges (only show if author or search is active, or specific category is selected) -->
            @if(request('author') || request('search'))
                <div class="flex flex-wrap justify-center gap-2">
                    @if(request('category'))
                        <a href="/posts?{{ http_build_query(request()->except('category', 'page')) }}" class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-red-100 text-red-800 hover:bg-red-200 transition-colors">
                            Kategori: {{ ucfirst(request('category')) }}
                            <svg class="ml-1.5 h-3 w-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" /></svg>
                        </a>
                    @endif
                    @if(request('author'))
                        <a href="/posts?{{ http_build_query(request()->except('author', 'page')) }}" class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800 hover:bg-blue-200 transition-colors">
                            Penulis: {{ request('author') }}
                            <svg class="ml-1.5 h-3 w-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" /></svg>
                        </a>
                    @endif
                    @if(request('search'))
                        <a href="/posts?{{ http_build_query(request()->except('search', 'page')) }}" class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-gray-100 text-gray-800 hover:bg-gray-200 transition-colors">
                            Search: "{{ request('search') }}"
                            <svg class="ml-1.5 h-3 w-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" /></svg>
                        </a>
                    @endif
                    @if(request()->keys() && !in_array('page', request()->keys()))
                        <a href="/posts" class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-white border border-gray-300 text-gray-700 hover:bg-gray-50 transition-colors">
                            Reset Filter
                        </a>
                    @endif
                </div>
            @endif
        </div>

        <!-- Main Layout -->
        <div class="mt-16 max-w-none mx-auto grid gap-8 md:grid-cols-2 lg:grid-cols-3">
            @forelse ($posts as $post)
                <article class="flex flex-col rounded-2xl shadow-lg overflow-hidden transition-all duration-300 hover:shadow-2xl hover:-translate-y-1 bg-white border border-gray-100">
                    <!-- Image -->
                    <div class="flex-shrink-0 relative">
                        <a href="/posts/{{ $post->slug }}">
                            <img class="h-48 w-full object-cover" 
                                 style="object-fit: cover;"
                                 src="{{ $post->image ? asset('storage/' . $post->image) : 'https://ui-avatars.com/api/?name=' . urlencode($post->title) . '&background=f3f4f6&color=6b7280&size=512&font-size=0.33' }}" 
                                 alt="{{ $post->title }}">
                        </a>
                    </div>
                    
                    <!-- Content -->
                    <div class="flex-1 bg-white p-6 flex flex-col justify-between">
                        <div class="flex-1">
                            <div class="flex items-center justify-between">
                                <p class="text-sm font-medium text-red-600">
                                    <a href="/posts?category={{ $post->category->slug }}" class="hover:underline">
                                        {{ $post->category->name }}
                                    </a>
                                </p>
                                <div class="text-sm text-gray-500 flex items-center">
                                    <svg class="flex-shrink-0 mr-1.5 h-4 w-4 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd" />
                                    </svg>
                                    {{ $post->created_at->format('M d, Y') }}
                                </div>
                            </div>
                            
                            <a href="/posts/{{ $post->slug }}" class="block mt-2">
                                <p class="text-xl font-semibold text-gray-900 hover:text-red-700 transition-colors">
                                    {{ $post->title }}
                                </p>
                                <div class="mt-3 text-base text-gray-500 line-clamp-3">
                                    {!! Str::limit(strip_tags($post->body), 150) !!}
                                </div>
                            </a>
                        </div>
                        
                        <div class="mt-6 flex items-center">
                            <div class="flex-shrink-0">
                                <a href="/posts?author={{ $post->author->username }}">
                                    <span class="sr-only">{{ $post->author->name }}</span>
                                    @if($post->author->avatar)
                                        <img class="h-10 w-10 rounded-full object-cover" src="{{ asset('storage/' . $post->author->avatar) }}" alt="">
                                    @else
                                        <div class="h-10 w-10 rounded-full bg-gray-200 flex items-center justify-center">
                                            <span class="text-xs font-bold text-gray-500">{{ substr($post->author->name, 0, 2) }}</span>
                                        </div>
                                    @endif
                                </a>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm font-medium text-gray-900">
                                    <a href="/posts?author={{ $post->author->username }}" class="hover:underline">
                                        {{ $post->author->name }}
                                    </a>
                                </p>
                            </div>
                        </div>
                    </div>
                </article>
            @empty
                <div class="lg:col-span-3 text-center py-12">
                     <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path vector-effect="non-scaling-stroke" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 13h6m-3-3v6m-9 1V7a2 2 0 012-2h6l2 2h6a2 2 0 012 2v8a2 2 0 01-2 2H5a2 2 0 01-2-2z" />
                    </svg>
                    <h3 class="mt-2 text-sm font-medium text-gray-900">Tidak ada artikel ditemukan</h3>
                    <p class="mt-1 text-sm text-gray-500">Coba ubah filter atau kata kunci pencarian Anda.</p>
                </div>
            @endforelse
        </div>

        <!-- Pagination -->
        <div class="mt-12">
            {{ $posts->links() }}
        </div>
    </div>
</x-layout>
