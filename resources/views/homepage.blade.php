<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Grievance Portal</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100 flex flex-col min-h-screen font-sans text-gray-900">

    <header class="bg-slate-800 text-white py-8 text-center shadow-md">
        <h1 class="text-3xl font-bold mb-2">Student Grievance Portal</h1>
        <p class="text-slate-300 text-sm">Raise your concerns easily & track them</p>
    </header>

    <main class="flex-grow flex flex-col items-center justify-center p-6 text-center">
        <div class="max-w-2xl bg-white p-10 rounded-lg shadow-md border border-gray-200">
            <h2 class="text-2xl font-bold text-gray-800 mb-4">Welcome to the Support System</h2>
            <p class="text-gray-600 mb-8">
                Fast, Transparent & Efficient Grievance Handling. This platform allows students to submit complaints regarding academics, facilities, or administration and track their status.
            </p>

            <div class="flex justify-center space-x-4">
                <a href="{{ route('login') }}" class="bg-slate-800 hover:bg-slate-700 text-white font-bold py-3 px-6 rounded-lg transition duration-300">
                    Login
                </a>
                <a href="{{ route('register') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-6 rounded-lg transition duration-300">
                    Register
                </a>
            </div>
        </div>
    </main>

    <footer class="bg-slate-800 text-white text-center py-4 text-sm mt-auto">
        <p>© 2026 Mizoram University | Email: support@mzu.edu.in</p>
    </footer>

</body>
</html>