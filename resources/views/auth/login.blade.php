<x-guest-layout>
    <div class="text-center mb-8">
        <h2 class="text-gray-900 text-3xl font-bold mb-3">Sign in to your account</h2>
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

        <div>
            <x-input-label for="password" :value="__('Password')" class="text-gray-700 font-medium" />
            <x-text-input id="password"
                class="input-field block mt-2 w-full px-4 py-3 bg-white border border-gray-300 rounded-xl text-gray-900 placeholder-gray-500 focus:border-red-800 focus:ring-2 focus:ring-red-800/20 focus:outline-none"
                type="password" name="password" placeholder="Enter your password" required
                autocomplete="current-password" />
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
