<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Submit Grievance - MZU Portal</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-slate-50 antialiased font-sans text-slate-900 selection:bg-emerald-100 selection:text-emerald-900">

    <nav class="sticky top-0 z-40 w-full bg-emerald-950 border-b-2 border-emerald-500/30 shadow-[0_10px_30px_-10px_rgba(0,0,0,0.4)]">
        <div class="max-w mx-auto px-6 sm:px-10">
            <div class="flex justify-between items-center h-24"> 
                
                <div class="flex items-center gap-6 mr-10">
                    <div class="relative group">
                        <div class="absolute -inset-1.5 bg-emerald-400/25 rounded-full blur-md opacity-75 group-hover:opacity-100 transition duration-500"></div>
                        <img src="{{ asset('images/MZU-LOGO-2001-new.png') }}" alt="MZU Logo" 
                            class="relative w-16 h-16 object-contain bg-white rounded-full p-1.5 shadow-xl border-2 border-emerald-400/50 transition-all duration-500">
                    </div>
                    
                    <div class="flex flex-col">
                        <h1 class="text-3xl font-black tracking-tighter text-white leading-none">
                            MIZORAM <span class="text-emerald-400">UNIVERSITY</span>
                        </h1>
                        <div class="flex items-center gap-2 mt-1.5">
                            <span class="h-[1px] w-8 bg-emerald-500/50"></span>
                            <p class="text-[10px] font-black uppercase tracking-[0.3em] text-emerald-500/90">
                                New Grievance Submission
                            </p>
                        </div>
                    </div>
                </div>

                <div class="flex items-center gap-4">
                    
                    <a href="{{ route('student.dashboard') }}" class="group hidden lg:flex items-center gap-4 bg-white/5 px-5 py-2.5 h-[52px] rounded-xl border border-white/10 backdrop-blur-md shadow-sm hover:bg-white/10 transition-all">
                        <div class="flex flex-col items-end">
                            <span class="text-3x1 font-bold text-white leading-none tracking-tight">Return to Dashboard</span>
                        </div>
                        <div class="w-8 h-8 rounded-lg bg-emerald-500/20 group-hover:bg-emerald-500 text-emerald-400 group-hover:text-emerald-950 flex items-center justify-center transition-all">
                            <svg class="w-4 h-4 transition-transform group-hover:-translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                            </svg>
                        </div>
                    </a>

                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="group flex items-center gap-3 bg-red-500/10 hover:bg-red-600 border border-red-500/20 hover:border-red-500 px-5 py-2.5 h-[52px] rounded-xl transition-all shadow-lg active:scale-95 focus:outline-none">
                            <span class="text-xs font-black text-white capitalize tracking-widest group-hover:text-white">Logout</span>
                            <div class="w-8 h-8 rounded-lg bg-red-500/20 group-hover:bg-white/20 flex items-center justify-center transition-colors">
                                <svg class="w-4 h-4 text-red-500 group-hover:text-white transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                                </svg>
                            </div>
                        </button>
                    </form>
                </div>

            </div>
        </div>
    </nav>

    <main class="max-w-3xl mx-auto my-12 px-6">
        <div class="bg-white rounded-3xl shadow-[0_2px_15px_-3px_rgba(6,78,59,0.05)] border border-slate-100 overflow-hidden">
            <div class="p-8 sm:p-12">
                <div class="mb-10">
                    <h2 class="text-3xl font-black text-slate-900 tracking-tight">File a New Grievance</h2>
                    <p class="text-slate-500 mt-2 text-sm">Please provide detailed information so our authorities can resolve your issue quickly.</p>
                </div>

                <form action="{{ route('grievance.store') }}" method="POST" enctype="multipart/form-data" class="space-y-7">
                    @csrf

                    <div>
                        <label class="block text-xs font-extrabold uppercase tracking-widest text-slate-400 mb-3">Category <span class="text-red-500">*</span></label>
                        <select name="category" required class="w-full px-4 py-3.5 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:bg-white transition-all outline-none @error('category') border-red-500 @enderror">
                            <option value="" disabled {{ old('category') ? '' : 'selected' }}>Select an issue type...</option>
                            <option value="Academic" {{ old('category') == 'Academic' ? 'selected' : '' }}>Academic / Examinations</option>
                            <option value="Hostel" {{ old('category') == 'Hostel' ? 'selected' : '' }}>Hostel / Accommodation</option>
                            <option value="Infrastructure" {{ old('category') == 'Infrastructure' ? 'selected' : '' }}>Infrastructure / Facilities</option>
                            <option value="Harassment" {{ old('category') == 'Harassment' ? 'selected' : '' }}>Harassment / Disciplinary</option>
                            <option value="Other" {{ old('category') == 'Other' ? 'selected' : '' }}>Other</option>
                        </select>
                        @error('category')
                            <p class="text-red-500 text-xs mt-1.5 font-semibold">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-xs font-extrabold uppercase tracking-widest text-slate-400 mb-3">Subject <span class="text-red-500">*</span></label>
                        <input type="text" name="subject" value="{{ old('subject') }}" required placeholder="Brief summary of the issue" class="w-full px-4 py-3.5 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:bg-white transition-all outline-none @error('subject') border-red-500 @enderror">
                        @error('subject')
                            <p class="text-red-500 text-xs mt-1.5 font-semibold">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-xs font-extrabold uppercase tracking-widest text-slate-400 mb-3">Detailed Description <span class="text-red-500">*</span></label>
                        <textarea name="description" rows="5" required placeholder="Please explain the situation in detail..." class="w-full px-4 py-3.5 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:bg-white transition-all outline-none resize-none @error('description') border-red-500 @enderror">{{ old('description') }}</textarea>
                        @error('description')
                            <p class="text-red-500 text-xs mt-1.5 font-semibold">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-xs font-extrabold uppercase tracking-widest text-slate-400 mb-3">Supporting Evidence (Optional)</label>
                        
                        <label for="attachment" id="dropzone-label" class="mt-1 flex justify-center px-6 pt-8 pb-8 border-2 border-slate-200 border-dashed rounded-2xl hover:border-emerald-500 hover:bg-emerald-50/30 transition-all bg-slate-50 cursor-pointer w-full group">
                            <div class="space-y-2 text-center" id="dropzone-content">
                                <svg class="mx-auto h-10 w-10 text-slate-300 group-hover:text-emerald-500 transition-colors" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                                    <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                                <div class="flex flex-col items-center text-sm text-slate-600 justify-center">
                                    <span class="font-bold text-emerald-700 group-hover:text-emerald-800">Click to browse files</span>
                                    <p class="text-slate-400 text-xs mt-1">or drag and drop (PDF, PNG, JPG up to 2MB)</p>
                                </div>
                            </div>
                            <input id="attachment" name="attachment" type="file" class="sr-only" accept=".pdf,.jpg,.jpeg,.png">
                        </label>

                        <div id="file-preview-container" class="hidden mt-4 p-4 bg-white border border-emerald-100 rounded-2xl shadow-sm flex items-center justify-between animate-[fadeIn_0.3s_ease-out]">
                            <div class="flex items-center gap-4 overflow-hidden">
                                <img id="preview-image" src="" alt="File Preview" class="hidden h-14 w-14 object-cover rounded-lg border border-slate-100">
                                
                                <div id="preview-pdf" class="hidden h-14 w-14 bg-emerald-50 text-emerald-600 flex items-center justify-center rounded-lg border border-emerald-100">
                                    <svg class="w-7 h-7" fill="currentColor" viewBox="0 0 24 24"><path d="M12 0c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm3 17h-6v-10h4.586l1.414 1.414v8.586zm-1-7.586l-1.414-1.414h-2.586v7h4v-5.586z"/></svg>
                                </div>

                                <div class="truncate">
                                    <p id="preview-filename" class="text-sm font-bold text-slate-800 truncate"></p>
                                    <p id="preview-filesize" class="text-[10px] uppercase font-bold text-slate-400"></p>
                                </div>
                            </div>

                            <button type="button" id="remove-file-btn" class="ml-4 w-8 h-8 flex items-center justify-center rounded-full bg-slate-50 text-slate-400 hover:text-red-500 hover:bg-red-50 transition-all focus:outline-none">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                            </button>
                        </div>
                    </div>

                    <div class="space-y-4">
                        <label for="is_emergency" class="flex items-start gap-4 p-4 bg-red-50/50 border border-red-100 rounded-2xl cursor-pointer hover:bg-red-50 transition-colors">
                            <div class="flex items-center h-5 mt-0.5">
                                <input id="is_emergency" name="is_emergency" type="checkbox" value="1" class="w-5 h-5 text-red-600 border-slate-300 rounded focus:ring-red-500 cursor-pointer">
                            </div>
                            <div>
                                <span class="block font-bold text-red-900 text-sm">Flag as URGENT / Emergency</span>
                                <p class="text-red-600/80 text-xs mt-1 leading-relaxed">Only check this box if the issue requires immediate intervention (e.g., severe harassment, safety hazard).</p>
                            </div>
                        </label>

                        <label for="is_anonymous" class="flex items-start gap-4 p-4 bg-slate-50 border border-slate-200 rounded-2xl cursor-pointer hover:bg-slate-100 transition-colors">
                            <div class="flex items-center h-5 mt-0.5">
                                <input id="is_anonymous" name="is_anonymous" type="checkbox" value="1" class="w-5 h-5 text-emerald-700 border-slate-300 rounded focus:ring-emerald-500 cursor-pointer">
                            </div>
                            <div>
                                <span class="block font-bold text-slate-800 text-sm">Submit Anonymously</span>
                                <p class="text-slate-500 text-xs mt-1 leading-relaxed">Your identity will be hidden from authorities. You can still track progress from your dashboard.</p>
                            </div>
                        </label>
                    </div>

                    <div class="pt-6 border-t border-slate-100">
                        <button type="submit" id="submit-btn" class="w-full bg-emerald-800 hover:bg-emerald-700 text-white font-bold py-4 rounded-xl shadow-md transition-all transform hover:-translate-y-0.5 text-lg flex items-center justify-center gap-2">
                            Submit Grievance
                        </button>
                    </div>
                </form>
            </div>
        </div>
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

                previewFilename.textContent = file.name;
                const sizeInMB = (file.size / (1024 * 1024)).toFixed(2);
                if (sizeInMB > 2) {
                    alert('This file is ' + sizeInMB + 'MB. Please select a file smaller than 2MB.');
                    fileInput.value = '';
                    return;
                }
                previewFilesize.textContent = sizeInMB > 1 ? `${sizeInMB} MB` : `${(file.size / 1024).toFixed(0)} KB`;

                if (file.type.startsWith('image/')) {
                    const reader = new FileReader();
                    reader.onload = function(event) {
                        previewImage.src = event.target.result;
                        previewImage.classList.remove('hidden');
                        previewPdf.classList.add('hidden');
                    }
                    reader.readAsDataURL(file);
                } else {
                    previewImage.classList.add('hidden');
                    previewPdf.classList.remove('hidden');
                }

                dropzoneLabel.classList.add('hidden');
                previewContainer.classList.remove('hidden');
            });

            removeBtn.addEventListener('click', function(e) {
                e.preventDefault();
                fileInput.value = ''; 
                previewImage.src = '';
                previewContainer.classList.add('hidden');
                dropzoneLabel.classList.remove('hidden');
            });

            form.addEventListener('submit', function() {
                submitBtn.disabled = true;
                submitBtn.classList.add('opacity-75', 'cursor-not-allowed');
                submitBtn.innerHTML = 'Submitting... <span class="animate-pulse">⏳</span>';
            });
        });
    </script>
</body>
</html>