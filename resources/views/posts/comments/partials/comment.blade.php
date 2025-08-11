{{-- resources/views/posts/comments/partials/comment.blade.php --}}

{{-- Gunakan x-data di div terluar untuk mengelola state --}}
<div x-data="{ showReplyForm: false }" class="mb-4">

    {{-- Konten komentar utama, di-render oleh Blade --}}
    <div class="flex @if ($comment->parent_id) mt-6 pl-10 border-l border-gray-200 @endif"
        id="comment-{{ $comment->id }}">
        <div class="flex-shrink-0 mr-3">
            <img class="w-10 h-10 rounded-full"
                src="{{ $comment->user->avatar ? asset('storage/' . $comment->user->avatar) : asset('img/default-avatar.png') }}"
                alt="{{ $comment->user->name }}">
        </div>

        <div class="flex-1">
            <div class="bg-gray-50 dark:bg-gray-800 rounded-lg p-4">
                <div class="flex items-center justify-between mb-2">
                    <span class="text-sm font-bold text-gray-900 dark:text-white">{{ $comment->user->name }}</span>
                    <span class="text-xs text-gray-500">{{ $comment->created_at->format('M d, Y, H:i') }}</span>
                </div>
                <div class="prose prose-sm dark:prose-invert max-w-none">
                    {!! $comment->content_html !!}
                </div>
            </div>

            {{-- Tombol Balas yang menggunakan Alpine.js untuk toggle form --}}
            <div class="mt-2 flex items-center text-sm text-gray-500 space-x-4">
                <button class="flex items-center space-x-1 hover:text-blue-600 transition-colors duration-200"
                    @click="showReplyForm = !showReplyForm">
                    <span>Balas</span>
                </button>
            </div>

            {{-- Form Balasan yang dikelola oleh Alpine.js --}}
            <div x-show="showReplyForm" x-collapse.duration.500ms class="mt-4 pl-4 border-l border-gray-200">
                @auth
                    <form id="reply-form-{{ $comment->id }}" @submit.prevent="submitReply($el, {{ $comment->id }})">
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
                        <a href="{{ route('login') }}" class="text-blue-600 hover:underline">Masuk</a> untuk membalas.
                    </p>
                @endauth
            </div>
        </div>
    </div>

    {{-- Loop untuk balasan, di-render oleh Blade --}}
    @if ($comment->replies->count())
        <div class="mt-4 space-y-4">
            @foreach ($comment->replies as $reply)
                <div class="pl-10 border-l border-gray-200">
                    @include('posts.comments.partials.comment', ['comment' => $reply])
                </div>
            @endforeach
        </div>
    @endif
</div>
