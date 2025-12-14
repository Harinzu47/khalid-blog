@push('styles')
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">
@endpush

<section>
    <header class="flex items-center justify-between mb-6">
        <div>
            <h2 class="text-xl font-bold text-gray-900 dark:text-white">
                {{ __('Profile Information') }}
            </h2>
            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                {{ __("Update your account's profile information and email address.") }}
            </p>
        </div>
         <div class="p-2 bg-blue-50 text-blue-600 rounded-lg">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
        </div>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="space-y-6" enctype="multipart/form-data">
        @csrf
        @method('patch')

        <!-- Drag & Drop Avatar -->
        <div>
             <label class="block mb-2 text-sm font-semibold text-gray-900 dark:text-white">Avatar</label>
             <div class="flex items-start gap-6">
                <!-- Current Avatar Preview -->
                <div class="flex-shrink-0 relative group">
                    <img id="avatarPreview" 
                         class="w-24 h-24 rounded-full object-cover ring-4 ring-gray-50 dark:ring-gray-700"
                         src="{{ $user->avatar ? asset('storage/' . $user->avatar) : asset('img/default-avatar.png') }}"
                         alt="{{ $user->name }}">
                </div>

                <div class="flex-grow">
                    <div class="relative flex flex-col items-center justify-center w-full h-32 border-2 border-dashed border-gray-300 rounded-xl cursor-pointer bg-gray-50 hover:bg-gray-100 transition-colors dark:bg-gray-800 dark:border-gray-600 dark:hover:bg-gray-700" id="dropZone">
                        <div class="flex flex-col items-center justify-center pt-5 pb-6 text-center" id="uploadPrompt">
                            <svg class="w-8 h-8 mb-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path></svg>
                            <p class="mb-1 text-sm text-gray-500 dark:text-gray-400"><span class="font-semibold text-blue-600">Click to upload</span> or drag and drop</p>
                            <p class="text-xs text-gray-500 dark:text-gray-400">SVG, PNG, JPG (MAX. 2MB)</p>
                        </div>
                        <input id="avatar" name="avatar" type="file" class="hidden" accept="image/*" />
                    </div>
                     @error('avatar')
                        <p class="mt-2 text-xs text-red-600 dark:text-red-500">{{ $message }}</p>
                    @enderror
                </div>
             </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <x-input-label for="name" :value="__('Name')" class="font-semibold" />
                <x-text-input id="name" name="name" type="text" 
                    class="mt-1 block w-full rounded-xl border-gray-300 focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-900 dark:border-gray-700 dark:text-white" 
                    :value="old('name', $user->name)" required autofocus autocomplete="name" placeholder="Your full name" />
                <x-input-error class="mt-2" :messages="$errors->get('name')" />
            </div>

            <div>
                <x-input-label for="username" :value="__('Username')" class="font-semibold" />
                <x-text-input id="username" name="username" type="text" 
                    class="mt-1 block w-full rounded-xl border-gray-300 focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-900 dark:border-gray-700 dark:text-white"
                    :value="old('username', $user->username)" required autocomplete="username" placeholder="Required for profile URL" />
                <x-input-error class="mt-2" :messages="$errors->get('username')" />
            </div>
        </div>

        <div>
            <x-input-label for="email" :value="__('Email')" class="font-semibold" />
            <x-text-input id="email" name="email" type="email" 
                class="mt-1 block w-full rounded-xl border-gray-300 focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-900 dark:border-gray-700 dark:text-white"
                :value="old('email', $user->email)" required autocomplete="username" placeholder="name@example.com" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && !$user->hasVerifiedEmail())
                <div class="mt-2 p-4 bg-yellow-50 rounded-lg flex items-start">
                     <svg class="h-5 w-5 text-yellow-400 mt-0.5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                     <div>
                        <p class="text-sm text-yellow-700">
                            {{ __('Your email address is unverified.') }}
                        </p>
                        <button form="send-verification"
                            class="mt-1 text-sm font-medium text-yellow-700 hover:text-yellow-600 underline focus:outline-none">
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </div>
                </div>

                @if (session('status') === 'verification-link-sent')
                    <p class="mt-2 font-medium text-sm text-green-600">
                        {{ __('A new verification link has been sent to your email address.') }}
                    </p>
                @endif
            @endif
        </div>

        <div>
            <x-input-label for="bio" :value="__('Bio (About Me)')" class="font-semibold" />
            <textarea id="bio" name="bio" rows="4"
                class="mt-1 block w-full rounded-xl border-gray-300 focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-900 dark:border-gray-700 dark:text-white"
                placeholder="Tell us a little about yourself (max 160 characters)...">{{ old('bio', $user->bio) }}</textarea>
            <x-input-error class="mt-2" :messages="$errors->get('bio')" />
        </div>

        <div class="flex items-center gap-4 pt-4">
            <x-primary-button class="bg-blue-600 hover:bg-blue-700 focus:ring-blue-500 px-6 py-2.5 rounded-xl uppercase tracking-wider text-xs font-bold">{{ __('Save Changes') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-green-600 font-medium flex items-center">
                    <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                    {{ __('Saved Successfully.') }}
                </p>
            @endif
        </div>
    </form>
</section>

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        // --- Drag & Drop Avatar Logic ---
        const dropZone = document.getElementById('dropZone');
        const fileInput = document.getElementById('avatar');
        const avatarPreview = document.getElementById('avatarPreview'); // Main rounded preview
        const uploadPrompt = document.getElementById('uploadPrompt');

        // Trigger file input on click
        dropZone.addEventListener('click', () => fileInput.click());

        fileInput.addEventListener('change', handleFileSelect);

        // Drag Events
        ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
            dropZone.addEventListener(eventName, preventDefaults, false);
        });

        function preventDefaults(e) {
            e.preventDefault();
            e.stopPropagation();
        }

        ['dragenter', 'dragover'].forEach(eventName => {
            dropZone.addEventListener(eventName, () => dropZone.classList.add('bg-blue-50', 'border-blue-400'), false);
        });

        ['dragleave', 'drop'].forEach(eventName => {
            dropZone.addEventListener(eventName, () => dropZone.classList.remove('bg-blue-50', 'border-blue-400'), false);
        });

        dropZone.addEventListener('drop', handleDrop, false);

        function handleDrop(e) {
            const dt = e.dataTransfer;
            const files = dt.files;
            if (files.length) {
                fileInput.files = files;
                handleFileSelect();
            }
        }

        function handleFileSelect() {
            const file = fileInput.files[0];
            if (file) {
                // Validate Size
                if (file.size > 2 * 1024 * 1024) {
                     Swal.fire({
                        icon: 'error',
                        title: 'File Too Large',
                        text: 'Maximum image size is 2MB.',
                        confirmButtonColor: '#1d4ed8'
                    });
                    fileInput.value = ''; 
                    return;
                }

                const reader = new FileReader();
                reader.onload = function(e) {
                    avatarPreview.src = e.target.result;
                    // Optional: Update dropzone text to show filename
                    uploadPrompt.innerHTML = `
                        <p class="text-sm font-medium text-gray-900">${file.name}</p>
                        <p class="text-xs text-green-600 mt-1">Ready to upload</p>
                    `;
                }
                reader.readAsDataURL(file);
            }
        }
    </script>
@endpush
