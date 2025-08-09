<x-layout :title="$title">
    <div class="max-w-7xl mx-auto my-10 px-4 sm:px-6 lg:px-8 py-8 bg-white rounded-lg shadow-md">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

            <!-- Main Content -->
            <div class="lg:col-span-2">
                <!-- Featured Image -->
                @if ($post->image)
                    <div class="mb-8">
                        <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->title }}"
                            class="w-full h-64 md:h-80 object-cover rounded-lg shadow-lg">
                    </div>
                @endif

                <!-- Article Header -->
                <header class="mb-8">
                    <h1
                        class="text-3xl md:text-4xl lg:text-5xl font-bold text-gray-900 dark:text-white mb-6 leading-tight">
                        {{ $post->title }}
                    </h1>

                    <!-- Author Info -->
                    <div class="flex items-center mb-6">
                        <img class="w-12 h-12 rounded-full mr-4"
                            src="{{ $post->author->avatar ? asset('storage/' . $post->author->avatar) : asset('img/default-avatar.png') }}"
                            alt="{{ $post->author->name }}">
                        <div>
                            <div class="flex items-center space-x-4 text-sm text-gray-600 dark:text-gray-400">
                                <a href="/posts?author={{ $post->author->username }}"
                                    class="font-medium text-gray-900 dark:text-white hover:underline">
                                    {{ $post->author->name }}
                                </a>
                                <span>•</span>
                                <span>{{ $post->created_at->format('M d, Y') }}</span>
                                <span>•</span>
                                <span>{{ str_word_count(strip_tags($post->body)) }} min read</span>
                                <span>•</span>
                                <a href="/posts?category={{ $post->category->slug }}"
                                    class="text-blue-600 hover:underline">
                                    {{ $post->category->name }}
                                </a>
                            </div>
                        </div>
                    </div>
                </header>

                <!-- Article Content -->
                <div class="prose prose-lg dark:prose-invert max-w-none border-b border-gray-200 dark:border-gray-700">
                    {!! $post->body !!}
                </div>


                <!-- Author Bio -->
                <div class="mt-12 p-6 bg-gray-50 dark:bg-gray-800 rounded-lg">
                    <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-4">
                        Author: {{ $post->author->name }}
                    </h3>
                    <div class="flex items-start space-x-4">
                        <img class="w-16 h-16 rounded-full"
                            src="{{ $post->author->avatar ? asset('storage/' . $post->author->avatar) : asset('img/default-avatar.png') }}"
                            alt="{{ $post->author->name }}">
                        <div class="flex-1">
                            <p class="text-gray-600 dark:text-gray-400 mb-4">
                                Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium
                                doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore
                                veritatis.
                            </p>
                            <div class="flex space-x-3">
                                <a href="#" class="text-gray-400 hover:text-gray-600">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                        <path
                                            d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z" />
                                    </svg>
                                </a>
                                <a href="#" class="text-gray-400 hover:text-gray-600">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                        <path
                                            d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z" />
                                    </svg>
                                </a>
                                <a href="#" class="text-gray-400 hover:text-gray-600">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                        <path
                                            d="M12.017 0C5.396 0 .029 5.367.029 11.987c0 5.079 3.158 9.417 7.618 11.174-.105-.949-.199-2.403.041-3.439.219-.937 1.406-5.957 1.406-5.957s-.359-.72-.359-1.781c0-1.663.967-2.911 2.168-2.911 1.024 0 1.518.769 1.518 1.688 0 1.029-.653 2.567-.992 3.992-.285 1.193.6 2.165 1.775 2.165 2.128 0 3.768-2.245 3.768-5.487 0-2.861-2.063-4.869-5.008-4.869-3.41 0-5.409 2.562-5.409 5.199 0 1.033.394 2.143.889 2.741.099.12.112.224.085.345-.09.375-.293 1.199-.334 1.363-.053.225-.172.271-.402.165-1.495-.69-2.433-2.878-2.433-4.646 0-3.776 2.748-7.252 7.92-7.252 4.158 0 7.392 2.967 7.392 6.923 0 4.135-2.607 7.462-6.233 7.462-1.214 0-2.357-.629-2.751-1.378l-.748 2.853c-.271 1.043-1.002 2.35-1.492 3.146C9.57 23.812 10.763 24.009 12.017 24.009c6.624 0 11.99-5.367 11.99-11.988C24.007 5.367 18.641.001 12.017.001z" />
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="lg:col-span-1">
                <!-- Recent Posts -->
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6 mb-8">
                    <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-6">Recent Posts</h3>
                    <div class="space-y-4">
                        @forelse($recentPosts as $recentPost)
                            <div class="flex items-center space-x-3">
                                <img src="{{ asset('storage/' . $recentPost->image) }}" alt="{{ $recentPost->title }}"
                                    class="w-12 h-12 object-cover rounded">
                                <div class="flex-1">
                                    <h4 class="text-sm font-medium text-gray-900 dark:text-white hover:text-blue-600">
                                        <a href="{{ route('posts.show', $recentPost->slug) }}">
                                            {{ $recentPost->title }}
                                        </a>
                                    </h4>
                                    <p class="text-xs text-gray-500 dark:text-gray-400">
                                        {{ $recentPost->author->name }} •
                                        {{ $recentPost->created_at->format('M d, Y') }}
                                    </p>
                                </div>
                            </div>
                        @empty
                            <p class="text-gray-500 dark:text-gray-400">No recent posts available.</p>
                        @endforelse
                    </div>
                </div>

                <!-- Explore Topics -->
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6 mb-8">
                    <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-6">Explore Topics</h3>
                    <div class="space-y-3">
                        @foreach ($categories as $category)
                            <div class="flex justify-between items-center">
                                <a href="/posts?category={{ $category->slug }}"
                                    class="text-gray-600 dark:text-gray-400 hover:text-blue-600">
                                    {{ $category->name }}
                                </a>
                                <span class="text-xs text-gray-400">{{ $category->posts_count }}</span>
                            </div>
                        @endforeach
                    </div>
                </div>

            </div>
        </div>
        <div class="mt-5">
            <a href="/posts" class="inline-flex items-center text-blue-600 hover:text-blue-800 font-medium">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
                Back to all posts
            </a>
        </div>
    </div>
</x-layout>
