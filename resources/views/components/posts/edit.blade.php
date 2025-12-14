@push('styles')
    <link href="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.snow.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">
    <style>
        /* Custom Input Styles to match Login */
        .input-field {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .input-field:focus {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.05); /* Softer shadow for internal app */
        }

        /* Quill Editor Customization */
        .ql-toolbar.ql-snow {
            border-top-left-radius: 0.75rem;
            border-top-right-radius: 0.75rem;
            border-color: #d1d5db;
            background-color: #f9fafb;
        }

        .ql-container.ql-snow {
            border-bottom-left-radius: 0.75rem;
            border-bottom-right-radius: 0.75rem;
            border-color: #d1d5db;
            font-family: 'Inter', sans-serif;
        }
        
        .dark .ql-toolbar.ql-snow, .dark .ql-container.ql-snow {
             border-color: #4b5563;
             background-color: #374151;
             color: white;
        }
        .dark .ql-stroke {
            stroke: #9ca3af !important;
        }
        .dark .ql-fill {
            fill: #9ca3af !important;
        }
        .dark .ql-picker {
             color: #9ca3af !important;
        }

        /* Drag and Drop Area */
        .drag-area {
            border: 2px dashed #d1d5db;
            transition: all 0.3s ease;
        }

        .drag-area.active {
            border-color: #1a56db;
            background-color: #eff6ff;
        }
    </style>
@endpush

<div class="max-w-4xl relative p-6 bg-white rounded-2xl shadow-sm border border-gray-100 dark:bg-gray-800 dark:border-gray-700">
    <!-- Header -->
    <div class="mb-8">
        <h3 class="text-2xl font-bold text-gray-900 dark:text-white">Edit Post</h3>
        <p class="text-gray-500 text-sm mt-1">Make changes to your existing post.</p>
    </div>

    <form action="/dashboard/{{ $post->slug }}" method="POST" id="postForm" enctype="multipart/form-data" class="space-y-6">
        @csrf
        @method('PATCH')
        
        <!-- Post Title -->
        <div>
            <label for="title" class="block mb-2 text-sm font-semibold text-gray-900 dark:text-white">Title</label>
            <input type="text" name="title" id="title"
                class="input-field block w-full px-4 py-3 text-lg font-medium text-gray-900 bg-white border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-100 focus:border-blue-600 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                placeholder="Enter an engaging title..." autofocus value="{{ old('title', $post->title) }}">
            @error('title')
                <p class="mt-2 text-xs text-red-600 dark:text-red-500">{{ $message }}</p>
            @enderror
        </div>

        <!-- Post Image (Drag & Drop) -->
        <div>
            <label class="block mb-2 text-sm font-semibold text-gray-900 dark:text-white">Cover Image</label>
            
            <div class="drag-area relative flex flex-col items-center justify-center w-full h-64 rounded-xl cursor-pointer bg-gray-50 hover:bg-gray-100 dark:hover:bg-gray-700 dark:bg-gray-700 overflow-hidden" id="dropZone">
                <!-- Preview Image (Initially hidden unless post has image) -->
                <img id="imagePreview" src="{{ $post->image ? asset('storage/' . $post->image) : '' }}" 
                     class="absolute inset-0 w-full h-full object-cover z-10 {{ $post->image ? '' : 'hidden' }}" />
                
                <div class="flex flex-col items-center justify-center pt-5 pb-6 text-center p-4 relative z-0 {{ $post->image ? 'hidden' : '' }}" id="uploadPrompt">
                    <svg class="w-10 h-10 mb-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2"/>
                    </svg>
                    <p class="mb-2 text-sm text-gray-500 dark:text-gray-400"><span class="font-semibold text-blue-600">Click to upload</span> or drag and drop</p>
                    <p class="text-xs text-gray-500 dark:text-gray-400">SVG, PNG, JPG or GIF (MAX. 2MB)</p>
                </div>
                
                <input id="image" name="image" type="file" class="hidden" accept="image/*" />
                
                <!-- Remove Button (Visible when image is loaded) -->
                 <button type="button" id="removeImageBtn" class="absolute top-3 right-3 bg-white/90 text-red-600 p-2 rounded-full shadow-md hover:bg-white z-20 transition-all transform hover:scale-110 {{ $post->image ? '' : 'hidden' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-5 h-5">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            
            @error('image')
                <p class="mt-2 text-xs text-red-600 dark:text-red-500">{{ $message }}</p>
            @enderror
        </div>

        <!-- Category -->
        <div>
            <label for="category" class="block mb-2 text-sm font-semibold text-gray-900 dark:text-white">Category</label>
            <div class="relative">
                <select name="category_id" id="category"
                    class="input-field block w-full px-4 py-3 text-gray-900 bg-white border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-100 focus:border-blue-600 focus:outline-none appearance-none bg-none cursor-pointer dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    <option selected="" value="">Select a category</option>
                    @foreach (App\Models\Category::get() as $category)
                        <option value="{{ $category->id }}" @selected(old('category_id', $post->category_id) == $category->id)>{{ $category->name }}</option>
                    @endforeach
                </select>
                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-gray-500">
                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </div>
            </div>
            @error('category_id')
                <p class="mt-2 text-xs text-red-600 dark:text-red-500">{{ $message }}</p>
            @enderror
        </div>

        <!-- Body (Rich Text) -->
        <div>
             <label for="body" class="block mb-2 text-sm font-semibold text-gray-900 dark:text-white">Content</label>
             <!-- Wrapper to control height -->
             <div class="min-h-[300px]">
                <textarea id="body" name="body" class="hidden">{{ old('body', $post->body) }}</textarea>
                <div id="editor" class="rounded-b-lg min-h-[250px] bg-white dark:bg-gray-700 text-gray-900 dark:text-white"></div>
             </div>
             @error('body')
                <p class="mt-2 text-xs text-red-600 dark:text-red-500">{{ $message }}</p>
             @enderror
        </div>

        <!-- Actions -->
        <div class="flex items-center gap-4 pt-4 border-t border-gray-100 dark:border-gray-700">
            <button type="submit"
                class="inline-flex items-center bg-blue-700 hover:bg-blue-800 text-white font-semibold rounded-xl text-sm px-6 py-3 transition-colors shadow-lg shadow-blue-700/20 focus:outline-none focus:ring-4 focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                <svg class="mr-2 -ml-1 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path></svg>
                Update Post
            </button>
            <a href="/dashboard"
                class="inline-flex items-center text-gray-700 bg-white border border-gray-300 hover:bg-gray-50 font-medium rounded-xl text-sm px-6 py-3 transition-colors focus:outline-none focus:ring-4 focus:ring-gray-100 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700">
                Cancel
            </a>
        </div>
    </form>
