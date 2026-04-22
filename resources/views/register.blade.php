<<<<<<< HEAD
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Student Registration - Grievance Portal</title>
    
    <script src="https://cdn.tailwindcss.com"></script>
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
=======
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Student Registration</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            background: #f4f6f9;
        }

        header {
            background: #2c3e50;
            color: white;
            padding: 30px 20px;
            text-align: center;
        }

        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 50px 20px;
        }

        .form-box {
            background: white;
            padding: 30px;
            width: 350px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        }

        .form-box h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        .form-box input {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        .btn {
            width: 100%;
            background: #1abc9c;
            color: white;
            padding: 12px;
            border: none;
            margin-top: 10px;
            border-radius: 5px;
            cursor: pointer;
        }

        .btn:hover {
            background: #16a085;
        }

        .login-link {
            text-align: center;
            margin-top: 15px;
        }

        .login-link a {
            text-decoration: none;
            color: #1abc9c;
        }

        footer {
            background: #2c3e50;
            color: white;
            text-align: center;
            padding: 15px;
        }
    </style>
</head>

<body>

<header>
    <h1>Student Grievance Portal</h1>
    <p>Create your account to raise complaints</p>
</header>

<div class="container">
    <div class="form-box">
        <h2>Register</h2>

        <form action="/register" method="POST">
            <input type="text" name="name" placeholder="Full Name" required>
            <input type="text" name="student_id" placeholder="Student ID" required>
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Password" required>
            <input type="password" name="confirm_password" placeholder="Confirm Password" required>

            <button type="submit" class="btn">Register</button>
        </form>

        <div class="login-link">
            <p>Already have an account? <a href="/login">Login</a></p>
        </div>
    </div>
</div>

<footer>
    <p>© 2026 Mizoram University | Email: support@mzu.edu.in</p>
</footer>

</body>
>>>>>>> 2d809f1a9042a2f2d501e0cd1003d1165b1e6a41
</html>