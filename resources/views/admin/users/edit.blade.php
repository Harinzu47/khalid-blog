<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Edit Peran: <span class="text-indigo-600">{{ $user->name }}</span>
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
                    <div class="mt-8 text-2xl">
                        Kelola Peran untuk Pengguna
                    </div>
                    <p class="mt-2 text-gray-600">
                        Pilih satu atau lebih peran untuk pengguna ini. Peran menentukan hak akses dan fitur yang dapat
                        diakses oleh pengguna.
                    </p>
                </div>

                <div class="p-6 sm:px-20 bg-white">
                    <form action="{{ route('admin.users.update', $user) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-6">
                            <label for="roles" class="block mb-2 text-sm font-bold text-gray-700">Pilih
                                Peran:</label>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                @foreach ($roles as $role)
                                    <label
                                        class="flex items-center space-x-3 bg-gray-100 p-4 rounded-lg shadow-sm cursor-pointer hover:bg-gray-200 transition-colors">
                                        <input type="checkbox" name="roles[]" value="{{ $role->id }}"
                                            class="form-checkbox h-5 w-5 text-indigo-600 rounded-md"
                                            {{ $user->roles->contains($role) ? 'checked' : '' }}>
                                        <span class="text-gray-800 text-sm font-medium">{{ $role->name }}</span>
                                    </label>
                                @endforeach
                            </div>
                            @error('roles')
                                <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex items-center justify-end">
                            <a href="{{ route('admin.users.index') }}"
                                class="mr-4 text-gray-600 hover:text-gray-900 transition-colors">Batal</a>
                            <button type="submit"
                                class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-all">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7"></path>
                                </svg>
                                Simpan Perubahan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
