                    <div class="bg-gradient-to-r from-indigo-500 to-purple-600 px-6 py-4">
                        <div class="flex items-center space-x-3">
                            <div class="flex-shrink-0">
                                <div
                                    class="h-10 w-10 rounded-full bg-white bg-opacity-20 flex items-center justify-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="size-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                                    </svg>

                                </div>
                            </div>
                            <div>
                                <h3 class="text-lg font-semibold text-white">Informasi Profile</h3>
                                <p class="text-indigo-100 text-sm">Perbarui informasi akun dan alamat email Anda</p>
                            </div>
                        </div>
                    </div>
                    <div class="p-6 sm:p-8">
                        @include('profile.partials.update-profile-information-form')
                    </div>
