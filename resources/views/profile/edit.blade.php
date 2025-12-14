<x-app-layout>

    <div class="py-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Left Sidebar: Navigation & Quick Stats -->
                <div class="lg:col-span-1 space-y-6">
                    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 overflow-hidden sticky top-6">
                         <div class="p-6">
                            <h3 class="text-xs font-semibold text-gray-400 uppercase tracking-widest mb-4">Settings</h3>
                            <nav class="space-y-2">
                                <a href="#profile-info" class="flex items-center px-4 py-3 bg-blue-50 text-blue-700 rounded-xl transition-colors font-medium">
                                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                                    Profile Information
                                </a>
                                <a href="#password" class="flex items-center px-4 py-3 text-gray-600 hover:bg-gray-50 hover:text-gray-900 rounded-xl transition-colors font-medium">
                                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                                    Password & Security
                                </a>
                                <a href="#delete-account" class="flex items-center px-4 py-3 text-red-600 hover:bg-red-50 rounded-xl transition-colors font-medium">
                                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                    Delete Account
                                </a>
                            </nav>
                         </div>
                    </div>
                </div>

                <!-- Right Content -->
                <div class="lg:col-span-2 space-y-8">
                    <!-- Profile Info -->
                    <div id="profile-info" class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 p-6 sm:p-8">
                         @include('profile.partials.profile-information')
                    </div>

                    <!-- Password -->
                    <div id="password" class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 p-6 sm:p-8">
                         @include('profile.partials.password')
                    </div>

                    <!-- Delete -->
                    <div id="delete-account" class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-red-100 dark:border-red-900/30 p-6 sm:p-8">
                         @include('profile.partials.delete')
                    </div>
                </div>
            </div>
        </div>
    </div>


    @push('styles')
        <style>
            /* Custom styles for enhanced visual appeal */
            .profile-section {
                transition: all 0.3s ease;
            }

            .profile-section:hover {
                transform: translateY(-2px);
            }

            /* Smooth animations for form interactions */
            input:focus,
            select:focus,
            textarea:focus {
                box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.1);
                border-color: #6366f1;
                transform: scale(1.02);
                transition: all 0.2s ease;
            }

            /* Loading state for buttons */
            button:active {
                transform: scale(0.98);
                transition: transform 0.1s ease;
            }

            /* Enhanced card shadows */
            .shadow-xl {
                box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
            }
        </style>
    @endpush

    @push('scripts')
        <script>
            // Add smooth scroll behavior and enhanced interactions
            document.addEventListener('DOMContentLoaded', function() {
                // Add loading states to form submissions
                const forms = document.querySelectorAll('form');
                forms.forEach(form => {
                    form.addEventListener('submit', function() {
                        const submitBtn = form.querySelector('button[type="submit"]');
                        if (submitBtn) {
                            submitBtn.disabled = true;
                            submitBtn.innerHTML = `
                                <svg class="animate-spin -ml-1 mr-3 h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                </svg>
                                Processing...
                            `;
                        }
                    });
                });

                // Add visual feedback for successful operations
                if (document.querySelector('[x-data]')) {
                    // Alpine.js is available, enhance success messages
                    const successMessages = document.querySelectorAll('[x-show="show"]');
                    successMessages.forEach(msg => {
                        if (msg.textContent.includes('Saved')) {
                            msg.classList.add('bg-green-50', 'text-green-700', 'px-3', 'py-2', 'rounded-lg',
                                'border', 'border-green-200');
                        }
                    });
                }
            });
        </script>
    @endpush
</x-app-layout>
