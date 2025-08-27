<x-admin-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-bold text-2xl text-gray-900 tracking-tight">
                Kelola Komentar
            </h2>
            <div class="text-sm text-gray-500">
                Total: {{ $comments->total() }} komentar
            </div>
        </div>
    </x-slot>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Success Alert -->
        @if (session('success'))
            <div class="mb-6 bg-green-50 border border-green-200 rounded-lg p-4 flex items-center">
                <svg class="w-5 h-5 text-green-400 mr-2" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd"
                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                        clip-rule="evenodd"></path>
                </svg>
                <span class="text-green-800 font-medium">{{ session('success') }}</span>
            </div>
        @endif

        <!-- Filter Buttons -->
        <div class="mb-8 bg-white rounded-lg shadow-sm border border-gray-200 p-1 inline-flex">
            <a href="{{ route('admin.comments.index', ['status' => \App\Models\Comment::STATUS_PENDING]) }}"
                class="inline-flex items-center px-4 py-2 text-sm font-medium rounded-md transition-colors duration-200 
                       {{ request('status') === \App\Models\Comment::STATUS_PENDING ? 'bg-yellow-100 text-yellow-800 border border-yellow-200' : 'text-gray-600 hover:text-yellow-600 hover:bg-yellow-50' }}">
                <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd"
                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z"
                        clip-rule="evenodd"></path>
                </svg>
                Pending
            </a>
            <a href="{{ route('admin.comments.index', ['status' => \App\Models\Comment::STATUS_PUBLISHED]) }}"
                class="inline-flex items-center px-4 py-2 text-sm font-medium rounded-md transition-colors duration-200 
                       {{ request('status') === \App\Models\Comment::STATUS_PUBLISHED ? 'bg-green-100 text-green-800 border border-green-200' : 'text-gray-600 hover:text-green-600 hover:bg-green-50' }}">
                <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd"
                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                        clip-rule="evenodd"></path>
                </svg>
                Published
            </a>
            <a href="{{ route('admin.comments.index', ['status' => \App\Models\Comment::STATUS_HIDDEN]) }}"
                class="inline-flex items-center px-4 py-2 text-sm font-medium rounded-md transition-colors duration-200 
                       {{ request('status') === \App\Models\Comment::STATUS_HIDDEN ? 'bg-orange-100 text-orange-800 border border-orange-200' : 'text-gray-600 hover:text-orange-600 hover:bg-orange-50' }}">
                <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                    <path
                        d="M3.707 2.293a1 1 0 00-1.414 1.414l14 14a1 1 0 001.414-1.414l-1.473-1.473A10.014 10.014 0 0019.542 10C18.268 5.943 14.478 3 10 3a9.958 9.958 0 00-4.512 1.074l-1.78-1.781zm4.261 4.26l1.514 1.515a2.003 2.003 0 012.45 2.45l1.514 1.514a4 4 0 00-5.478-5.478z">
                    </path>
                    <path
                        d="M12.454 16.697L9.75 13.992a4 4 0 01-3.742-3.741L2.335 6.578A9.98 9.98 0 00.458 10c1.274 4.057 5.065 7 9.542 7 .847 0 1.669-.105 2.454-.303z">
                    </path>
                </svg>
                Hidden
            </a>
            <a href="{{ route('admin.comments.index', ['status' => \App\Models\Comment::STATUS_DELETED]) }}"
                class="inline-flex items-center px-4 py-2 text-sm font-medium rounded-md transition-colors duration-200 
                       {{ request('status') === \App\Models\Comment::STATUS_DELETED ? 'bg-red-100 text-red-800 border border-red-200' : 'text-gray-600 hover:text-red-600 hover:bg-red-50' }}">
                <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z" clip-rule="evenodd"></path>
                    <path fill-rule="evenodd"
                        d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                        clip-rule="evenodd"></path>
                </svg>
                Deleted
            </a>
        </div>

        <!-- Comments Table -->
        <div class="bg-white shadow-sm rounded-lg border border-gray-200 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col"
                                class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                ID
                            </th>
                            <th scope="col"
                                class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                User
                            </th>
                            <th scope="col"
                                class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                Komentar
                            </th>
                            <th scope="col"
                                class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                Post
                            </th>
                            <th scope="col"
                                class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                Status
                            </th>
                            <th scope="col"
                                class="px-6 py-4 text-right text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                Aksi
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($comments as $comment)
                            <tr class="hover:bg-gray-50 transition-colors duration-200">
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-mono text-gray-500">
                                    #{{ $comment->id }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div
                                            class="w-8 h-8 bg-gradient-to-br from-blue-400 to-blue-600 rounded-full flex items-center justify-center text-white text-sm font-semibold">
                                            {{ strtoupper(substr($comment->user->name, 0, 1)) }}
                                        </div>
                                        <div class="ml-3">
                                            <div class="text-sm font-medium text-gray-900">{{ $comment->user->name }}
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="text-sm text-gray-900 max-w-xs">
                                        <p class="truncate" title="{{ $comment->content }}">
                                            {{ Str::limit($comment->content, 80) }}</p>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <a href="{{ route('posts.show', $comment->post->slug) }}" target="_blank"
                                        class="text-sm text-blue-600 hover:text-blue-800 hover:underline transition-colors duration-200"
                                        title="{{ $comment->post->title }}">
                                        {{ Str::limit($comment->post->title, 30) }}
                                        <svg class="inline w-3 h-3 ml-1" fill="currentColor" viewBox="0 0 20 20">
                                            <path
                                                d="M11 3a1 1 0 100 2h2.586l-6.293 6.293a1 1 0 101.414 1.414L15 6.414V9a1 1 0 102 0V4a1 1 0 00-1-1h-5z">
                                            </path>
                                            <path
                                                d="M5 5a2 2 0 00-2 2v8a2 2 0 002 2h8a2 2 0 002-2v-3a1 1 0 10-2 0v3H5V7h3a1 1 0 000-2H5z">
                                            </path>
                                        </svg>
                                    </a>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @php
                                        $statusConfig = [
                                            \App\Models\Comment::STATUS_PENDING => [
                                                'bg-yellow-100',
                                                'text-yellow-800',
                                                'border-yellow-200',
                                            ],
                                            \App\Models\Comment::STATUS_PUBLISHED => [
                                                'bg-green-100',
                                                'text-green-800',
                                                'border-green-200',
                                            ],
                                            \App\Models\Comment::STATUS_HIDDEN => [
                                                'bg-orange-100',
                                                'text-orange-800',
                                                'border-orange-200',
                                            ],
                                            \App\Models\Comment::STATUS_DELETED => [
                                                'bg-red-100',
                                                'text-red-800',
                                                'border-red-200',
                                            ],
                                        ];
                                        $config = $statusConfig[$comment->status] ?? [
                                            'bg-gray-100',
                                            'text-gray-800',
                                            'border-gray-200',
                                        ];
                                    @endphp
                                    <span
                                        class="inline-flex px-2 py-1 text-xs font-semibold rounded-md border {{ implode(' ', $config) }}">
                                        {{ ucfirst($comment->status) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <div class="flex items-center justify-end space-x-2">
                                        @if ($comment->status === \App\Models\Comment::STATUS_PENDING || $comment->status === \App\Models\Comment::STATUS_HIDDEN)
                                            <form action="{{ route('admin.comments.publish', $comment) }}"
                                                method="POST" class="inline">
                                                @csrf
                                                <button type="submit"
                                                    class="inline-flex items-center px-3 py-1.5 bg-green-600 text-white text-xs font-medium rounded-md hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition-colors duration-200">
                                                    <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                        <path fill-rule="evenodd"
                                                            d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                                            clip-rule="evenodd"></path>
                                                    </svg>
                                                    Publish
                                                </button>
                                            </form>
                                        @endif

                                        @if ($comment->status === \App\Models\Comment::STATUS_PUBLISHED)
                                            <button type="button"
                                                onclick="showHideModal({{ $comment->id }}, '{{ $comment->user->name }}', '{{ Str::limit($comment->content, 50) }}')"
                                                class="inline-flex items-center px-3 py-1.5 bg-orange-600 text-white text-xs font-medium rounded-md hover:bg-orange-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange-500 transition-colors duration-200">
                                                <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                    <path
                                                        d="M3.707 2.293a1 1 0 00-1.414 1.414l14 14a1 1 0 001.414-1.414l-1.473-1.473A10.014 10.014 0 0019.542 10C18.268 5.943 14.478 3 10 3a9.958 9.958 0 00-4.512 1.074l-1.78-1.781zm4.261 4.26l1.514 1.515a2.003 2.003 0 012.45 2.45l1.514 1.514a4 4 0 00-5.478-5.478z">
                                                    </path>
                                                </svg>
                                                Hide
                                            </button>
                                        @endif

                                        @if ($comment->status !== \App\Models\Comment::STATUS_DELETED)
                                            <button type="button"
                                                onclick="showDeleteModal({{ $comment->id }}, '{{ $comment->user->name }}', '{{ Str::limit($comment->content, 50) }}')"
                                                class="inline-flex items-center px-3 py-1.5 bg-red-600 text-white text-xs font-medium rounded-md hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition-colors duration-200">
                                                <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z"
                                                        clip-rule="evenodd"></path>
                                                    <path fill-rule="evenodd"
                                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                                                        clip-rule="evenodd"></path>
                                                </svg>
                                                Delete
                                            </button>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-12 text-center">
                                    <div class="flex flex-col items-center">
                                        <svg class="w-12 h-12 text-gray-400 mb-4" fill="none"
                                            stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z">
                                            </path>
                                        </svg>
                                        <h3 class="text-lg font-medium text-gray-900 mb-2">Tidak ada komentar</h3>
                                        <p class="text-gray-500">Belum ada komentar dengan status ini.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Pagination -->
        @if ($comments->hasPages())
            <div class="mt-6 flex justify-center">
                <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-3">
                    <nav class="flex items-center justify-between">
                        <div class="flex items-center">
                            <p class="text-sm text-gray-700">
                                Menampilkan
                                <span class="font-medium">{{ $comments->firstItem() }}</span>
                                sampai
                                <span class="font-medium">{{ $comments->lastItem() }}</span>
                                dari
                                <span class="font-medium">{{ $comments->total() }}</span>
                                hasil
                            </p>
                        </div>
                        <div class="flex items-center space-x-2">
                            {{-- Previous Button --}}
                            @if ($comments->onFirstPage())
                                <span
                                    class="px-3 py-2 text-sm font-medium text-gray-400 bg-gray-100 rounded-md cursor-not-allowed">
                                    Sebelumnya
                                </span>
                            @else
                                <a href="{{ $comments->appends(request()->query())->previousPageUrl() }}"
                                    class="px-3 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-200">
                                    Sebelumnya
                                </a>
                            @endif

                            {{-- Page Numbers --}}
                            @php
                                $start = max($comments->currentPage() - 2, 1);
                                $end = min($start + 4, $comments->lastPage());
                                $start = max($end - 4, 1);
                            @endphp

                            @if ($start > 1)
                                <a href="{{ $comments->appends(request()->query())->url(1) }}"
                                    class="px-3 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-200">
                                    1
                                </a>
                                @if ($start > 2)
                                    <span class="px-3 py-2 text-sm font-medium text-gray-400">...</span>
                                @endif
                            @endif

                            @for ($i = $start; $i <= $end; $i++)
                                @if ($i == $comments->currentPage())
                                    <span class="px-3 py-2 text-sm font-medium text-white bg-blue-600 rounded-md">
                                        {{ $i }}
                                    </span>
                                @else
                                    <a href="{{ $comments->appends(request()->query())->url($i) }}"
                                        class="px-3 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-200">
                                        {{ $i }}
                                    </a>
                                @endif
                            @endfor

                            @if ($end < $comments->lastPage())
                                @if ($end < $comments->lastPage() - 1)
                                    <span class="px-3 py-2 text-sm font-medium text-gray-400">...</span>
                                @endif
                                <a href="{{ $comments->appends(request()->query())->url($comments->lastPage()) }}"
                                    class="px-3 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-200">
                                    {{ $comments->lastPage() }}
                                </a>
                            @endif

                            {{-- Next Button --}}
                            @if ($comments->hasMorePages())
                                <a href="{{ $comments->appends(request()->query())->nextPageUrl() }}"
                                    class="px-3 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-200">
                                    Selanjutnya
                                </a>
                            @else
                                <span
                                    class="px-3 py-2 text-sm font-medium text-gray-400 bg-gray-100 rounded-md cursor-not-allowed">
                                    Selanjutnya
                                </span>
                            @endif
                        </div>
                    </nav>
                </div>
            </div>
        @endif
    </div>

    <!-- Hidden Forms for Actions -->
    @foreach ($comments as $comment)
        <form id="hideForm{{ $comment->id }}" action="{{ route('admin.comments.hide', $comment) }}" method="POST"
            style="display: none;">
            @csrf
        </form>
        <form id="deleteForm{{ $comment->id }}" action="{{ route('admin.comments.delete', $comment) }}"
            method="POST" style="display: none;">
            @csrf
        </form>
    @endforeach

    <!-- Hide Comment Modal -->
    <div id="hideModal" class="fixed inset-0 z-50 hidden overflow-y-auto" aria-labelledby="modal-title"
        role="dialog" aria-modal="true">
        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"
                onclick="closeHideModal()"></div>
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
            <div
                class="relative inline-block align-bottom bg-white rounded-lg px-4 pt-5 pb-4 text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full sm:p-6">
                <div class="sm:flex sm:items-start">
                    <div
                        class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-orange-100 sm:mx-0 sm:h-10 sm:w-10">
                        <svg class="h-6 w-6 text-orange-600" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M3.98 8.223A10.477 10.477 0 001.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.45 10.45 0 0112 4.5c4.756 0 8.773 3.162 10.065 7.498a10.523 10.523 0 01-4.293 5.774M6.228 6.228L3 3m3.228 3.228l3.65 3.65m7.894 7.894L21 21m-3.228-3.228l-3.65-3.65m0 0a3 3 0 11-4.243-4.243m4.242 4.242L9.88 9.88" />
                        </svg>
                    </div>
                    <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                        <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">
                            Sembunyikan Komentar
                        </h3>
                        <div class="mt-2">
                            <p class="text-sm text-gray-500 mb-3">
                                Apakah Anda yakin ingin menyembunyikan komentar ini? Komentar akan tidak terlihat oleh
                                pengunjung tetapi masih dapat dipulihkan nanti.
                            </p>
                            <div class="bg-gray-50 rounded-lg p-3 border-l-4 border-orange-400">
                                <div class="flex items-start">
                                    <div class="flex-shrink-0">
                                        <div
                                            class="w-8 h-8 bg-gradient-to-br from-orange-400 to-orange-600 rounded-full flex items-center justify-center text-white text-sm font-semibold">
                                            <span id="hideUserInitial"></span>
                                        </div>
                                    </div>
                                    <div class="ml-3 min-w-0 flex-1">
                                        <p class="text-sm font-medium text-gray-900" id="hideUserName"></p>
                                        <p class="text-sm text-gray-600 mt-1" id="hideCommentContent"></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mt-5 sm:mt-4 sm:flex sm:flex-row-reverse">
                    <button type="button" onclick="confirmHide()"
                        class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-orange-600 text-base font-medium text-white hover:bg-orange-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange-500 sm:ml-3 sm:w-auto sm:text-sm transition-colors duration-200">
                        <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path
                                d="M3.707 2.293a1 1 0 00-1.414 1.414l14 14a1 1 0 001.414-1.414l-1.473-1.473A10.014 10.014 0 0019.542 10C18.268 5.943 14.478 3 10 3a9.958 9.958 0 00-4.512 1.074l-1.78-1.781zm4.261 4.26l1.514 1.515a2.003 2.003 0 012.45 2.45l1.514 1.514a4 4 0 00-5.478-5.478z">
                            </path>
                        </svg>
                        Sembunyikan
                    </button>
                    <button type="button" onclick="closeHideModal()"
                        class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:mt-0 sm:w-auto sm:text-sm transition-colors duration-200">
                        Batal
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Comment Modal -->
    <div id="deleteModal" class="fixed inset-0 z-50 hidden overflow-y-auto" aria-labelledby="modal-title"
        role="dialog" aria-modal="true">
        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"
                onclick="closeDeleteModal()"></div>
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
            <div
                class="relative inline-block align-bottom bg-white rounded-lg px-4 pt-5 pb-4 text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full sm:p-6">
                <div class="sm:flex sm:items-start">
                    <div
                        class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10">
                        <svg class="h-6 w-6 text-red-600" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z" />
                        </svg>
                    </div>
                    <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                        <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">
                            Hapus Komentar
                        </h3>
                        <div class="mt-2">
                            <p class="text-sm text-gray-500 mb-3">
                                <strong>Peringatan!</strong> Tindakan ini akan menghapus komentar secara permanen. Data
                                yang sudah dihapus tidak dapat dipulihkan kembali.
                            </p>
                            <div class="bg-red-50 rounded-lg p-3 border-l-4 border-red-400">
                                <div class="flex items-start">
                                    <div class="flex-shrink-0">
                                        <div
                                            class="w-8 h-8 bg-gradient-to-br from-red-400 to-red-600 rounded-full flex items-center justify-center text-white text-sm font-semibold">
                                            <span id="deleteUserInitial"></span>
                                        </div>
                                    </div>
                                    <div class="ml-3 min-w-0 flex-1">
                                        <p class="text-sm font-medium text-gray-900" id="deleteUserName"></p>
                                        <p class="text-sm text-gray-600 mt-1" id="deleteCommentContent"></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mt-5 sm:mt-4 sm:flex sm:flex-row-reverse">
                    <button type="button" onclick="confirmDelete()"
                        class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:ml-3 sm:w-auto sm:text-sm transition-colors duration-200">
                        <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z" clip-rule="evenodd">
                            </path>
                            <path fill-rule="evenodd"
                                d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                                clip-rule="evenodd"></path>
                        </svg>
                        Hapus Permanen
                    </button>
                    <button type="button" onclick="closeDeleteModal()"
                        class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:mt-0 sm:w-auto sm:text-sm transition-colors duration-200">
                        Batal
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        let currentCommentId = null;

        // Show Hide Modal
        function showHideModal(commentId, userName, commentContent) {
            currentCommentId = commentId;
            document.getElementById('hideUserName').textContent = userName;
            document.getElementById('hideCommentContent').textContent = commentContent;
            document.getElementById('hideUserInitial').textContent = userName.charAt(0).toUpperCase();
            document.getElementById('hideModal').classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        }

        // Close Hide Modal
        function closeHideModal() {
            document.getElementById('hideModal').classList.add('hidden');
            document.body.style.overflow = 'auto';
            currentCommentId = null;
        }

        // Confirm Hide
        function confirmHide() {
            if (currentCommentId) {
                document.getElementById('hideForm' + currentCommentId).submit();
            }
        }

        // Show Delete Modal
        function showDeleteModal(commentId, userName, commentContent) {
            currentCommentId = commentId;
            document.getElementById('deleteUserName').textContent = userName;
            document.getElementById('deleteCommentContent').textContent = commentContent;
            document.getElementById('deleteUserInitial').textContent = userName.charAt(0).toUpperCase();
            document.getElementById('deleteModal').classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        }

        // Close Delete Modal
        function closeDeleteModal() {
            document.getElementById('deleteModal').classList.add('hidden');
            document.body.style.overflow = 'auto';
            currentCommentId = null;
        }

        // Confirm Delete
        function confirmDelete() {
            if (currentCommentId) {
                document.getElementById('deleteForm' + currentCommentId).submit();
            }
        }

        // Close modal when pressing Escape key
        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape') {
                closeHideModal();
                closeDeleteModal();
            }
        });

        // Prevent modal from closing when clicking inside the modal content
        document.querySelectorAll('[id$="Modal"] > div > span + div').forEach(function(modal) {
            modal.addEventListener('click', function(event) {
                event.stopPropagation();
            });
        });
    </script>
</x-admin-layout>
