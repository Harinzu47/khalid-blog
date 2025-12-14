<x-guest-layout>
    <div class="text-center mb-10">
        <h2 class="text-gray-900 text-3xl font-bold mb-2">Sign in to your account</h2>
        <p class="text-gray-500 text-sm">Welcome back! Please enter your details.</p>
    </div>

    <x-auth-session-status class="mb-4 text-emerald-600" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="space-y-6">
        @csrf

        <div>
            <x-input-label for="user_cred" :value="__('Email address or Username')" class="text-gray-700 font-medium" />
            <x-text-input id="user_cred"
                class="input-field block mt-2 w-full px-4 py-3 bg-white border border-gray-300 rounded-xl text-gray-900 placeholder-gray-500 focus:border-red-800 focus:ring-2 focus:ring-red-800/20 focus:outline-none"
                type="text" name="user_cred" :value="old('user_cred')" placeholder="Enter your email or username" required
                autofocus />
            <x-input-error :messages="$errors->get('user_cred')" class="mt-2 text-red-600" />
        </div>

        <div x-data="{ show: false }">
            <x-input-label for="password" :value="__('Password')" class="text-gray-700 font-medium" />
            <div class="relative">
                <x-text-input id="password"
                    class="input-field block mt-2 w-full px-4 py-3 bg-white border border-gray-300 rounded-xl text-gray-900 placeholder-gray-500 focus:border-red-800 focus:ring-2 focus:ring-red-800/20 focus:outline-none"
                    x-bind:type="show ? 'text' : 'password'" name="password" placeholder="Enter your password" required
                    autocomplete="current-password" />
                <button type="button" @click="show = !show"
                    class="absolute inset-y-0 right-0 pr-3 flex items-center text-sm leading-5">
                    <svg x-show="!show" class="h-5 w-5 text-gray-500" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                    </svg>
                    <svg x-show="show" style="display: none;" class="h-5 w-5 text-gray-500" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" />
                    </svg>
                </button>
            </div>
            <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-600" />
        </div>

        <div class="flex items-center justify-between">
            <label for="remember_me" class="inline-flex items-center cursor-pointer">
                <input id="remember_me" type="checkbox"
                    class="rounded border-gray-400 text-red-800 shadow-sm focus:ring-red-800 focus:ring-offset-0 bg-white"
                    name="remember">
                <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
            </label>

            @if (Route::has('password.request'))
                <a class="text-sm text-red-800 hover:text-red-700 transition-colors underline decoration-2 underline-offset-2"
                    href="{{ route('password.request') }}">
                    {{ __('Forgot password?') }}
                </a>
            @endif
        </div>

        <x-primary-button
            class="btn-primary w-full justify-center py-3 px-6 rounded-xl text-white font-semibold text-sm border-0">
            {{ __('Sign in') }}
        </x-primary-button>
    </form>
</x-guest-layout>
