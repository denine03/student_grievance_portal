<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Staff Registration - MZU Portal</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100 antialiased font-sans text-gray-900">

    <div class="min-h-screen flex items-center justify-center p-6">
        
        <div class="max-w-xl w-full bg-white rounded-lg shadow-lg p-10 border border-gray-200">
            <h2 class="text-3xl font-bold text-center text-gray-800 mb-8">Create Staff Account</h2>

            <form action="{{ route('staff.register') }}" method="POST">
                @csrf

                <div class="mb-5">
                    <label class="block text-gray-700 text-base font-bold mb-2" for="name">Full Name</label>
                    <input type="text" id="name" name="name" value="{{ old('name') }}" 
                        class="w-full px-4 py-3 text-base border rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-500 @error('name') border-red-500 @enderror" required>
                    @error('name') 
                        <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> 
                    @enderror
                </div>

                <div class="mb-5">
                    <label for="role" class="block text-gray-700 text-base font-bold mb-2">Staff Position</label>
                    <select name="role" id="role" required class="w-full px-4 py-3 text-base border rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-500 bg-white">
                        <option value="" disabled selected>Select your position</option>
                        <option value="hod" {{ old('role') == 'hod' ? 'selected' : '' }}>Head of Department (HOD)</option>
                        <option value="dean" {{ old('role') == 'dean' ? 'selected' : '' }}>Dean</option>
                        <option value="dsw_head" {{ old('role') == 'dsw_head' ? 'selected' : '' }}>DSW Head</option>
                    </select>
                    @error('role') 
                        <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> 
                    @enderror
                </div>

                <div class="mb-5 hidden transition-all duration-300" id="school-wrapper">
                    <label class="block text-gray-700 text-base font-bold mb-2" for="school">University School</label>
                    <select id="school" name="school" class="w-full px-4 py-3 text-base border rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-500 bg-white">
                        <option value="" disabled selected>Select School</option>
                        <option value="Earth Sciences & Natural Resources Management" {{ old('school') == 'Earth Sciences & Natural Resources Management' ? 'selected' : '' }}>Earth Sciences & Natural Resources Management</option>
                        <option value="Economics, Management & Information Sciences" {{ old('school') == 'Economics, Management & Information Sciences' ? 'selected' : '' }}>Economics, Management & Information Sciences</option>
                        <option value="Humanities and Languages" {{ old('school') == 'Humanities and Languages' ? 'selected' : '' }}>Humanities and Languages</option>
                        <option value="Engineering & Technology" {{ old('school') == 'Engineering & Technology' ? 'selected' : '' }}>Engineering & Technology</option>
                        <option value="Life Sciences" {{ old('school') == 'Life Sciences' ? 'selected' : '' }}>Life Sciences</option>
                        <option value="Physical Sciences" {{ old('school') == 'Physical Sciences' ? 'selected' : '' }}>Physical Sciences</option>
                        <option value="Social Sciences" {{ old('school') == 'Social Sciences' ? 'selected' : '' }}>Social Sciences</option>
                        <option value="Fine Arts, Architecture & Fashion Technology" {{ old('school') == 'Fine Arts, Architecture & Fashion Technology' ? 'selected' : '' }}>Fine Arts, Architecture & Fashion Technology</option>
                        <option value="Medical & Paramedical Sciences" {{ old('school') == 'Medical & Paramedical Sciences' ? 'selected' : '' }}>Medical & Paramedical Sciences</option>
                        <option value="Education" {{ old('school') == 'Education' ? 'selected' : '' }}>Education</option>
                    </select>
                </div>

                <div class="mb-5 hidden transition-all duration-300" id="department-wrapper">
                    <label class="block text-gray-700 text-base font-bold mb-2" for="department">Specific Department</label>
                    <select id="department" name="department" class="w-full px-4 py-3 text-base border rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-500 bg-white">
                        <option value="" disabled selected>Select Department</option>
                    </select>
                    @error('department') 
                        <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> 
                    @enderror
                </div>
                
                <div class="mb-5">
                    <label class="block text-gray-700 text-base font-bold mb-2" for="email">University Email</label>
                    <input type="email" id="email" name="email" value="{{ old('email') }}" 
                        class="w-full px-4 py-3 text-base border rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-500 @error('email') border-red-500 @enderror" placeholder="staff@mzu.edu.in" required>
                    @error('email') 
                        <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> 
                    @enderror
                </div>

                <div class="mb-8">
                    <label class="block text-gray-700 text-base font-bold mb-2" for="password">Password</label>
                    <input type="password" id="password" name="password" 
                        class="w-full px-4 py-3 text-base border rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-500 @error('password') border-red-500 @enderror" required>
                    @error('password') 
                        <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> 
                    @enderror
                </div>

                <button type="submit" class="w-full bg-teal-600 hover:bg-teal-700 text-white text-lg font-bold py-3 px-4 rounded-lg transition duration-300 ease-in-out transform hover:-translate-y-0.5 shadow-md">
                    Register Staff Account
                </button>
            </form>

            <p class="text-center text-gray-600 text-base mt-8 border-t pt-6">
                Already have a staff account? <a href="{{ route('login') }}" class="text-teal-600 hover:text-teal-800 hover:underline font-semibold">Login here</a>
            </p>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const roleSelect = document.getElementById('role');
            const schoolWrapper = document.getElementById('school-wrapper');
            const schoolSelect = document.getElementById('school');
            const departmentWrapper = document.getElementById('department-wrapper');
            const departmentSelect = document.getElementById('department');
            
            const oldDepartment = "{{ old('department') }}";

            const schoolStructure = {
                'Earth Sciences & Natural Resources Management': ['Environmental Sciences', 'Extension Education & Rural Development', 'Forestry', 'Geography & Resource Management', 'Geology', 'Horticulture, Aromatic & Medicinal Plants (HAMP)','Petroleum Exploration','Centre for Disaster Management','Biodiversity Research Centre'],
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
                        if (dept === selectedDeptToKeep) {
                            option.selected = true;
                        }
                        departmentSelect.appendChild(option);
                    });
                }
            }

            function handleRoleChange() {
                const role = roleSelect.value;

                if (role === 'dsw_head') {
                    schoolWrapper.classList.add('hidden');
                    schoolSelect.required = false;
                    departmentWrapper.classList.add('hidden');
                    departmentSelect.innerHTML = '<option value="Directorate of Student Welfare" selected>Directorate of Student Welfare</option>';
                
                } else if (role === 'dean') {
                    schoolWrapper.classList.remove('hidden');
                    schoolSelect.required = true;
                    departmentWrapper.classList.add('hidden');
                    departmentSelect.innerHTML = '<option value="Dean\'s Office" selected>Dean\'s Office</option>';
                
                } else if (role === 'hod') {
                    schoolWrapper.classList.remove('hidden');
                    schoolSelect.required = true;
                    departmentWrapper.classList.remove('hidden');
                    departmentSelect.required = true;
                    
                    if (schoolSelect.value) {
                        populateDepartments(schoolSelect.value, oldDepartment);
                    } else {
                        departmentSelect.innerHTML = '<option value="" disabled selected>Select Department</option>';
                    }
                } else {
                    schoolWrapper.classList.add('hidden');
                    departmentWrapper.classList.add('hidden');
                }
            }

            roleSelect.addEventListener('change', handleRoleChange);
            
            schoolSelect.addEventListener('change', function() {
                if (roleSelect.value === 'hod') {
                    populateDepartments(this.value);
                }
            });

            if (roleSelect.value) {
                handleRoleChange();
            }
        });
    </script>

</body>
</html>