</div>

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        // Init Quill
        const quill = new Quill('#editor', {
            theme: 'snow',
            placeholder: 'Write your masterpiece...',
            modules: {
                toolbar: [
                    [{ 'header': [1, 2, 3, false] }],
                    ['bold', 'italic', 'underline', 'strike', 'blockquote'],
                    [{ 'list': 'ordered'}, { 'list': 'bullet' }],
                    [{ 'align': [] }, { 'color': [] }, { 'background': [] }],
                    ['link', 'image', 'code-block'],
                    ['clean']
                ]
            }
        });
        
        // Populate if old data exists
        const oldBody = document.querySelector('#body').value;
        if(oldBody) {
            quill.root.innerHTML = oldBody;
        }

        const postForm = document.querySelector('#postForm');
        const postBody = document.querySelector('#body');

        // Form Submit Handler
        postForm.addEventListener('submit', function(e) {
            const content = quill.root.innerHTML;
             // Check if empty
            if (content === '<p><br></p>') {
                 postBody.value = '';
            } else {
                 postBody.value = content;
            }
        });

        // --- Drag & Drop Image Logic ---
        const dropZone = document.getElementById('dropZone');
        const fileInput = document.getElementById('image');
        const imagePreview = document.getElementById('imagePreview');
        const uploadPrompt = document.getElementById('uploadPrompt');
        const removeBtn = document.getElementById('removeImageBtn');

        // Trigger file input on click
        dropZone.addEventListener('click', (e) => {
            if(e.target !== removeBtn && !removeBtn.contains(e.target)) {
                 fileInput.click();
            }
        });

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
            dropZone.addEventListener(eventName, () => dropZone.classList.add('active'), false);
        });

        ['dragleave', 'drop'].forEach(eventName => {
            dropZone.addEventListener(eventName, () => dropZone.classList.remove('active'), false);
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
                // Validate File Size (2MB = 2 * 1024 * 1024 bytes)
                if (file.size > 2 * 1024 * 1024) {
                     Swal.fire({
                        icon: 'error',
                        title: 'File Too Large',
                        text: 'Maximum image size is 2MB. Please choose a smaller image.',
                        confirmButtonColor: '#1d4ed8'
                    });
                    removeBtn.click(); // Reset
                    return;
                }

                const reader = new FileReader();
                reader.onload = function(e) {
                    imagePreview.src = e.target.result;
                    imagePreview.classList.remove('hidden');
                    uploadPrompt.classList.add('hidden');
                    removeBtn.classList.remove('hidden');
                }
                reader.readAsDataURL(file);
            }
        }
        
        // Remove Image
        removeBtn.addEventListener('click', (e) => {
            e.stopPropagation(); // prevent triggering upload
            fileInput.value = ''; // clear input
            
            // Should show placeholder again?
            // Note: In Edit mode, this removes the *newly selected* image. 
            // If the user wants to remove the server-existing image, usually that requires a separate flag or setting the input to 'null' if allowed. 
            // For now, this just resets the UI to a blank state ready for new upload, or if we want to show the old image back, we'd need more logic.
            // Simplified: Just clear local preview.
            
            imagePreview.src = '';
            imagePreview.classList.add('hidden');
            uploadPrompt.classList.remove('hidden');
            removeBtn.classList.add('hidden');
        });
    </script>
@endpush
