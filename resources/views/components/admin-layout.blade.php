<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Admin Dashboard') - {{ config('app.name', 'Laravel') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://rsms.me/inter/inter.css" />
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @stack('styles')
</head>

<body class="font-sans antialiased bg-gray-50">
    <div class="flex h-screen bg-gray-100 overflow-hidden">

        <!-- Sidebar Container -->
        <div id="sidebar-container"
            class="fixed inset-y-0 left-0 z-50 w-64 transform -translate-x-full lg:translate-x-0 lg:static lg:inset-auto lg:transform-none transition-transform duration-300 ease-in-out">
            @include('components.admin.sidebar')
        </div>

        <!-- Sidebar Overlay for Mobile -->
        <div id="sidebar-overlay" class="fixed inset-0 z-40 bg-black bg-opacity-50 hidden lg:hidden"
            onclick="closeSidebar()"></div>

        <!-- Mobile Sidebar Toggle Button -->
        <button type="button" id="sidebar-toggle"
            class="fixed top-4 left-4 z-[60] p-2 bg-red-800 text-white rounded-lg shadow-lg lg:hidden hover:bg-red-700 transition-colors"
            onclick="toggleSidebar()">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16">
                </path>
            </svg>
        </button>

        <!-- Main Content Area -->
        <div class="flex-1 flex flex-col overflow-hidden min-w-0">

            <!-- Top Bar -->
            @include('components.admin.topbar')

            <!-- Main Content -->
            <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-50">
                @isset($header)
                    <header class="bg-white shadow-sm border-b border-gray-200">
                        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                            {{ $header }}
                        </div>
                    </header>
                @endisset

                <div class="p-4 sm:p-6 lg:p-8">
                    <!-- Success Message -->
                    @if (session('success'))
                        <div
                            class="mb-4 bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg shadow-sm">
                            <div class="flex">
                                <div class="flex-shrink-0">
                                    <svg class="h-5 w-5 text-green-400" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd"
                                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm font-medium">{{ session('success') }}</p>
                                </div>
                            </div>
                        </div>
                    @endif

                    <!-- Error Message -->
                    @if (session('error'))
                        <div class="mb-4 bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg shadow-sm">
                            <div class="flex">
                                <div class="flex-shrink-0">
                                    <svg class="h-5 w-5 text-red-400" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd"
                                            d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm font-medium">{{ session('error') }}</p>
                                </div>
                            </div>
                        </div>
                    @endif

                    <!-- Main Content Slot -->
                    {{ $slot }}
                </div>
            </main>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>
    <!-- JavaScript for Sidebar Management -->
    <script>
        // Global functions for sidebar management
        function closeSidebar() {
            const sidebar = document.getElementById('sidebar-container');
            const overlay = document.getElementById('sidebar-overlay');

            if (sidebar) {
                sidebar.classList.add('-translate-x-full');
            }
            if (overlay) {
                overlay.classList.add('hidden');
            }
        }

        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar-container');
            const overlay = document.getElementById('sidebar-overlay');

            if (sidebar && overlay) {
                const isHidden = sidebar.classList.contains('-translate-x-full');

                if (isHidden) {
                    // Show sidebar
                    sidebar.classList.remove('-translate-x-full');
                    overlay.classList.remove('hidden');
                } else {
                    // Hide sidebar
                    sidebar.classList.add('-translate-x-full');
                    overlay.classList.add('hidden');
                }
            }
        }

        // Handle window resize to manage sidebar visibility
        function handleResize() {
            const sidebar = document.getElementById('sidebar-container');
            const overlay = document.getElementById('sidebar-overlay');

            if (window.innerWidth >= 1024) {
                // Desktop: ensure sidebar is visible and overlay is hidden
                if (sidebar) sidebar.classList.remove('-translate-x-full');
                if (overlay) overlay.classList.add('hidden');
            } else {
                // Mobile: ensure sidebar is hidden by default
                if (sidebar) sidebar.classList.add('-translate-x-full');
                if (overlay) overlay.classList.add('hidden');
            }
        }

        // Initialize on page load
        document.addEventListener('DOMContentLoaded', function() {
            handleResize();

            // Add event listeners
            const overlay = document.getElementById('sidebar-overlay');
            const toggleButton = document.getElementById('sidebar-toggle');

            if (overlay) {
                overlay.addEventListener('click', closeSidebar);
            }

            if (toggleButton) {
                toggleButton.addEventListener('click', toggleSidebar);
            }
        });

        // Handle window resize events
        window.addEventListener('resize', handleResize);

        // Handle orientation change on mobile devices
        window.addEventListener('orientationchange', function() {
            setTimeout(handleResize, 100);
        });
    </script>

    @stack('scripts')
</body>

</html>
