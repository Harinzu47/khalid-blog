<x-guest-layout>
    <!-- Header -->
    <div class="text-center mb-8">
        <h2 class="text-gray-900 text-3xl font-bold mb-3">Reset your password</h2>
        <p class="text-gray-600">
            Please enter your new password below to complete the reset process.
        </p>
    </div>

    <!-- Reset Form -->
    <form method="POST" action="{{ route('password.store') }}" class="space-y-6">
        @csrf

        <!-- Password Reset Token -->
        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email address')" class="text-gray-700 font-medium" />
            <x-text-input id="email"
                class="input-field block mt-2 w-full px-4 py-3 bg-gray-100 border border-gray-300 rounded-xl text-gray-700 cursor-not-allowed"
                type="email" name="email" :value="old('email', $request->email)" required autofocus autocomplete="username" readonly />
            <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-600" />
        </div>

        <!-- Password -->
        <div>
            <x-input-label for="password" :value="__('New Password')" class="text-gray-700 font-medium" />
            <div class="relative">
                <x-text-input id="password"
                    class="input-field block mt-2 w-full px-4 py-3 pr-12 bg-white border border-gray-300 rounded-xl text-gray-900 placeholder-gray-500 focus:border-red-800 focus:ring-2 focus:ring-red-800/20 focus:outline-none"
                    type="password" name="password" placeholder="Enter your new password" required
                    autocomplete="new-password" />
                <button type="button" class="absolute inset-y-0 right-0 pr-3 flex items-center"
                    onclick="togglePassword('password')">
                    <svg id="password-eye" class="w-5 h-5 text-gray-400 hover:text-gray-600 cursor-pointer"
                        fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10 12a2 2 0 100-4 2 2 0 000 4z"></path>
                        <path fill-rule="evenodd"
                            d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z"
                            clip-rule="evenodd"></path>
                    </svg>
                </button>
            </div>
            <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-600" />
        </div>

        <!-- Confirm Password -->
        <div>
            <x-input-label for="password_confirmation" :value="__('Confirm New Password')" class="text-gray-700 font-medium" />
            <div class="relative">
                <x-text-input id="password_confirmation"
                    class="input-field block mt-2 w-full px-4 py-3 pr-12 bg-white border border-gray-300 rounded-xl text-gray-900 placeholder-gray-500 focus:border-red-800 focus:ring-2 focus:ring-red-800/20 focus:outline-none"
                    type="password" name="password_confirmation" placeholder="Confirm your new password" required
                    autocomplete="new-password" />
                <button type="button" class="absolute inset-y-0 right-0 pr-3 flex items-center"
                    onclick="togglePassword('password_confirmation')">
                    <svg id="password_confirmation-eye" class="w-5 h-5 text-gray-400 hover:text-gray-600 cursor-pointer"
                        fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10 12a2 2 0 100-4 2 2 0 000 4z"></path>
                        <path fill-rule="evenodd"
                            d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z"
                            clip-rule="evenodd"></path>
                    </svg>
                </button>
            </div>
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 text-red-600" />
        </div>

        <!-- Submit Button -->
        <div class="flex items-center justify-between pt-2">
            <a href="{{ route('login') }}"
                class="text-sm text-red-800 hover:text-red-700 transition-colors underline decoration-2 underline-offset-2">
                {{ __('Back to login') }}
            </a>

            <x-primary-button class="btn-primary py-3 px-6 rounded-xl text-white font-semibold text-sm border-0">
                {{ __('Reset Password') }}
            </x-primary-button>
        </div>
    </form>

    <script>
        function togglePassword(fieldId) {
            const field = document.getElementById(fieldId);
            const eye = document.getElementById(fieldId + '-eye');

            if (field.type === 'password') {
                field.type = 'text';
                eye.innerHTML = `
                    <path d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.878 9.878L8.464 8.464m1.414 1.414l4.242 4.242m0 0L15.536 15.536M9.878 9.878L8.464 8.464"/>
                    <path d="M16.82 14.82L8.82 6.82"/>
                `;
            } else {
                field.type = 'password';
                eye.innerHTML = `
                    <path d="M10 12a2 2 0 100-4 2 2 0 000 4z"></path>
                    <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd"></path>
                `;
            }
        }
    </script>
</x-guest-layout>
