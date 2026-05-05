<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Submit Grievance</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100 antialiased font-sans text-gray-900">

    <!-- Navigation Bar -->
    <nav class="bg-slate-800 text-white p-4 shadow-md flex justify-between items-center">
        <h1 class="text-xl font-bold">MZU Grievance Portal</h1>
        <div class="flex items-center gap-4">
            <a href="{{ route('student.dashboard') }}" class="text-slate-300 hover:text-white">Dashboard</a>
            <span>|</span>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="text-red-400 hover:text-red-300 font-semibold">Logout</button>
            </form>
        </div>
    </nav>

    <!-- Form Container -->
    <div class="max-w-2xl mx-auto mt-10 p-6 bg-white rounded-lg shadow-md border border-gray-200">
        <h2 class="text-2xl font-bold text-gray-800 mb-6">Submit a New Grievance</h2>

        <!-- Note the enctype! This is REQUIRED for file uploads -->
        <form action="{{ route('grievance.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- Category -->
            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2">Category</label>
                <select name="category" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 bg-white" required>
                    <option value="" disabled selected>Select the type of issue</option>
                    <option value="Academic">Academic / Examinations</option>
                    <option value="Hostel">Hostel / Accommodation</option>
                    <option value="Finance">Finance / Fees</option>
                    <option value="Harassment">Harassment / Anti-Ragging</option>
                    <option value="Infrastructure">Infrastructure / Maintenance</option>
                </select>
            </div>

            <!-- Subject -->
            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2">Subject</label>
                <input type="text" name="subject" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500" placeholder="Brief summary of the issue" required>
            </div>

            <!-- Description -->
            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2">Detailed Description</label>
                <textarea name="description" rows="5" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500" placeholder="Please provide as much detail as possible..." required></textarea>
            </div>

            <!-- Attachment -->
            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2">Supporting Evidence (Optional)</label>
                <input type="file" name="attachment" class="w-full px-4 py-2 border rounded-lg bg-gray-50 focus:outline-none">
                <p class="text-xs text-gray-500 mt-1">Accepted formats: PDF, JPG, PNG (Max 2MB)</p>
            </div>

            <!-- Emergency Toggle (From our earlier discussion) -->
            <div class="mb-8 flex items-center">
                <input type="checkbox" name="is_emergency" id="is_emergency" value="1" class="w-5 h-5 text-red-600 border-gray-300 rounded focus:ring-red-500">
                <label for="is_emergency" class="ml-2 text-red-600 font-bold">Flag as URGENT / Emergency</label>
            </div>

            <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-4 rounded-lg transition">
                Submit Grievance
            </button>
        </form>
    </div>

</body>
</html>