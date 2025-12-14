<main class="pt-8 pb-16 lg:pt-16 lg:pb-24 bg-white dark:bg-gray-900 antialiased">
    <div class="flex justify-between px-4 mx-auto max-w-screen-xl ">

        <article
            class="mx-auto w-full max-w-4xl format format-sm sm:format-base lg:format-lg format-blue dark:format-invert">
            <a href="/dashboard" class="inline-flex items-center font-medium text-sm text-blue-600 hover:text-blue-800 hover:underline mb-6 transition-colors">
                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                Back to Dashboard
            </a>

            @if ($post->image)
                <div class="relative w-full h-[400px] lg:h-[500px] mb-8 overflow-hidden rounded-2xl shadow-lg">
                    <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->title }}" class="object-cover w-full h-full transform transition hover:scale-105 duration-700">
                </div>
            @endif

            <header class="mb-8 lg:mb-10 not-format">
                <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between mb-6">
                    <h1 class="text-3xl font-extrabold leading-tight text-gray-900 lg:text-5xl dark:text-white mb-4 lg:mb-0">
                        {{ $post->title }}
                    </h1>
                </div>

                <address class="flex flex-wrap gap-4 items-center justify-between p-6 bg-gray-50 dark:bg-gray-800 rounded-xl border border-gray-100 dark:border-gray-700">
                     <div class="inline-flex items-center text-sm text-gray-900 dark:text-white">
                        <img class="mr-4 w-12 h-12 rounded-full ring-2 ring-white dark:ring-gray-900 shadow-sm"
                            src="{{ $post->author->avatar ? asset('storage/' . $post->author->avatar) : asset('img/default-avatar.png') }}"
                            alt="{{ $post->author->name }}">
                        <div>
                            <a href="/posts?author={{ $post->author->username }}" rel="author"
                                class="text-lg font-bold text-gray-900 dark:text-white hover:text-blue-600 transition-colors">{{ $post->author->name }}</a>
                            <div class="flex items-center gap-2 mt-1">
                                <a href="/posts?category={{ $post->category->slug }}">
                                    <span class="{{ $post->category->color }} text-white text-xs font-semibold px-2.5 py-0.5 rounded-full shadow-sm">
                                        {{ $post->category->name }}
                                    </span>
                                </a>
                                <span class="text-gray-400 text-xs">•</span>
                                <p class="text-xs text-gray-500 dark:text-gray-400">
                                    {{ $post->created_at->diffForHumans() }}
                                </p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="flex gap-3 items-center ml-auto">
                        <a href="/dashboard/{{ $post->slug }}/edit"
                            class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center transition-all shadow-md dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                            <svg class="mr-2 -ml-1 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                            Edit
                        </a>
                        <form action="/dashboard/{{ $post->slug }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this post?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="inline-flex items-center text-white bg-red-600 hover:bg-red-700 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center transition-all shadow-md dark:bg-red-500 dark:hover:bg-red-600 dark:focus:ring-red-900">
                                <svg class="w-4 h-4 mr-2 -ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                Delete
                            </button>
                        </form>
                    </div>
                </address>
                
            </header>
            <div class="prose prose-lg text-gray-700 dark:text-gray-300 max-w-none hover:prose-a:text-blue-600">
                {!! $post->body !!}
            </div>
        </article>
    </div>
</main>
