<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Dashboard</title>
    @vite('resources/css/app.css') </head>
<body class="bg-gray-100 antialiased font-sans text-gray-900">

    <nav class="bg-slate-800 text-white p-4 shadow-md flex justify-between items-center">
        <h1 class="text-xl font-bold">MZU Grievance Portal</h1>
        <div class="flex items-center gap-4">
            <span>Welcome, {{ Auth::user()->name }}</span>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="bg-red-600 hover:bg-red-700 px-4 py-2 rounded text-sm font-semibold transition">Logout</button>
            </form>
        </div>
    </nav>

    <div class="max-w-6xl mx-auto mt-10 p-6">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-bold text-gray-800">My Grievances</h2>
            <a href="#" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg font-semibold transition shadow-sm">
                + Submit New Grievance
            </a>
        </div>

        <div class="bg-white p-10 rounded-lg shadow-sm border border-gray-200 text-center">
            <p class="text-gray-500 mb-4">You haven't submitted any grievances yet.</p>
        </div>
    </div>

</body>
</html>