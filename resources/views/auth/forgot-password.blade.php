<x-guest-layout>
    <!-- Header -->
    <div class="text-center mb-8">
        <h2 class="text-gray-900 text-3xl font-bold mb-3">Forgot your password?</h2>
        <p class="text-gray-600">
            No problem. Just let us know your email address and we will email you a password reset link.
        </p>
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4 text-emerald-600" :status="session('status')" />

    <!-- Reset Form -->
    <form method="POST" action="{{ route('password.email') }}" class="space-y-6">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email address')" class="text-gray-700 font-medium" />
            <x-text-input id="email"
                class="input-field block mt-2 w-full px-4 py-3 bg-white border border-gray-300 rounded-xl text-gray-900 placeholder-gray-500 focus:border-red-800 focus:ring-2 focus:ring-red-800/20 focus:outline-none"
                type="email" name="email" :value="old('email')" placeholder="Enter your email address" required
                autofocus />
            <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-600" />
        </div>

        <!-- Submit Button -->
        <div class="flex items-center justify-between">
            <a href="{{ route('login') }}"
                class="text-sm text-red-800 hover:text-red-700 transition-colors underline decoration-2 underline-offset-2">
                {{ __('Back to login') }}
            </a>

            <x-primary-button class="btn-primary py-3 px-6 rounded-xl text-white font-semibold text-sm border-0">
                {{ __('Email Password Reset Link') }}
            </x-primary-button>
        </div>
    </form>

    <!-- Additional Help -->
    <div class="mt-8 pt-6 border-t border-gray-200">
        <div class="text-center">
            <p class="text-sm text-gray-500 mb-2">Still having trouble?</p>
            <a href="#" class="text-sm text-red-800 hover:text-red-700 font-semibold transition-colors">
                Contact support
            </a>
        </div>
    </div>
</x-guest-layout>
