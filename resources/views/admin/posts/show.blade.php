<x-admin-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
            <div class="flex-1 min-w-0">
                <nav class="flex mb-2" aria-label="Breadcrumb">
                    <ol class="inline-flex items-center space-x-1 md:space-x-3">
                        <li class="inline-flex items-center">
                            <a href="{{ route('admin.posts.index') }}"
                                class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600">
                                <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path
                                        d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z">
                                    </path>
                                </svg>
                                Postingan
                            </a>
                        </li>
                        <li>
                            <div class="flex items-center">
                                <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                        clip-rule="evenodd"></path>
                                </svg>
                                <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2">Detail</span>
                            </div>
                        </li>
                    </ol>
                </nav>
                <h2 class="text-xl font-semibold text-gray-900 truncate sm:text-2xl" title="{{ $post->title }}">
                    {{ $post->title }}
                </h2>
            </div>

            <!-- Status Badge -->
            <div class="mt-3 sm:mt-0 sm:ml-4">
                @if ($post->status === 'pending')
                    <span
                        class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-yellow-100 text-yellow-800">
                        <svg class="w-4 h-4 mr-1.5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                                clip-rule="evenodd"></path>
                        </svg>
                        Pending
                    </span>
                @elseif ($post->status === 'approved')
                    <span
                        class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800">
                        <svg class="w-4 h-4 mr-1.5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                clip-rule="evenodd"></path>
                        </svg>
                        Disetujui
                    </span>
                @elseif ($post->status === 'rejected')
                    <span
                        class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-red-100 text-red-800">
                        <svg class="w-4 h-4 mr-1.5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                                clip-rule="evenodd"></path>
                        </svg>
                        Ditolak
                    </span>
                @endif
            </div>
        </div>
    </x-slot>

    <div class="py-6 sm:py-12">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Main Content Card -->
            <div class="bg-white shadow-xl rounded-lg overflow-hidden">
                <!-- Post Image -->
                @if ($post->image)
                    <div class="aspect-w-16 aspect-h-9 sm:aspect-h-6">
                        <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->title }}"
                            class="w-full h-64 sm:h-80 object-cover">
                    </div>
                @endif

                <!-- Post Content -->
                <div class="p-6 sm:p-8">
                    <!-- Post Meta -->
                    <div class="mb-6 pb-4 border-b border-gray-200">
                        <div
                            class="flex flex-col sm:flex-row sm:items-center sm:justify-between space-y-3 sm:space-y-0">
                            <!-- Author Info -->
                            <div class="flex items-center space-x-3">
                                <div class="flex-shrink-0">
                                    <div class="h-10 w-10 rounded-full bg-indigo-100 flex items-center justify-center">
                                        <span class="text-sm font-semibold text-indigo-700">
                                            {{ strtoupper(substr($post->author->name, 0, 2)) }}
                                        </span>
                                    </div>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-900">{{ $post->author->name }}</p>
                                    <p class="text-xs text-gray-500">Penulis</p>
                                </div>
                            </div>

                            <!-- Post Meta Info -->
                            <div class="flex flex-col sm:items-end space-y-1">
                                <div class="flex items-center text-sm text-gray-500">
                                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z"
                                            clip-rule="evenodd"></path>
                                    </svg>
                                    {{ $post->created_at->format('d M Y, H:i') }}
                                </div>
                                @if ($post->updated_at != $post->created_at)
                                    <div class="flex items-center text-xs text-gray-400">
                                        <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M4 2a1 1 0 011 1v2.101a7.002 7.002 0 0111.601 2.566 1 1 0 11-1.885.666A5.002 5.002 0 005.999 7H9a1 1 0 010 2H4a1 1 0 01-1-1V3a1 1 0 011-1zm.008 9.057a1 1 0 011.276.61A5.002 5.002 0 0014.001 13H11a1 1 0 110-2h5a1 1 0 011 1v5a1 1 0 11-2 0v-2.101a7.002 7.002 0 01-11.601-2.566 1 1 0 01.61-1.276z"
                                                clip-rule="evenodd"></path>
                                        </svg>
                                        Diperbarui {{ $post->updated_at->format('d M Y, H:i') }}
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Post Title -->
                    <h1 class="text-2xl sm:text-3xl font-bold text-gray-900 mb-6 leading-tight">
                        {{ $post->title }}
                    </h1>

                    <!-- Post Content -->
                    <div
                        class="prose prose-lg max-w-none prose-headings:text-gray-900 prose-a:text-indigo-600 prose-strong:text-gray-900">
                        {!! $post->body !!}
                    </div>
                </div>

                <!-- Action Buttons for Pending Posts -->
                @if ($post->status === 'pending')
                    <div class="bg-gray-50 px-6 py-4 sm:px-8 sm:py-6 border-t border-gray-200">
                        <div class="flex flex-col sm:flex-row space-y-3 sm:space-y-0 sm:space-x-4">
                            <h4 class="text-sm font-medium text-gray-900 sm:flex-1">
                                Tindakan yang diperlukan:
                            </h4>
                            <div class="flex flex-col sm:flex-row space-y-3 sm:space-y-0 sm:space-x-3">
                                <!-- Approve Button -->
                                <form action="{{ route('admin.posts.update', $post) }}" method="POST"
                                    class="inline-block">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="action" value="approve">
                                    <button type="button"
                                        onclick="
                                            Swal.fire({
                                                title: 'Setujui Postingan?',
                                                text: 'Postingan ini akan dipublikasikan ke publik.',
                                                icon: 'question',
                                                showCancelButton: true,
                                                confirmButtonColor: '#057a55',
                                                cancelButtonColor: '#d33',
                                                confirmButtonText: 'Ya, Setujui!',
                                                cancelButtonText: 'Batal'
                                            }).then((result) => {
                                                if (result.isConfirmed) {
                                                    this.closest('form').submit();
                                                }
                                            })
                                        "
                                        class="w-full sm:w-auto inline-flex items-center justify-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition-colors duration-200">
                                        <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                                clip-rule="evenodd"></path>
                                        </svg>
                                        Setujui Postingan
                                    </button>
                                </form>

                                <!-- Reject Button -->
                                <form action="{{ route('admin.posts.update', $post) }}" method="POST"
                                    class="inline-block">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="action" value="reject">
                                    <button type="button"
                                        onclick="
                                            Swal.fire({
                                                title: 'Tolak Postingan?',
                                                text: 'Postingan ini akan ditolak dan penulis akan diberitahu.',
                                                icon: 'warning',
                                                showCancelButton: true,
                                                confirmButtonColor: '#d33',
                                                cancelButtonColor: '#3085d6',
                                                confirmButtonText: 'Ya, Tolak!',
                                                cancelButtonText: 'Batal'
                                            }).then((result) => {
                                                if (result.isConfirmed) {
                                                    this.closest('form').submit();
                                                }
                                            })
                                        "
                                        class="w-full sm:w-auto inline-flex items-center justify-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition-colors duration-200">
                                        <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                                clip-rule="evenodd"></path>
                                        </svg>
                                        Tolak Postingan
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endif
            </div>

            <!-- Back Button -->
            <div class="mt-6 flex justify-start">
                <a href="{{ route('admin.posts.index') }}"
                    class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors duration-200">
                    <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z"
                            clip-rule="evenodd"></path>
                    </svg>
                    Kembali ke Daftar
                </a>
            </div>
        </div>
    </div>
</x-admin-layout>
