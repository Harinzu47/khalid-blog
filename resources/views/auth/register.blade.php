<x-guest-layout>
    <!-- Header -->
    <!-- Header -->
    <div class="text-center mb-10">
        <h2 class="text-gray-900 text-3xl font-bold mb-2">Create your account</h2>
        <p class="text-gray-500 text-sm">
            Join us today and start your journey with our platform.
        </p>
    </div>

    <!-- Registration Form -->
    <form method="POST" action="{{ route('register') }}" class="space-y-6">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Full Name')" class="text-gray-700 font-medium" />
            <x-text-input id="name"
                class="input-field block mt-2 w-full px-4 py-3 bg-white border border-gray-300 rounded-xl text-gray-900 placeholder-gray-500 focus:border-red-800 focus:ring-2 focus:ring-red-800/20 focus:outline-none"
                type="text" name="name" :value="old('name')" placeholder="Enter your full name" required autofocus
                autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2 text-red-600" />
        </div>

        <!-- Username -->
        <div>
            <x-input-label for="username" :value="__('Username')" class="text-gray-700 font-medium" />
            <x-text-input id="username"
                class="input-field block mt-2 w-full px-4 py-3 bg-white border border-gray-300 rounded-xl text-gray-900 placeholder-gray-500 focus:border-red-800 focus:ring-2 focus:ring-red-800/20 focus:outline-none"
                type="text" name="username" :value="old('username')" placeholder="Choose a username" required
                autocomplete="username" />
            <p class="mt-1 text-xs text-gray-500">This will be your unique identifier on the platform.</p>
            <x-input-error :messages="$errors->get('username')" class="mt-2 text-red-600" />
        </div>

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email Address')" class="text-gray-700 font-medium" />
            <x-text-input id="email"
                class="input-field block mt-2 w-full px-4 py-3 bg-white border border-gray-300 rounded-xl text-gray-900 placeholder-gray-500 focus:border-red-800 focus:ring-2 focus:ring-red-800/20 focus:outline-none"
                type="email" name="email" :value="old('email')" placeholder="Enter your email address" required
                autocomplete="email" />
            <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-600" />
        </div>

        <!-- Password -->
        <div>
            <x-input-label for="password" :value="__('Password')" class="text-gray-700 font-medium" />
            <div class="relative">
                <x-text-input id="password"
                    class="input-field block mt-2 w-full px-4 py-3 pr-12 bg-white border border-gray-300 rounded-xl text-gray-900 placeholder-gray-500 focus:border-red-800 focus:ring-2 focus:ring-red-800/20 focus:outline-none"
                    type="password" name="password" placeholder="Create a password" required
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

            <!-- Password Strength Indicator -->
            <div class="mt-2">
                <div class="flex space-x-1">
                    <div id="strength-1" class="h-1 w-1/4 bg-gray-200 rounded"></div>
                    <div id="strength-2" class="h-1 w-1/4 bg-gray-200 rounded"></div>
                    <div id="strength-3" class="h-1 w-1/4 bg-gray-200 rounded"></div>
                    <div id="strength-4" class="h-1 w-1/4 bg-gray-200 rounded"></div>
                </div>
                <p id="strength-text" class="mt-1 text-xs text-gray-500">Password strength: Weak</p>
            </div>

            <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-600" />
        </div>

        <!-- Confirm Password -->
        <div>
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" class="text-gray-700 font-medium" />
            <div class="relative">
                <x-text-input id="password_confirmation"
                    class="input-field block mt-2 w-full px-4 py-3 pr-12 bg-white border border-gray-300 rounded-xl text-gray-900 placeholder-gray-500 focus:border-red-800 focus:ring-2 focus:ring-red-800/20 focus:outline-none"
                    type="password" name="password_confirmation" placeholder="Confirm your password" required
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

        <!-- Submit Button & Login Link -->
        <div class="flex items-center justify-between pt-2">
            <a class="text-sm text-red-800 hover:text-red-700 transition-colors underline decoration-2 underline-offset-2"
                href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="btn-primary py-3 px-6 rounded-xl text-white font-semibold text-sm border-0">
                {{ __('Create Account') }}
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

        // Password Strength Checker
        document.getElementById('password').addEventListener('input', function(e) {
            const password = e.target.value;
            const strength = calculatePasswordStrength(password);
            updatePasswordStrength(strength);
        });

        function calculatePasswordStrength(password) {
            let score = 0;

            if (password.length >= 8) score++;
            if (/[a-z]/.test(password)) score++;
            if (/[A-Z]/.test(password)) score++;
            if (/[0-9]/.test(password)) score++;
            if (/[^A-Za-z0-9]/.test(password)) score++;

            return Math.min(score, 4);
        }

        function updatePasswordStrength(strength) {
            const indicators = ['strength-1', 'strength-2', 'strength-3', 'strength-4'];
            const colors = ['bg-red-400', 'bg-yellow-400', 'bg-blue-400', 'bg-green-400'];
            const texts = ['Very Weak', 'Weak', 'Fair', 'Good', 'Strong'];

            indicators.forEach((id, index) => {
                const element = document.getElementById(id);
                element.className = `h-1 w-1/4 rounded ${index < strength ? colors[strength - 1] : 'bg-gray-200'}`;
            });

            document.getElementById('strength-text').textContent = `Password strength: ${texts[strength]}`;
        }
    </script>
</x-guest-layout>
