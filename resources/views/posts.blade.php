<x-layout :title="$title">
    <div class="py-16 px-4 mx-auto max-w-screen-xl lg:px-6">
        <form class="mb-8 max-w-xl mx-auto">
            @if (request('category'))
                <input type="hidden" name="category" value="{{ request('category') }}">
            @endif
            @if (request('author'))
                <input type="hidden" name="author" value="{{ request('author') }}">
            @endif
            <label for="default-search"
                class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Search</label>
            <div class="relative">
                <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                    </svg>
                </div>
                <input type="search" id="default-search"
                    class="block w-full p-4 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-red-700 focus:border-red-700 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-red-700 dark:focus:border-red-700"
                    placeholder="Search post title" autocomplete="off" autofocus name="search" />
                <button type="submit"
                    class="text-white absolute end-2.5 bottom-2.5 bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">Search</button>
            </div>
        </form>

        <div class="lg:grid lg:grid-cols-3 lg:gap-12 mt-12">
            <div class="lg:col-span-1">
                <h1 class="text-4xl font-extrabold tracking-tight text-gray-900 dark:text-white">Blog Kami</h1>
                <p class="mt-4 text-lg font-light text-gray-500 dark:text-gray-400">
                    Di sini Anda bisa menemukan karya tulis terbaik dari kader Ikatan Mahasiswa Muhammadiyah Fakultas
                    Teknik UMJ. Kami menggunakan pendekatan yang kritis untuk menguji gagasan dan terhubung dengan
                    audiens kami.
                </p>
                <div class="mt-8">
                    <h3 class="text-xl font-bold tracking-tight text-gray-900 dark:text-white mb-2">Filter</h3>
                    <div class="flex flex-wrap gap-2">
                        <a href="/posts?category=opini"
                            class="px-3 py-1 text-sm font-semibold text-gray-600 rounded-full bg-gray-200 dark:bg-gray-700 dark:text-gray-200 hover:bg-gray-300 dark:hover:bg-gray-600">Opini</a>
                        <a href="/posts?category=esai"
                            class="px-3 py-1 text-sm font-semibold text-gray-600 rounded-full bg-gray-200 dark:bg-gray-700 dark:text-gray-200 hover:bg-gray-300 dark:hover:bg-gray-600">Esai</a>
                        <a href="/posts"
                            class="px-3 py-1 text-sm font-semibold text-gray-600 rounded-full bg-gray-200 dark:bg-gray-700 dark:text-gray-200 hover:bg-gray-300 dark:hover:bg-gray-600">Semua</a>
                    </div>
                </div>
            </div>

            <div class="mt-12 lg:mt-0 lg:col-span-2">
                {{ $posts->links() }}

                <div class="mt-8 space-y-8">
                    @forelse ($posts as $post)
                        <article
                            class="p-6 bg-white rounded-xl shadow-lg hover:shadow-2xl transition-all duration-300 ease-in-out dark:bg-gray-800 dark:border-gray-700">
                            <div
                                class="flex flex-col sm:flex-row sm:justify-between sm:items-center mb-5 text-gray-500">
                                <a href="/posts?category={{ $post->category->slug }}">
                                    <span
                                        class="text-xs font-semibold inline-flex items-center px-3 py-1 rounded-full text-white {{ $post->category->color }} hover:bg-red-800 transition-colors duration-200">
                                        {{ $post->category->name }}
                                    </span>
                                </a>
                                <span
                                    class="text-sm mt-2 sm:mt-0 dark:text-gray-400">{{ $post->created_at->diffForHumans() }}</span>
                            </div>
                            <h2
                                class="mb-2 text-3xl font-extrabold tracking-tight text-gray-900 dark:text-white leading-tight">
                                <a href="/posts/{{ $post->slug }}"
                                    class="hover:text-red-700 transition-colors duration-200">
                                    {{ $post->title }}
                                </a>
                            </h2>
                            <div class="mb-5 text-base font-normal text-gray-700 dark:text-gray-400">
                                {!! Str::limit(strip_tags($post->body), 200) !!}
                            </div>
                            <div class="flex items-center justify-between">
                                <a href="/posts?author={{ $post->author->username }}" class="group">
                                    <div class="flex items-center space-x-3">
                                        <img class="w-8 h-8 rounded-full ring-2 ring-red-300 group-hover:ring-red-500 transition-all duration-200"
                                            src="{{ $post->author->avatar ? asset('storage/' . $post->author->avatar) : asset('img/default-avatar.png') }}"
                                            alt="{{ $post->author->name }}" />
                                        <span
                                            class="font-medium text-sm text-gray-900 dark:text-white group-hover:text-red-700 transition-colors duration-200">
                                            {{ $post->author->name }}
                                        </span>
                                    </div>
                                </a>
                                <a href="/posts/{{ $post->slug }}"
                                    class="inline-flex items-center font-semibold text-sm text-red-700 hover:text-red-900 transition-colors duration-200">
                                    Read more
                                    <svg class="ml-2 w-4 h-4" fill="currentColor" viewBox="0 0 20 20"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd"
                                            d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z"
                                            clip-rule="evenodd"></path>
                                    </svg>
                                </a>
                            </div>
                        </article>
                    @empty
                        <div class="text-center py-10">
                            <p class="font-extrabold text-2xl my-4 text-gray-900 dark:text-white">Artikel tidak
                                ditemukan.</p>
                            <a href="/posts"
                                class="inline-flex items-center text-red-700 hover:underline hover:text-red-900 transition-colors duration-200">&laquo;
                                Kembali ke semua artikel.</a>
                        </div>
                    @endforelse
                </div>

                <div class="mt-8">
                    {{ $posts->links() }}
                </div>
            </div>
        </div>
    </div>
</x-layout>
