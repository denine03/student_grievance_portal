<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Authority Dashboard - MZU Portal</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100 antialiased font-sans text-gray-900 flex flex-col min-h-screen">

    <nav class="bg-teal-800 text-white p-4 shadow-md flex justify-between items-center">
        <div class="flex items-center gap-4">
            <h1 class="text-xl font-bold border-r pr-4 border-teal-600">MZU Staff Portal</h1>
            <span class="text-sm text-teal-200">Department Overview</span>
        </div>
        <div class="flex items-center gap-4">
            <span class="font-semibold">{{ Auth::user()->name }} ({{ strtoupper(Auth::user()->role) }})</span>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="bg-red-500 hover:bg-red-600 px-4 py-2 rounded text-sm font-bold transition shadow-sm">Logout</button>
            </form>
        </div>
    </nav>

    <main class="max-w-6xl mx-auto mt-8 p-6 w-full flex-grow">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-bold text-gray-800">Department Action Queue</h2>
        </div>

        <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
            <div class="p-10 text-center">
                <p class="text-gray-500">Your queue is empty. No pending grievances require your attention.</p>
            </div>
        </div>
    </main>

    <footer class="bg-teal-800 text-center text-teal-200 p-4 text-sm mt-auto">
        &copy; 2026 Mizoram University - Authority Console
    </footer>
</body>
</html>