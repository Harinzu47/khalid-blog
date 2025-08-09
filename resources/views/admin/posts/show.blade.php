<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Lihat Postingan: {{ $post->title }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-medium mb-4">{{ $post->title }}</h3>
                    <p class="text-sm text-gray-600 mb-4">
                        Ditulis oleh: {{ $post->author->name }} |
                        Status: <span
                            class="font-semibold text-{{ $post->status === 'approved' ? 'green' : ($post->status === 'rejected' ? 'red' : 'yellow') }}-600">{{ ucfirst($post->status) }}</span>
                    </p>

                    <div class="prose max-w-none">
                        {!! $post->body !!}
                    </div>

                    @if ($post->status === 'pending')
                        <div class="mt-6 border-t border-gray-200 pt-6 flex space-x-4">
                            <form action="{{ route('admin.posts.update', $post) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="action" value="approve">
                                <button type="submit"
                                    class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded-md">
                                    Setujui
                                </button>
                            </form>
                            <form action="{{ route('admin.posts.update', $post) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="action" value="reject">
                                <button type="submit"
                                    class="bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-4 rounded-md">
                                    Tolak
                                </button>
                            </form>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
