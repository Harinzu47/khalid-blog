{{-- resources/views/admin/components/sidebar.blade.php --}}

<div class="h-full bg-red-900 flex flex-col">
    <!-- Header Sidebar -->
    <div class="flex items-center justify-between h-16 px-4 bg-red-800 flex-shrink-0">
        <a href="{{ route('admin.dashboard') }}" class="flex items-center space-x-2">
            <span class="text-xl font-bold text-white">Admin Panel</span>
        </a>

        <!-- Close button for mobile -->
        <button type="button" class="lg:hidden text-white hover:text-red-100 p-1 rounded-md transition-colors"
            onclick="closeSidebar()">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
        </button>
    </div>

    <!-- Navigation -->
    <nav class="flex-1 px-4 py-6 space-y-2 overflow-y-auto">
        <!-- Dashboard -->
        <a href="{{ route('admin.dashboard') }}"
            class="flex items-center px-4 py-3 text-sm font-medium rounded-lg transition-colors {{ request()->routeIs('admin.dashboard') ? 'bg-red-700 text-white' : 'text-red-100 hover:bg-red-700 hover:text-white' }}">
            <svg class="w-5 h-5 mr-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                stroke-width="1.5" stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="m2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
            </svg>

            <span class="truncate">Dashboard</span>
        </a>

        <!-- Kelola User -->
        <a href="{{ route('admin.users.index') }}"
            class="flex items-center px-4 py-3 text-sm font-medium rounded-lg transition-colors {{ request()->routeIs('admin.users.*') ? 'bg-red-700 text-white' : 'text-red-100 hover:bg-red-700 hover:text-white' }}">
            <svg class="w-5 h-5 mr-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                stroke-width="1.5" stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
            </svg>
            <span class="truncate">Kelola User</span>
        </a>

        <!-- Kelola Tulisan with Submenu -->
        <div class="space-y-1">
            <a href="{{ route('admin.posts.index') }}"
                class="flex items-center px-4 py-3 text-sm font-medium rounded-lg transition-colors {{ request()->routeIs('admin.posts.*') ? 'bg-red-700 text-white' : 'text-red-100 hover:bg-red-700 hover:text-white' }}">
                <svg class="w-5 h-5 mr-3 flex-shrink-0" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 0 0 2.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 0 0-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 0 0 .75-.75 2.25 2.25 0 0 0-.1-.664m-5.8 0A2.251 2.251 0 0 1 13.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25ZM6.75 12h.008v.008H6.75V12Zm0 3h.008v.008H6.75V15Zm0 3h.008v.008H6.75V18Z" />
                </svg>
                <span class="truncate">Kelola Tulisan</span>
            </a>

            <!-- Submenu for Posts -->
            @if (request()->routeIs('admin.posts.*'))
                <div class="ml-8 space-y-1">
                    <a href="{{ route('admin.posts.index', ['status' => 'pending']) }}"
                        class="flex items-center px-4 py-2 text-sm rounded-lg transition-colors {{ request('status') == 'pending' ? 'text-white font-semibold bg-red-600' : 'text-red-200 hover:text-white hover:bg-red-600' }}">
                        <span class="truncate">Menunggu Approval</span>
                    </a>
                    <a href="{{ route('admin.posts.index', ['status' => 'approved']) }}"
                        class="flex items-center px-4 py-2 text-sm rounded-lg transition-colors {{ request('status') == 'approved' ? 'text-white font-semibold bg-red-600' : 'text-red-200 hover:text-white hover:bg-red-600' }}">
                        <span class="truncate">Disetujui</span>
                    </a>
                    <a href="{{ route('admin.posts.index', ['status' => 'rejected']) }}"
                        class="flex items-center px-4 py-2 text-sm rounded-lg transition-colors {{ request('status') == 'rejected' ? 'text-white font-semibold bg-red-600' : 'text-red-200 hover:text-white hover:bg-red-600' }}">
                        <span class="truncate">Ditolak</span>
                    </a>
                </div>
            @endif
        </div>

        <!-- Kelola Komentar -->
        <a href="#"
            class="flex items-center px-4 py-3 text-sm font-medium rounded-lg transition-colors {{ request()->routeIs('admin.comments.*') ? 'bg-red-700 text-white' : 'text-red-100 hover:bg-red-700 hover:text-white' }}">
            <svg class="w-5 h-5 mr-3 flex-shrink-0" xmlns="http://www.w3.org/2000/svg" fill="none"
                viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M8.625 9.75a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm0 0H8.25m4.125 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm0 0H12m4.125 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm0 0h-.375m-13.5 3.01c0 1.6 1.123 2.994 2.707 3.227 1.087.16 2.185.283 3.293.369V21l4.184-4.183a1.14 1.14 0 0 1 .778-.332 48.294 48.294 0 0 0 5.83-.498c1.585-.233 2.708-1.626 2.708-3.228V6.741c0-1.602-1.123-2.995-2.707-3.228A48.394 48.394 0 0 0 12 3c-2.392 0-4.744.175-7.043.513C3.373 3.746 2.25 5.14 2.25 6.741v6.018Z" />
            </svg>
            <span class="truncate">Kelola Komentar</span>
        </a>

        <!-- Kelola Kategori -->
        <a href="{{ route('admin.categories.index') }}"
            class="flex items-center px-4 py-3 text-sm font-medium rounded-lg transition-colors {{ request()->routeIs('admin.categories.*') ? 'bg-red-700 text-white' : 'text-red-100 hover:bg-red-700 hover:text-white' }}">
            <svg class="w-5 h-5 mr-3 flex-shrink-0" xmlns="http://www.w3.org/2000/svg" fill="none"
                viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M9.568 3H5.25A2.25 2.25 0 0 0 3 5.25v4.318c0 .597.237 1.17.659 1.591l9.581 9.581c.699.699 1.78.872 2.607.33a18.095 18.095 0 0 0 5.223-5.223c.542-.827.369-1.908-.33-2.607L11.16 3.66A2.25 2.25 0 0 0 9.568 3Z" />
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 6h.008v.008H6V6Z" />
            </svg>

            <span class="truncate">Kelola Kategori</span>
        </a>

        <!-- Divider -->
        <hr class="my-4 border-red-700">

        <!-- Pengaturan -->
        <a href="#"
            class="flex items-center px-4 py-3 text-sm font-medium rounded-lg transition-colors {{ request()->routeIs('admin.settings') ? 'bg-red-700 text-white' : 'text-red-100 hover:bg-red-700 hover:text-white' }}">
            <svg class="w-5 h-5 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z">
                </path>
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
            </svg>
            <span class="truncate">Pengaturan</span>
        </a>
    </nav>

    <!-- User Info Footer -->
    <div class="p-4 border-t border-red-700 flex-shrink-0">
        <div class="flex items-center min-w-0">
            <div class="flex-shrink-0">
                <div class="w-8 h-8 bg-red-600 rounded-full flex items-center justify-center">
                    <span class="text-sm font-medium text-white">{{ substr(auth()->user()->name, 0, 1) }}</span>
                </div>
            </div>
            <div class="ml-3 min-w-0 flex-1">
                <p class="text-sm font-medium text-white truncate">{{ auth()->user()->name }}</p>
                <p class="text-xs text-red-200">Administrator</p>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script>
        // Function to close sidebar (for mobile)
        function closeSidebar() {
            const sidebar = document.getElementById('sidebar-container');
            const overlay = document.getElementById('sidebar-overlay');

            if (sidebar && overlay) {
                sidebar.classList.add('-translate-x-full');
                overlay.classList.add('hidden');
            }
        }

        // Function to toggle sidebar (for mobile toggle button)
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar-container');
            const overlay = document.getElementById('sidebar-overlay');

            if (sidebar && overlay) {
                const isHidden = sidebar.classList.contains('-translate-x-full');

                if (isHidden) {
                    sidebar.classList.remove('-translate-x-full');
                    overlay.classList.remove('hidden');
                } else {
                    sidebar.classList.add('-translate-x-full');
                    overlay.classList.add('hidden');
                }
            }
        }

        // Handle window resize
        function handleResize() {
            const sidebar = document.getElementById('sidebar-container');
            const overlay = document.getElementById('sidebar-overlay');

            if (window.innerWidth >= 1024) { // lg breakpoint
                // Desktop: show sidebar, hide overlay
                if (sidebar) sidebar.classList.remove('-translate-x-full');
                if (overlay) overlay.classList.add('hidden');
            } else {
                // Mobile: hide sidebar
                if (sidebar) sidebar.classList.add('-translate-x-full');
                if (overlay) overlay.classList.add('hidden');
            }
        }

        // Listen for window resize
        window.addEventListener('resize', handleResize);

        // Initialize on page load
        document.addEventListener('DOMContentLoaded', handleResize);
    </script>
@endpush
