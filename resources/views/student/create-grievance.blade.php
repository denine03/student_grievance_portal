<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Submit Grievance - MZU Portal</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-slate-50 antialiased font-sans text-gray-900">

    <nav class="bg-slate-900 text-white p-4 shadow-md flex justify-between items-center">
        <h1 class="text-xl font-bold tracking-wide">MZU Grievance Portal</h1>
        <div class="flex items-center gap-6">
            <a href="{{ route('student.dashboard') }}" class="text-slate-300 hover:text-white font-medium transition">← Back to Dashboard</a>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="bg-red-500 hover:bg-red-600 px-4 py-2 rounded-md text-sm font-bold transition shadow-sm">Logout</button>
            </form>
        </div>
    </nav>

    <main class="max-w-3xl mx-auto my-10 px-6 py-8 sm:px-12 sm:py-10 bg-white rounded-xl shadow-sm border border-gray-100">
        <div class="mb-8 border-b pb-4">
            <h2 class="text-3xl font-extrabold text-gray-800">File a New Grievance</h2>
            <p class="text-gray-500 mt-2">Please provide detailed information so our authorities can resolve your issue quickly.</p>
        </div>

        <form action="{{ route('grievance.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf

        <div>
            <label class="block text-sm font-bold text-gray-700 mb-2">Category <span class="text-red-500">*</span></label>
            <select name="category" required class="w-full px-4 py-3 bg-gray-50 border rounded-lg focus:ring-2 focus:ring-blue-500 transition @error('category') border-red-500 @else border-gray-300 @enderror">
                <option value="" disabled {{ old('category') ? '' : 'selected' }}>Select an issue type...</option>
                <option value="Academic" {{ old('category') == 'Academic' ? 'selected' : '' }}>Academic / Examinations</option>
                <option value="Hostel" {{ old('category') == 'Hostel' ? 'selected' : '' }}>Hostel / Accommodation</option>
                <option value="Infrastructure" {{ old('category') == 'Infrastructure' ? 'selected' : '' }}>Infrastructure / Facilities</option>
                <option value="Harassment" {{ old('category') == 'Harassment' ? 'selected' : '' }}>Harassment / Disciplinary</option>
                <option value="Other" {{ old('category') == 'Other' ? 'selected' : '' }}>Other</option>
            </select>
            @error('category')
                <p class="text-red-500 text-xs mt-1 font-semibold">{{ $message }}</p>
            @enderror
        </div>

                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Subject <span class="text-red-500">*</span></label>
                    <input type="text" name="subject" value="{{ old('subject') }}" required placeholder="Brief summary of the issue" class="w-full px-4 py-3 bg-gray-50 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 focus:bg-white transition @error('subject') border-red-500 @enderror">
                    @error('subject')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div>
                <label class="block text-sm font-bold text-gray-700 mb-2">Detailed Description <span class="text-red-500">*</span></label>
                <textarea name="description" rows="6" required placeholder="Please explain the situation in detail..." class="w-full px-4 py-3 bg-gray-50 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 focus:bg-white transition resize-none @error('description') border-red-500 @enderror">{{ old('description') }}</textarea>
                @error('description')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-sm font-bold text-gray-700 mb-2">Supporting Evidence (Optional)</label>
                
                <label for="attachment" id="dropzone-label" class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-lg hover:border-blue-500 hover:bg-blue-50 transition bg-gray-50 cursor-pointer w-full group">
                    <div class="space-y-1 text-center" id="dropzone-content">
                        <svg class="mx-auto h-12 w-12 text-gray-400 group-hover:text-blue-500 transition duration-200" stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true">
                            <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                        <div class="flex flex-col items-center text-sm text-gray-600 justify-center mt-2">
                            <span class="font-medium text-blue-600 group-hover:text-blue-700">Click to browse files</span>
                            <p class="text-gray-500">or drag and drop</p>
                        </div>
                        <p class="text-xs text-gray-500 mt-2 font-semibold">PDF, PNG, JPG up to 2MB</p>
                    </div>
                    <input id="attachment" name="attachment" type="file" class="sr-only" accept=".pdf,.jpg,.jpeg,.png">
                </label>

                <div id="file-preview-container" class="hidden mt-4 p-4 bg-white border border-gray-200 rounded-lg shadow-sm flex items-center justify-between">
                    <div class="flex items-center gap-4 overflow-hidden">
                        <img id="preview-image" src="" alt="File Preview" class="hidden h-16 w-16 object-cover rounded border border-gray-200">
                        
                        <div id="preview-pdf" class="hidden h-16 w-16 bg-red-50 text-red-500 flex items-center justify-center rounded border border-red-100">
                            <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 24 24"><path d="M12 0c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm3 17h-6v-10h4.586l1.414 1.414v8.586zm-1-7.586l-1.414-1.414h-2.586v7h4v-5.586z"/></svg>
                        </div>

                        <div class="truncate">
                            <p id="preview-filename" class="text-sm font-bold text-gray-800 truncate"></p>
                            <p id="preview-filesize" class="text-xs text-gray-500"></p>
                        </div>
                    </div>

                    <button type="button" id="remove-file-btn" class="ml-4 text-gray-400 hover:text-red-500 focus:outline-none transition">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                    </button>
                </div>
            </div>

            <div class="bg-red-50 border border-red-200 rounded-lg p-4 flex items-start">
                <div class="flex items-center h-5">
                    <input id="is_emergency" name="is_emergency" type="checkbox" value="1" class="w-5 h-5 text-red-600 border-gray-300 rounded focus:ring-red-500 cursor-pointer">
                </div>
                <div class="ml-3 text-sm">
                    <label for="is_emergency" class="font-bold text-red-800 cursor-pointer">Flag as URGENT / Emergency</label>
                    <p class="text-red-600 mt-1">Only check this box if the issue requires immediate intervention (e.g., severe harassment, safety hazard).</p>
                </div>
            </div>

            <div class="bg-slate-100 border border-slate-200 rounded-lg p-4 flex items-start mb-6">
                <div class="flex items-center h-5">
                    <input id="is_anonymous" name="is_anonymous" type="checkbox" value="1" class="w-5 h-5 text-slate-800 border-gray-300 rounded focus:ring-slate-500 cursor-pointer">
                </div>
                <div class="ml-3 text-sm">
                    <label for="is_anonymous" class="font-bold text-slate-800 cursor-pointer">Submit Anonymously</label>
                    <p class="text-slate-600 mt-1">Your identity (Name and ID) will be completely hidden from the authorities reviewing this case. You will still be able to track its progress from your dashboard.</p>
                </div>
            </div>

            <div class="pt-4 border-t">
                <button type="submit" id="submit-btn" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-4 px-4 rounded-lg shadow-md transition transform hover:-translate-y-0.5 text-lg">
                    Submit Grievance
                </button>
            </div>
        </form>
    </main>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const fileInput = document.getElementById('attachment');
            const dropzoneLabel = document.getElementById('dropzone-label');
            const previewContainer = document.getElementById('file-preview-container');
            const previewImage = document.getElementById('preview-image');
            const previewPdf = document.getElementById('preview-pdf');
            const previewFilename = document.getElementById('preview-filename');
            const previewFilesize = document.getElementById('preview-filesize');
            const removeBtn = document.getElementById('remove-file-btn');
            const form = document.querySelector('form');
            const submitBtn = document.getElementById('submit-btn');


            fileInput.addEventListener('change', function(e) {
                const file = e.target.files[0];
                
                if (!file) return;

                // Update text details
                previewFilename.textContent = file.name;
                // Convert bytes to MB or KB
                const sizeInMB = (file.size / (1024 * 1024)).toFixed(2);
                if (sizeInMB > 2) {
                    alert('This file is ' + sizeInMB + 'MB. Please select a file smaller than 2MB.');
                    fileInput.value = ''; // Clear the input
                    return; // Stop processing
                }
                previewFilesize.textContent = sizeInMB > 1 ? `${sizeInMB} MB` : `${(file.size / 1024).toFixed(0)} KB`;

                // Display logic based on file type
                if (file.type.startsWith('image/')) {
                    // Generate live image preview
                    const reader = new FileReader();
                    reader.onload = function(event) {
                        previewImage.src = event.target.result;
                        previewImage.classList.remove('hidden');
                        previewPdf.classList.add('hidden');
                    }
                    reader.readAsDataURL(file);
                } else {
                    // Show PDF generic icon
                    previewImage.classList.add('hidden');
                    previewPdf.classList.remove('hidden');
                }

                // Hide the dropzone box and show the preview card
                dropzoneLabel.classList.add('hidden');
                previewContainer.classList.remove('hidden');
            });

            // Handle File Removal
            removeBtn.addEventListener('click', function(e) {
                e.preventDefault();
                
                // Clear the actual input value so Laravel doesn't receive it
                fileInput.value = ''; 
                
                // Reset the UI
                previewImage.src = '';
                previewContainer.classList.add('hidden');
                dropzoneLabel.classList.remove('hidden');
            });
        });

        form.addEventListener('submit', function() {
            // Disable the button
            submitBtn.disabled = true;
            // Change the appearance to look disabled and processing
            submitBtn.classList.add('opacity-75', 'cursor-not-allowed');
            submitBtn.innerHTML = 'Submitting... <span class="animate-pulse">⏳</span>';
        });
    </script>

</body>
</html>