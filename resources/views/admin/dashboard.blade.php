<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - MZU Portal</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100 antialiased font-sans text-gray-900 flex flex-col min-h-screen">

    <nav class="bg-indigo-900 text-white p-4 shadow-md flex justify-between items-center">
        <div class="flex items-center gap-4">
            <h1 class="text-xl font-bold border-r pr-4 border-indigo-700">MZU Admin Portal</h1>
            <span class="text-sm text-indigo-300">System Overview</span>
        </div>
        <div class="flex items-center gap-4">
            <span class="font-semibold">Super Admin: {{ Auth::user()->name }}</span>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="bg-red-500 hover:bg-red-600 px-4 py-2 rounded text-sm font-bold transition shadow-sm">Logout</button>
            </form>
        </div>
    </nav>

    <main class="max-w-7xl mx-auto mt-8 p-6 w-full flex-grow">
        
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
            <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200 border-l-4 border-l-blue-500">
                <p class="text-sm text-gray-500 font-bold uppercase">Total Grievances</p>
                <h3 class="text-3xl font-black text-gray-800 mt-1">0</h3>
            </div>
            <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200 border-l-4 border-l-yellow-500">
                <p class="text-sm text-gray-500 font-bold uppercase">Pending Review</p>
                <h3 class="text-3xl font-black text-gray-800 mt-1">0</h3>
            </div>
            <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200 border-l-4 border-l-green-500">
                <p class="text-sm text-gray-500 font-bold uppercase">Resolved</p>
                <h3 class="text-3xl font-black text-gray-800 mt-1">0</h3>
            </div>
            <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200 border-l-4 border-l-red-500 bg-red-50">
                <p class="text-sm text-red-500 font-bold uppercase">Urgent / Emergency</p>
                <h3 class="text-3xl font-black text-red-700 mt-1">0</h3>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
            <div class="p-6 border-b border-gray-200 flex justify-between items-center bg-gray-50">
                <h2 class="text-xl font-bold text-gray-800">Recent Global Activity</h2>
                <button class="text-sm text-indigo-600 font-bold hover:underline">View All Tickets &rarr;</button>
            </div>
            <div class="p-10 text-center">
                <p class="text-gray-500">No grievances have been submitted to the system yet.</p>
                </div>
        </div>
    </main>

    <footer class="bg-indigo-900 text-center text-indigo-300 p-4 text-sm mt-auto">
        &copy; 2026 Mizoram University - Admin Console
    </footer>
</body>
</html>