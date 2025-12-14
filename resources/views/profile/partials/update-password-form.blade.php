<section>
    <header class="mb-6">
        <h2 class="text-xl font-bold text-gray-900 dark:text-white">
            {{ __('Update Password') }}
        </h2>
        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
            {{ __('Ensure your account is using a long, random password to stay secure.') }}
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="space-y-6">
        @csrf
        @method('put')

        <div>
            <x-input-label for="update_password_current_password" :value="__('Current Password')" class="font-semibold" />
            <x-text-input id="update_password_current_password" name="current_password" type="password" 
                class="mt-1 block w-full rounded-xl border-gray-300 focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-900 dark:border-gray-700 dark:text-white" 
                autocomplete="current-password" placeholder="••••••••" />
            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <x-input-label for="update_password_password" :value="__('New Password')" class="font-semibold" />
                <x-text-input id="update_password_password" name="password" type="password" 
                    class="mt-1 block w-full rounded-xl border-gray-300 focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-900 dark:border-gray-700 dark:text-white" 
                    autocomplete="new-password" placeholder="New strong password" />
                <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="update_password_password_confirmation" :value="__('Confirm Password')" class="font-semibold" />
                <x-text-input id="update_password_password_confirmation" name="password_confirmation" type="password" 
                    class="mt-1 block w-full rounded-xl border-gray-300 focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-900 dark:border-gray-700 dark:text-white" 
                    autocomplete="new-password" placeholder="Repeat password" />
                <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
            </div>
        </div>

        <div class="flex items-center gap-4 pt-4">
            <x-primary-button class="bg-blue-600 hover:bg-blue-700 focus:ring-blue-500 px-6 py-2.5 rounded-xl uppercase tracking-wider text-xs font-bold">{{ __('Update Password') }}</x-primary-button>

            @if (session('status') === 'password-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-green-600 font-medium flex items-center"
                >
                    <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                    {{ __('Saved Successfully.') }}
                </p>
            @endif
        </div>
    </form>
</section>
