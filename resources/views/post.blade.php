<x-layout :title="$title">
    <div class="max-w-7xl mx-auto my-10 px-4 sm:px-6 lg:px-8 py-8 bg-white rounded-lg shadow-md">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <div class="lg:col-span-2">
                @if ($post->image)
                    <div class="mb-8">
                        <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->title }}"
                            class="w-full h-64 md:h-80 object-cover rounded-lg shadow-lg">
                    </div>
                @endif
                <header class="mb-8">
                    <h1
                        class="text-3xl md:text-4xl lg:text-5xl font-bold text-gray-900 dark:text-white mb-6 leading-tight">
                        {{ $post->title }}
                    </h1>
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
                <div class="prose prose-lg dark:prose-invert max-w-none border-b border-gray-200 dark:border-gray-700">
                    {!! $post->body !!}
                </div>
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
                        </div>
                    </div>
                </div>

                <div id="comments-section" class="mt-12"
                    x-data='commentsComponent({{ $post->id }}, @json($comments->items()))'>
                    <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-6">
                        Komentar (<span x-text="comments.length"></span>)
                    </h2>

                    <div class="bg-gray-50 dark:bg-gray-800 rounded-lg p-6 mb-8">
                        @auth
                            <form id="comment-form" x-ref="form" @submit.prevent="submit">
                                @csrf
                                <input type="hidden" name="parent_id" x-model="newComment.parent_id">
                                <div class="mb-4">
                                    <textarea name="content" x-model="newComment.content" id="comment-content"
                                        class="w-full p-3 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 transition duration-150 ease-in-out"
                                        rows="4" placeholder="Tulis komentar..."></textarea>
                                </div>
                                <button type="submit"
                                    class="bg-blue-600 text-white font-medium py-2 px-4 rounded-lg hover:bg-blue-700 transition duration-150 ease-in-out"
                                    :disabled="sending">
                                    Kirim Komentar
                                </button>
                            </form>
                        @else
                            <p class="text-gray-600 dark:text-gray-400">
                                <a href="{{ route('login') }}" class="text-blue-600 hover:underline">Masuk</a> untuk
                                meninggalkan komentar.
                            </p>
                        @endauth
                    </div>

                    <div id="comments-list" class="space-y-6">
                        <template x-for="comment in comments" :key="comment.id">
                            <div x-data="{ showReplyForm: false }" class="flex"
                                :class="{ 'mt-6 pl-10 border-l border-gray-200': comment.parent_id }"
                                :id="'comment-' + comment.id">
                                <div class="flex-shrink-0 mr-3">
                                    <img class="w-10 h-10 rounded-full"
                                        :src="comment.user.avatar ? '/storage/' + comment.user.avatar :
                                            '{{ asset('img/default-avatar.png') }}'"
                                        :alt="comment.user.name">
                                </div>
                                <div class="flex-1">
                                    <div class="bg-gray-50 dark:bg-gray-800 rounded-lg p-4">
                                        <div class="flex items-center justify-between mb-2">
                                            <span class="text-sm font-bold text-gray-900 dark:text-white"
                                                x-text="comment.user.name"></span>
                                            <span class="text-xs text-gray-500"
                                                x-text="formatDate(comment.created_at)"></span>
                                        </div>
                                        <div class="prose prose-sm dark:prose-invert max-w-none"
                                            x-html="comment.content_html"></div>
                                    </div>

                                    <div class="mt-2 flex items-center text-sm text-gray-500 space-x-4">
                                        <button
                                            class="flex items-center space-x-1 hover:text-blue-600 transition-colors duration-200"
                                            @click="showReplyForm = !showReplyForm">
                                            <span>Balas</span>
                                        </button>
                                    </div>

                                    <div x-show="showReplyForm" x-collapse.duration.500ms
                                        class="mt-4 pl-4 border-l border-gray-200">
                                        @auth
                                            <form @submit.prevent="submitReply($event, comment)">
                                                @csrf
                                                <div class="mb-2">
                                                    <textarea name="content"
                                                        class="w-full p-2 text-sm border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500"
                                                        rows="3" placeholder="Balas komentar..."></textarea>
                                                </div>
                                                <button type="submit"
                                                    class="bg-blue-600 text-white font-medium py-1 px-3 rounded-lg text-sm hover:bg-blue-700">
                                                    Kirim Balasan
                                                </button>
                                            </form>
                                        @else
                                            <p class="text-gray-600 dark:text-gray-400">
                                                <a href="{{ route('login') }}"
                                                    class="text-blue-600 hover:underline">Masuk</a>
                                                untuk membalas.
                                            </p>
                                        @endauth
                                    </div>

                                    <template x-if="comment.replies && comment.replies.length > 0">
                                        <div class="mt-4 space-y-4">
                                            <template x-for="reply in comment.replies" :key="reply.id">
                                                <div class="pl-10 border-l border-gray-200">
                                                    <div class="flex">
                                                        <div class="flex-shrink-0 mr-3">
                                                            <img class="w-8 h-8 rounded-full"
                                                                :src="reply.user.avatar ? '/storage/' + reply.user.avatar :
                                                                    '{{ asset('img/default-avatar.png') }}'"
                                                                :alt="reply.user.name">
                                                        </div>
                                                        <div class="flex-1">
                                                            <div class="bg-gray-50 dark:bg-gray-800 rounded-lg p-3">
                                                                <div class="flex items-center justify-between mb-2">
                                                                    <span
                                                                        class="text-sm font-bold text-gray-900 dark:text-white"
                                                                        x-text="reply.user.name"></span>
                                                                    <span class="text-xs text-gray-500"
                                                                        x-text="formatDate(reply.created_at)"></span>
                                                                </div>
                                                                <div class="prose prose-sm dark:prose-invert max-w-none"
                                                                    x-html="reply.content_html"></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </template>
                                        </div>
                                    </template>
                                </div>
                            </div>
                        </template>
                    </div>

                    <div x-show="loadingMore" class="text-center mt-4 text-gray-500">Memuat...</div>
                    <button x-show="hasMore" @click="loadMore()"
                        class="bg-blue-600 text-white font-medium py-2 px-4 rounded-lg hover:bg-blue-700 transition duration-150 ease-in-out mt-4 w-full">
                        Muat Komentar Lebih Banyak
                    </button>
                </div>
            </div>

            <div class="lg:col-span-1">
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6 mb-8">
                    <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-6">Recent Posts</h3>
                    <div class="space-y-4">
                        @forelse($recentPosts as $recentPost)
                            <div class="flex items-center space-x-3">
                                <img src="{{ asset('storage/' . $recentPost->image) }}"
                                    alt="{{ $recentPost->title }}" class="w-12 h-12 object-cover rounded">
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
    @push('scripts')
        <script>
            function commentsComponent(postId, initialComments, hasMorePages) {
                return {
                    postId: postId,
                    comments: initialComments || [],
                    page: 1,
                    hasMore: hasMorePages,
                    loadingMore: false,
                    sending: false,
                    newComment: {
                        content: '',
                        parent_id: null
                    },

                    formatDate(date) {
                        return new Date(date).toLocaleDateString('id-ID', {
                            year: 'numeric',
                            month: 'long',
                            day: 'numeric',
                            hour: '2-digit',
                            minute: '2-digit'
                        });
                    },

                    init() {
                        if (typeof window.Echo === 'undefined') {
                            console.warn('Echo is not initialized yet');
                            return;
                        }

                        try {
                            const channel = window.Echo.private(`posts.${this.postId}`);
                            const boundListener = this.handleNewComment.bind(this);
                            channel.listen('CommentCreated', boundListener);
                            this.$cleanup = () => {
                                try {
                                    channel.stopListening('CommentCreated', boundListener);
                                } catch (error) {
                                    console.error('Error cleaning up Echo listener:', error);
                                }
                            };
                        } catch (error) {
                            console.error('Error initializing Echo channel:', error);
                        }
                    },

                    handleNewComment(e) {
                        if (!this.comments.find(c => c.id === e.comment.id)) {
                            this.comments.unshift(e.comment);
                        }
                    },

                    async submit() {
                        if (!this.newComment.content.trim() || this.sending) return;

                        this.sending = true;
                        const commentData = {
                            content: this.newComment.content,
                            parent_id: this.newComment.parent_id
                        };

                        try {
                            const response = await this.postComment(commentData);
                            this.newComment.content = '';
                            this.newComment.parent_id = null;

                            if (!this.comments.find(c => c.id === response.comment.id)) {
                                this.comments.unshift(response.comment);
                            }
                        } catch (error) {
                            console.error('Error posting comment:', error);
                            alert(error.message || 'Failed to post comment. Please try again.');
                        } finally {
                            this.sending = false;
                        }
                    },

                    async submitReply(event, parentComment) {
                        const form = event.target;
                        const formData = new FormData(form);
                        const content = formData.get('content');

                        if (!content.trim()) return;

                        this.errorMessage = null; // Reset pesan error

                        const replyData = {
                            content: content,
                            parent_id: parentComment.id
                        };

                        try {
                            const response = await this.postComment(replyData);

                            if (!parentComment.replies) {
                                parentComment.replies = [];
                            }
                            parentComment.replies.push(response.comment);

                            form.reset();

                        } catch (error) {
                            this.errorMessage = error.message || 'Gagal mengirim balasan. Silakan coba lagi.';
                            console.error('Error posting reply:', error);
                        }
                    },

                    async postComment(data) {
                        try {
                            const tokenElement = document.querySelector('meta[name="csrf-token"]');
                            if (!tokenElement) {
                                throw new Error('CSRF token not found. Please refresh the page.');
                            }

                            const token = tokenElement.getAttribute('content');
                            const response = await fetch(`/posts/${this.postId}/comments`, {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': token,
                                    'Accept': 'application/json'
                                },
                                body: JSON.stringify(data)
                            });

                            if (!response.ok) {
                                throw new Error(`HTTP error! status: ${response.status}`);
                            }

                            return response.json();
                        } catch (error) {
                            console.error('Error in postComment:', error);
                            throw new Error(error.message || 'Failed to post comment. Please try again.');
                        }
                    },

                    async loadMore() {
                        if (!this.hasMore || this.loadingMore) return;

                        this.loadingMore = true;
                        try {
                            const response = await fetch(`/api/posts/${this.postId}/comments?page=${this.page + 1}`);
                            const data = await response.json();

                            if (!data.data || data.data.length === 0) {
                                this.hasMore = false;
                            } else {
                                const newComments = data.data.filter(
                                    newComment => !this.comments.find(c => c.id === newComment.id)
                                );
                                this.comments.push(...newComments);
                                this.page++;
                            }
                        } catch (error) {
                            console.error('Error loading more comments:', error);
                            alert('Failed to load more comments.');
                        } finally {
                            this.loadingMore = false;
                        }
                    }
                }
            }
        </script>
    @endpush
</x-layout>
