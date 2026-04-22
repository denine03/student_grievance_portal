<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Student Registration - Grievance Portal</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100 antialiased font-sans text-gray-900">

    <div class="min-h-screen flex items-center justify-center p-6">
        
        <div class="max-w-xl w-full bg-white rounded-lg shadow-lg p-10 border border-gray-200">
            <h2 class="text-3xl font-bold text-center text-gray-800 mb-8">Create Student Account</h2>

            <form action="{{ route('register') }}" method="POST">
                @csrf

                <div class="mb-5">
                    <label class="block text-gray-700 text-base font-bold mb-2" for="name">Full Name</label>
                    <input type="text" id="name" name="name" value="{{ old('name') }}" 
                        class="w-full px-4 py-3 text-base border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('name') border-red-500 @enderror" required>
                    @error('name') 
                        <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> 
                    @enderror
                </div>

                <div class="mb-5">
                    <label class="block text-gray-700 text-base font-bold mb-2" for="school">School</label>
                    <select id="school" name="school" class="w-full px-4 py-3 text-base border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 bg-white" required>
                        <option value="" disabled {{ old('school') ? '' : 'selected' }}>Select School</option>
                        <option value="Earth Sciences & Natural Resources Management" {{ old('school') == 'Earth Sciences & Natural Resources Management' ? 'selected' : '' }}>School of Earth Sciences & Natural Resources Management</option>
                        <option value="Economics, Management & Information Sciences" {{ old('school') == 'Economics, Management & Information Sciences' ? 'selected' : '' }}>School of Economics, Management & Information Sciences (SEMIS)</option>
                        <option value="Humanities and Languages" {{ old('school') == 'Humanities and Languages' ? 'selected' : '' }}>School of Humanities and Languages</option>
                        <option value="Engineering & Technology" {{ old('school') == 'Engineering & Technology' ? 'selected' : '' }}>School of Engineering & Technology</option>
                        <option value="Life Sciences" {{ old('school') == 'Life Sciences' ? 'selected' : '' }}>School of Life Sciences</option>
                        <option value="Physical Sciences" {{ old('school') == 'Physical Sciences' ? 'selected' : '' }}>School of Physical Sciences</option>
                        <option value="Social Sciences" {{ old('school') == 'Social Sciences' ? 'selected' : '' }}>School of Social Sciences</option>
                        <option value="Fine Arts, Architecture & Fashion Technology" {{ old('school') == 'Fine Arts, Architecture & Fashion Technology' ? 'selected' : '' }}>School of Fine Arts, Architecture & Fashion Technology</option>
                        <option value="Medical & Paramedical Sciences" {{ old('school') == 'Medical & Paramedical Sciences' ? 'selected' : '' }}>School of Medical & Paramedical Sciences</option>
                        <option value="Education" {{ old('school') == 'Education' ? 'selected' : '' }}>School of Education</option>
                    </select>
                </div>

                <div class="mb-5">
                    <label class="block text-gray-700 text-base font-bold mb-2" for="department">Department</label>
                    <select id="department" name="department" class="w-full px-4 py-3 text-base border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 bg-white" required>
                        <option value="" disabled selected>Select Department</option>
                    </select>
                    @error('department') 
                        <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> 
                    @enderror
                </div>

                <div class="mb-5">
                    <label class="block text-gray-700 text-base font-bold mb-2" for="student_id">ID Number</label>
                    <input type="text" id="student_id" name="student_id" value="{{ old('student_id') }}" 
                        class="w-full px-4 py-3 text-base border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('student_id') border-red-500 @enderror" placeholder="MZU1234567890" required>
                    @error('student_id') 
                        <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> 
                    @enderror
                </div>
                
                <div class="mb-5">
                    <label class="block text-gray-700 text-base font-bold mb-2" for="email">University Email</label>
                    <input type="email" id="email" name="email" value="{{ old('email') }}" 
                        class="w-full px-4 py-3 text-base border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('email') border-red-500 @enderror" placeholder="mzu1234567890@mzu.edu.in" required>
                    @error('email') 
                        <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> 
                    @enderror
                </div>

                <div class="mb-8">
                    <label class="block text-gray-700 text-base font-bold mb-2" for="password">Password</label>
                    <input type="password" id="password" name="password" 
                        class="w-full px-4 py-3 text-base border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('password') border-red-500 @enderror" required>
                    @error('password') 
                        <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> 
                    @enderror
                </div>

                <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white text-lg font-bold py-3 px-4 rounded-lg transition duration-300 ease-in-out transform hover:-translate-y-0.5">
                    Register
                </button>
            </form>

            <p class="text-center text-gray-600 text-base mt-8 border-t pt-6">
                Already have an account? <a href="{{ route('login') }}" class="text-blue-600 hover:text-blue-800 hover:underline font-semibold">Login here</a>
            </p>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const schoolSelect = document.getElementById('school');
            const departmentSelect = document.getElementById('department');
            
            // Fetch old department value if validation failed
            const oldDepartment = "{{ old('department') }}";

            // Map MZU Schools to their respective Departments
            const schoolStructure = {
                'Earth Sciences & Natural Resources Management': [
                    'Environmental Sciences', 
                    'Extension Education & Rural Development', 
                    'Forestry', 
                    'Geography & Resource Management', 
                    'Geology', 
                    'Horticulture, Aromatic & Medicinal Plants (HAMP)',
                    'Petroleum Exploration',
                    'Centre for Disaster Management',
                    'Biodiversity Research Centre'
                ],
                'Economics, Management & Information Sciences': [
                    'Commerce', 
                    'Economics', 
                    'Library & Information Sciences', 
                    'Management', 
                    'Mass Communication', 
                    'Tourism & Hospitality Management'
                ],
                'Humanities and Languages': [
                    'English and Culture Studies', 
                    'Hindi', 
                    'Mizo'
                ],
                'Engineering & Technology': [
                    'Computer Engineering', 
                    'Electrical Engineering', 
                    'Electronic & Communication Engineering', 
                    'Information Technology', 
                    'Civil Engineering', 
                    'Food Technology'
                ],
                'Life Sciences': [
                    'Biotechnology', 
                    'Botany', 
                    'Zoology'
                ],
                'Physical Sciences': [
                    'Physics', 
                    'Mathematics & Computer Science', 
                    'Chemistry', 
                    'Industrial Chemistry'
                ],
                'Social Sciences': [
                    'History & Ethnography', 
                    'Political Science', 
                    'Psychology', 
                    'Public Administration', 
                    'Social Work', 
                    'Sociology'
                ],
                'Fine Arts, Architecture & Fashion Technology': [
                    'Planning & Architecture'
                ],
                'Medical & Paramedical Sciences': [
                    'Clinical Psychology'
                ],
                'Education': [
                    'Education'
                ]
            };

            // Function to populate the department dropdown
            function populateDepartments(selectedSchool, selectedDeptToKeep = '') {
                // Clear existing options
                departmentSelect.innerHTML = '<option value="" disabled selected>Select Department</option>';
                
                if (schoolStructure[selectedSchool]) {
                    schoolStructure[selectedSchool].forEach(function(dept) {
                        const option = document.createElement('option');
                        option.value = dept;
                        option.textContent = dept;
                        
                        // Retain selection if old input exists
                        if (dept === selectedDeptToKeep) {
                            option.selected = true;
                        }
                        
                        departmentSelect.appendChild(option);
                    });
                }
            }

            // 1. Run on page load (Crucial for handling Laravel validation errors)
            if (schoolSelect.value) {
                populateDepartments(schoolSelect.value, oldDepartment);
            }

            // 2. Run whenever the user changes the school selection
            schoolSelect.addEventListener('change', function() {
                populateDepartments(this.value);
            });
        });
    </script>

</body>
</html>