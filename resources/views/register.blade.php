<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Registration - MZU</title>
    <link rel="preload" as="image" href="{{ asset('images/MZU-LOGO-2001-new.png') }}">
    <link rel="icon" type="image/png" href="{{ asset('images/MZU-LOGO-2001-new.png') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        .custom-select {
            appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke='%2364748b' stroke-width='2'%3E%3Cpath stroke-linecap='round' stroke-linejoin='round' d='M19 9l-7 7-7-7'%3E%3C/path%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 1.25rem center;
            background-size: 1.2rem;
            padding-right: 3.5rem !important;
        }
        body {
            overflow: hidden;
            height: 100vh;
        }

    </style>
</head>
<body class="bg-slate-50 antialiased font-sans text-slate-900 selection:bg-emerald-100 selection:text-emerald-900">

    <nav class="sticky top-0 z-40 w-full bg-emerald-950 border-b-2 border-emerald-500/30 shadow-[0_10px_30px_-10px_rgba(0,0,0,0.4)]">
        <div class="max-w mx-auto px-6 sm:px-10">
            <div class="flex justify-between items-center h-24"> 
                <div class="flex items-center gap-6">
                    <div class="relative group">
                        <div class="absolute -inset-1.5 bg-emerald-400/25 rounded-full blur-md opacity-75 group-hover:opacity-100 transition duration-500"></div>
                        <img src="{{ asset('images/MZU-LOGO-2001-new.png') }}" 
                            alt="MZU Logo" 
                            width="64" 
                            height="64" 
                            class="relative w-16 h-16 object-contain bg-white rounded-full p-1.5 shadow-xl border-2 border-emerald-400/50 transition-all duration-500">
                    </div>
                    <div class="flex flex-col">
                        <h1 class="text-3xl font-black tracking-tighter text-white leading-none">
                            MIZORAM <span class="text-emerald-400">UNIVERSITY</span>
                        </h1>
                        <div class="flex items-center gap-2 mt-1.5">
                            <span class="h-[1px] w-8 bg-emerald-500/50"></span>
                            <p class="text-[10px] font-black uppercase tracking-[0.3em] text-emerald-500/90">
                                Create your account
                            </p>
                        </div>
                    </div>
                </div>
                </div>
        </div>
    </nav>

    <main class="max-w-2xl mx-auto mt-2 p-6 mb-20">
        <div class="text-center mb-10">
            <h2 class="text-4xl font-black text-slate-900 tracking-tight">Create Account</h2>
            <p class="text-slate-500 mt-2 text-sm font-medium">Join the MZU Grievance Portal to voice your concerns.</p>
        </div>

        <div class="bg-white rounded-3xl shadow-[0_2px_15px_-3px_rgba(6,78,59,0.08)] border border-slate-100 p-8 sm:p-10">
            <form action="{{ route('register') }}" method="POST" class="space-y-6">
                @csrf

                <div class="group">
                    <label class="block text-[12px] font-black uppercase tracking-widest text-slate-400 mb-2 group-focus-within:text-emerald-600 transition-colors" for="name">Full Name</label>
                    <input type="text" id="name" name="name" value="{{ old('name') }}" 
                        class="w-full px-5 py-3.5 bg-slate-50 border border-slate-200 rounded-2xl text-sm font-bold focus:ring-4 focus:ring-emerald-500/10 focus:border-emerald-500 focus:bg-white transition-all outline-none @error('name') border-red-500 @enderror" placeholder="Aditya Singh" required>
                    @error('name') 
                        <span class="text-red-500 text-[10px] font-bold uppercase mt-2 block">{{ $message }}</span> 
                    @enderror
                </div>

                <div class="grid grid-cols-1 gap-6">
                    <div class="group">
                        <label class="block text-[12px] font-black uppercase tracking-widest text-slate-400 mb-2 group-focus-within:text-emerald-600 transition-colors" for="school">School</label>
                        <select id="school" name="school" class="custom-select w-full px-5 py-4 bg-slate-50 border border-slate-200 rounded-2xl text-sm font-bold focus:ring-4 focus:ring-emerald-500/10 focus:border-emerald-500 focus:bg-white transition-all outline-none" required>
                            <option value="" disabled {{ old('school') ? '' : 'selected' }}>Select School</option>
                            <option value="Earth Sciences & Natural Resources Management">School of Earth Sciences & Natural Resources Management</option>
                            <option value="Economics, Management & Information Sciences">School of Economics, Management & SEMIS</option>
                            <option value="Humanities and Languages">School of Humanities and Languages</option>
                            <option value="Engineering & Technology">School of Engineering & Technology</option>
                            <option value="Life Sciences">School of Life Sciences</option>
                            <option value="Physical Sciences">School of Physical Sciences</option>
                            <option value="Social Sciences">School of Social Sciences</option>
                            <option value="Fine Arts, Architecture & Fashion Technology">School of Fine Arts & Architecture</option>
                            <option value="Medical & Paramedical Sciences">School of Medical & Paramedical Sciences</option>
                            <option value="Education">School of Education</option>
                        </select>
                    </div>

                    <div class="group">
                        <label class="block text-[12px] font-black uppercase tracking-widest text-slate-400 mb-2 group-focus-within:text-emerald-600 transition-colors" for="department">Department</label>
                        <select id="department" name="department" class="custom-select w-full px-5 py-4 bg-slate-50 border border-slate-200 rounded-2xl text-sm font-bold focus:ring-4 focus:ring-emerald-500/10 focus:border-emerald-500 focus:bg-white transition-all outline-none" required>
                            <option value="" disabled selected>Select Department</option>
                        </select>
                        @error('department') 
                            <span class="text-red-500 text-[10px] font-bold uppercase mt-2 block">{{ $message }}</span> 
                        @enderror
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="group">
                        <label class="block text-[12px] font-black uppercase tracking-widest text-slate-400 mb-2 group-focus-within:text-emerald-600 transition-colors" for="student_id">ID Number</label>
                        <input type="text" id="student_id" name="student_id" value="{{ old('student_id') }}" 
                            class="w-full px-5 py-3.5 bg-slate-50 border border-slate-200 rounded-2xl text-sm font-bold focus:ring-4 focus:ring-emerald-500/10 focus:border-emerald-500 focus:bg-white transition-all outline-none @error('student_id') border-red-500 @enderror" placeholder="MZU123456789" required>
                    </div>
                    
                    <div class="group">
                        <label class="block text-[12px] font-black uppercase tracking-widest text-slate-400 mb-2 group-focus-within:text-emerald-600 transition-colors" for="email">University Email</label>
                        <input type="email" id="email" name="email" value="{{ old('email') }}" 
                            class="w-full px-5 py-3.5 bg-slate-50 border border-slate-200 rounded-2xl text-sm font-bold focus:ring-4 focus:ring-emerald-500/10 focus:border-emerald-500 focus:bg-white transition-all outline-none @error('email') border-red-500 @enderror" placeholder="mzu123456789@mzu.edu.in" required>
                    </div>
                </div>

                <div class="group">
                    <label class="block text-[12px] font-black uppercase tracking-widest text-slate-400 mb-2 group-focus-within:text-emerald-600 transition-colors" for="password">Password</label>
                    <input type="password" id="password" name="password" 
                        class="w-full px-5 py-3.5 bg-slate-50 border border-slate-200 rounded-2xl text-sm font-bold focus:ring-4 focus:ring-emerald-500/10 focus:border-emerald-500 focus:bg-white transition-all outline-none @error('password') border-red-500 @enderror" required>
                </div>

                <button type="submit" class="w-full bg-emerald-800 hover:bg-emerald-700 text-white text-base font-black py-4 rounded-2xl transition-all duration-300 shadow-lg shadow-emerald-900/20 active:scale-95 flex items-center justify-center gap-2">
                    Create Account
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path></svg>
                </button>
            </form>

            <div class="mt-8 pt-8 border-t border-slate-100 text-center">
                <p class="text-slate-500 text-sm font-bold tracking-tight">
                    Already have an account? 
                    <a href="{{ route('login') }}" class="text-emerald-700 hover:text-emerald-800 hover:underline ml-1">Login here</a>
                </p>
            </div>
        </div>
    </main>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const schoolSelect = document.getElementById('school');
            const departmentSelect = document.getElementById('department');
            const oldDepartment = "{{ old('department') }}";

            const schoolStructure = {
                'Earth Sciences & Natural Resources Management': ['Environmental Sciences', 'Extension Education & Rural Development', 'Forestry', 'Geography & Resource Management', 'Geology', 'Horticulture, Aromatic & Medicinal Plants (HAMP)', 'Petroleum Exploration', 'Centre for Disaster Management', 'Biodiversity Research Centre'],
                'Economics, Management & Information Sciences': ['Commerce', 'Economics', 'Library & Information Sciences', 'Management', 'Mass Communication', 'Tourism & Hospitality Management'],
                'Humanities and Languages': ['English and Culture Studies', 'Hindi', 'Mizo'],
                'Engineering & Technology': ['Computer Engineering', 'Electrical Engineering', 'Electronic & Communication Engineering', 'Information Technology', 'Civil Engineering', 'Food Technology'],
                'Life Sciences': ['Biotechnology', 'Botany', 'Zoology'],
                'Physical Sciences': ['Physics', 'Mathematics & Computer Science', 'Chemistry', 'Industrial Chemistry'],
                'Social Sciences': ['History & Ethnography', 'Political Science', 'Psychology', 'Public Administration', 'Social Work', 'Sociology'],
                'Fine Arts, Architecture & Fashion Technology': ['Planning & Architecture'],
                'Medical & Paramedical Sciences': ['Clinical Psychology'],
                'Education': ['Education']
            };

            function populateDepartments(selectedSchool, selectedDeptToKeep = '') {
                departmentSelect.innerHTML = '<option value="" disabled selected>Select Department</option>';
                if (schoolStructure[selectedSchool]) {
                    schoolStructure[selectedSchool].forEach(function(dept) {
                        const option = document.createElement('option');
                        option.value = dept;
                        option.textContent = dept;
                        if (dept === selectedDeptToKeep) option.selected = true;
                        departmentSelect.appendChild(option);
                    });
                }
            }

            if (schoolSelect.value) populateDepartments(schoolSelect.value, oldDepartment);
            schoolSelect.addEventListener('change', function() { populateDepartments(this.value); });
        });
    </script>
</body>
</html>