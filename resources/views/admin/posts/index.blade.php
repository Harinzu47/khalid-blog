<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Kelola Tulisan
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="mb-4 border-b border-gray-200">
                        <ul class="flex flex-wrap -mb-px text-sm font-medium text-center" id="myTab" role="tablist">
                            <li class="mr-2" role="presentation">
                                <a href="{{ route('admin.posts.index', ['status' => 'pending']) }}"
                                    class="inline-block p-4 border-b-2 rounded-t-lg {{ $status == 'pending' ? 'border-indigo-600 text-indigo-600' : 'border-transparent hover:text-gray-600 hover:border-gray-300' }}">
                                    Menunggu Persetujuan
                                </a>
                            </li>
                            <li class="mr-2" role="presentation">
                                <a href="{{ route('admin.posts.index', ['status' => 'approved']) }}"
                                    class="inline-block p-4 border-b-2 rounded-t-lg {{ $status == 'approved' ? 'border-indigo-600 text-indigo-600' : 'border-transparent hover:text-gray-600 hover:border-gray-300' }}">
                                    Disetujui
                                </a>
                            </li>
                            <li class="mr-2" role="presentation">
                                <a href="{{ route('admin.posts.index', ['status' => 'rejected']) }}"
                                    class="inline-block p-4 border-b-2 rounded-t-lg {{ $status == 'rejected' ? 'border-indigo-600 text-indigo-600' : 'border-transparent hover:text-gray-600 hover:border-gray-300' }}">
                                    Ditolak
                                </a>
                            </li>
                        </ul>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Judul</th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Penulis</th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Status</th>
                                    <th scope="col" class="relative px-6 py-3">
                                        <span class="sr-only">Aksi</span>
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse ($posts as $post)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $post->title }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $post->author->name }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span
                                                class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                                @if ($post->status === 'approved') bg-green-100 text-green-800
                                                @elseif($post->status === 'rejected') bg-red-100 text-red-800
                                                @else bg-yellow-100 text-yellow-800 @endif">
                                                {{ ucfirst($post->status ?? 'pending') }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                            @if ($post->status === 'pending' || is_null($post->status))
                                                <a href="{{ route('admin.posts.show', $post) }}"
                                                    class="text-indigo-600 hover:text-indigo-900 mr-2">Lihat &
                                                    Kelola</a>
                                            @else
                                                <a href="{{ route('admin.posts.show', $post) }}"
                                                    class="text-indigo-600 hover:text-indigo-900 mr-2">Lihat</a>
                                            @endif
                                            <form action="{{ route('admin.posts.destroy', $post) }}" method="POST"
                                                class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:text-red-900"
                                                    onclick="return confirm('Apakah Anda yakin ingin menghapus postingan ini?')">Hapus</button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="px-6 py-4 text-center text-gray-500">Tidak ada
                                            postingan.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-4">
                        {{ $posts->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
