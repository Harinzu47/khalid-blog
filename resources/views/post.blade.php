<x-layout :title="$title">
    <div class="max-w-7xl mx-auto my-10 px-4 sm:px-6 lg:px-8 py-8">
        
        <!-- Breadcrumb -->
        <nav class="flex mb-8" aria-label="Breadcrumb">
          <ol class="inline-flex items-center space-x-1 md:space-x-3">
            <li class="inline-flex items-center">
              <a href="/" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-red-600 transition-colors">
                <svg class="w-3 h-3 mr-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                  <path d="m19.707 9.293-2-2-7-7a1 1 0 0 0-1.414 0l-7 7-2 2a1 1 0 0 0 1.414 1.414L2 10.414V18a2 2 0 0 0 2 2h3a1 1 0 0 0 1-1v-4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v4a1 1 0 0 0 1 1h3a2 2 0 0 0 2-2v-7.586l.293.293a1 1 0 0 0 1.414-1.414Z"/>
                </svg>
                Home
              </a>
            </li>
            <li>
              <div class="flex items-center">
                <svg class="w-3 h-3 text-gray-400 mx-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                  <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                </svg>
                <a href="/posts" class="ml-1 text-sm font-medium text-gray-700 hover:text-red-600 md:ml-2 transition-colors">Blog</a>
              </div>
            </li>
            <li aria-current="page">
              <div class="flex items-center">
                <svg class="w-3 h-3 text-gray-400 mx-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                  <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                </svg>
                <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2 truncate max-w-xs">{{ Str::limit($post->title, 20) }}</span>
              </div>
            </li>
          </ol>
        </nav>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
            <!-- Main Content -->
            <div class="lg:col-span-2 bg-white rounded-2xl shadow-sm border border-gray-100 p-6 md:p-8">
                @if ($post->image)
                    <div class="mb-8 relative rounded-xl overflow-hidden shadow-md group">
                        <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->title }}"
                            class="w-full h-auto object-cover transform transition-transform duration-700 group-hover:scale-105">
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
                                {{ $post->author->bio ?? 'Penulis belum menambahkan bio.' }}
                            </p>
                        </div>
                    </div>
                </div>

                <div id="comments-section" class="mt-12"
                    x-data='commentsComponent({{ $post->id }}, @json($comments->items()), {{ $comments->hasMorePages() }})'>
                    <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-6">
                        Komentar (<span x-text="commentsCount"></span>)
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
                                <div x-show="errorMessage" x-text="errorMessage" class="text-red-500 mb-4"></div>
                                <button type="submit"
                                    class="bg-blue-600 text-white font-medium py-2 px-4 rounded-lg hover:bg-blue-700 transition duration-150 ease-in-out"
                                    :disabled="sending">
                                    <span x-show="!sending">Kirim Komentar</span>
                                    <span x-show="sending">Mengirim...</span>
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
                            <div>
                                <div x-data="{ showReplyForm: false }" class="flex"
                                    :class="{ 'mt-6 pl-10 border-l border-gray-200': comment.parent_id !== null }"
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
                                            @auth
                                                <button
                                                    class="flex items-center space-x-1 hover:text-blue-600 transition-colors duration-200"
                                                    @click="showReplyForm = !showReplyForm">
                                                    <span>Balas</span>
                                                </button>
                                            @else
                                                <a href="{{ route('login') }}" class="hover:text-blue-600">Balas</a>
                                            @endauth
                                        </div>

                                        <div x-show="showReplyForm" x-collapse.duration.500ms
                                            class="mt-4 pl-4 border-l-2 border-red-100">
                                            @auth
                                                <form @submit.prevent="submitReply($event, comment)">
                                                    @csrf
                                                    <div class="mb-3">
                                                        <textarea name="content"
                                                            class="w-full p-3 text-sm border border-gray-200 rounded-xl focus:ring-red-500 focus:border-red-500 bg-white"
                                                            rows="3" placeholder="Tulis balasan Anda..."></textarea>
                                                    </div>
                                                    <div x-show="replyErrorMessage" x-text="replyErrorMessage"
                                                        class="text-red-500 text-sm mb-3"></div>
                                                    <button type="submit"
                                                        class="bg-red-600 text-white font-medium py-1.5 px-4 rounded-lg text-sm hover:bg-red-700 transition-colors shadow-sm">
                                                        Kirim Balasan
                                                    </button>
                                                </form>
                                            @endauth
                                        </div>

                                        {{-- Rekursif untuk menampilkan balasan --}}
                                        <template x-if="comment.replies_count > 0">
                                            <div class="mt-4 space-y-4">
                                                <template x-for="reply in comment.replies" :key="reply.id">
                                                    <div class="pl-10 border-l border-gray-200">
                                                        <div class="flex">
                                                            <div class="flex-shrink-0 mr-3">
                                                                <img class="w-8 h-8 rounded-full"
                                                                    :src="reply.user.avatar ? '/storage/' + reply.user
                                                                        .avatar :
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

            <!-- Sidebar -->
            <div class="lg:col-span-1 space-y-8 sticky top-24 self-start h-fit">
                <!-- Recent Posts -->
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                    <h3 class="text-lg font-bold text-gray-900 mb-6 flex items-center">
                        <span class="w-1 h-6 bg-red-600 rounded-full mr-3"></span>
                        Recent Posts
                    </h3>
                    <div class="space-y-5">
                        @forelse($recentPosts as $recentPost)
                            <div class="group flex items-start space-x-4">
                                <div class="flex-shrink-0 overflow-hidden rounded-lg w-16 h-16 relative">
                                    <img src="{{ asset('storage/' . $recentPost->image) }}"
                                        alt="{{ $recentPost->title }}" 
                                        loading="lazy"
                                        class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-110">
                                </div>
                                <div class="flex-1 min-w-0">
                                    <h4 class="text-sm font-semibold text-gray-900 group-hover:text-red-600 transition-colors line-clamp-2 leading-snug">
                                        <a href="{{ route('posts.show', $recentPost->slug) }}">
                                            {{ $recentPost->title }}
                                        </a>
                                    </h4>
                                    <p class="text-xs text-gray-500 mt-1">
                                        {{ $recentPost->created_at->format('M d, Y') }}
                                    </p>
                                </div>
                            </div>
                        @empty
                            <p class="text-gray-500 text-sm">No recent posts available.</p>
                        @endforelse
                    </div>
                </div>

                <!-- Topics -->
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                    <h3 class="text-lg font-bold text-gray-900 mb-6 flex items-center">
                        <span class="w-1 h-6 bg-red-600 rounded-full mr-3"></span>
                        Explore Topics
                    </h3>
                    <div class="space-y-3">
                        @foreach ($categories as $category)
                            <a href="/posts?category={{ $category->slug }}"
                                class="flex justify-between items-center group p-2 rounded-lg hover:bg-gray-50 transition-colors">
                                <span class="text-gray-700 font-medium group-hover:text-red-600 transition-colors">
                                    {{ $category->name }}
                                </span>
                                <span class="text-xs font-semibold bg-gray-100 text-gray-500 py-1 px-2.5 rounded-full group-hover:bg-red-50 group-hover:text-red-600 transition-colors">
                                    {{ $category->posts_count }}
                                </span>
                            </a>
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
                    errorMessage: null,
                    replyErrorMessage: null,
                    commentsCount: initialComments.length, // Tambahkan properti untuk menghitung komentar

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
                        // Tambahkan validasi agar tidak ada duplikasi
                        if (!this.comments.find(c => c.id === e.comment.id)) {
                            this.comments.unshift(e.comment);
                            this.commentsCount = this.comments.length;
                        }
                    },

                    async submit() {
                        if (!this.newComment.content.trim() || this.sending) return;

                        this.sending = true;
                        this.errorMessage = null; // Reset pesan error
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
                                this.commentsCount = this.comments.length;
                            }
                        } catch (error) {
                            console.error('Error posting comment:', error);
                            this.errorMessage = error.message || 'Gagal mengirim komentar. Silakan coba lagi.';
                        } finally {
                            this.sending = false;
                        }
                    },

                    async submitReply(event, parentComment) {
                        const form = event.target;
                        const formData = new FormData(form);
                        const content = formData.get('content');

                        if (!content.trim()) return;

                        this.replyErrorMessage = null; // Reset pesan error

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
                            parentComment.replies_count++;

                            form.reset();

                        } catch (error) {
                            this.replyErrorMessage = error.message || 'Gagal mengirim balasan. Silakan coba lagi.';
                            console.error('Error posting reply:', error);
                        }
                    },

                    async postComment(data) {
                        try {
                            const response = await fetch(`/posts/${this.postId}/comments`, {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                                        'content'),
                                    'Accept': 'application/json'
                                },
                                body: JSON.stringify(data)
                            });

                            if (!response.ok) {
                                // Perbaikan: Ambil pesan error dari respons JSON jika ada
                                const errorData = await response.json();
                                throw new Error(errorData.message || `HTTP error! status: ${response.status}`);
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
                        } finally {
                            this.loadingMore = false;
                        }
                    }
                }
            }
        </script>
    @endpush
</x-layout>
