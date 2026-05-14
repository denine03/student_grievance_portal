<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Grievance Portal | Mizoram University</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Replace the script above with @vite('resources/css/app.css') in your actual project -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-slate-50 flex flex-col min-h-screen font-sans text-gray-900">

    <!-- Improved Navbar -->
    <nav class="bg-slate-900 text-white shadow-lg">
        <div class="max-w-7xl mx-auto px-4 py-4 flex justify-between items-center">
            <div class="flex items-center space-x-2">
                <div class="bg-blue-600 p-2 rounded-lg">
                    <i class="fas fa-university text-xl"></i>
                </div>
                <span class="font-bold text-xl tracking-tight">MZU Portal</span>
            </div>
            <div class="space-x-6 hidden md:flex">
                <a href="#" class="hover:text-blue-400 transition">About</a>
                <a href="#" class="hover:text-blue-400 transition">FAQ</a>
            </div>
        </div>
    </nav>

    <main class="flex-grow">
        <!-- Hero Section with Gradient -->
        <section class="bg-slate-900 text-white py-20 px-6 bg-[radial-gradient(circle_at_top_right,_var(--tw-gradient-stops))] from-slate-800 via-slate-900 to-black">
            <div class="max-w-4xl mx-auto text-center">
                <h1 class="text-4xl md:text-5xl font-extrabold mb-6">Student Grievance Portal</h1>
                <p class="text-xl text-slate-300 mb-10 leading-relaxed">
                    Your voice matters. Submit, track, and resolve your concerns with our 
                    fast and transparent digital support system.
                </p>
                <div class="flex flex-col sm:flex-row justify-center gap-4">
                    <a href="{{ route('login') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-4 px-8 rounded-xl shadow-lg transform hover:-translate-y-1 transition duration-300">
                       Login
                    </a>
                    <a href="{{ route('register') }}" class="bg-slate-700 hover:bg-slate-600 text-white font-bold py-4 px-8 rounded-xl shadow-lg transform hover:-translate-y-1 transition duration-300">
                        Register
                    </a>
                </div>
            </div>
        </section>

        <!-- Features Section (Fills the white space) -->
        <section class="max-w-6xl mx-auto py-16 px-6">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 text-center">
                <!-- Step 1 -->
                <div class="bg-white p-8 rounded-2xl shadow-sm border border-gray-100">
                    <div class="w-16 h-16 bg-blue-100 text-blue-600 rounded-full flex items-center justify-center mx-auto mb-6 text-2xl">
                        <i class="fas fa-pen-to-square"></i>
                    </div>
                    <h3 class="text-xl font-bold mb-3">Submit</h3>
                    <p class="text-gray-500">Easily log your academic or administrative concerns via our secure form.</p>
                </div>

                <!-- Step 2 -->
                <div class="bg-white p-8 rounded-2xl shadow-sm border border-gray-100">
                    <div class="w-16 h-16 bg-green-100 text-green-600 rounded-full flex items-center justify-center mx-auto mb-6 text-2xl">
                        <i class="fas fa-magnifying-glass"></i>
                    </div>
                    <h3 class="text-xl font-bold mb-3">Track</h3>
                    <p class="text-gray-500">Get real-time updates and notifications on the status of your request.</p>
                </div>

                <!-- Step 3 -->
                <div class="bg-white p-8 rounded-2xl shadow-sm border border-gray-100">
                    <div class="w-16 h-16 bg-purple-100 text-purple-600 rounded-full flex items-center justify-center mx-auto mb-6 text-2xl">
                        <i class="fas fa-check-circle"></i>
                    </div>
                    <h3 class="text-xl font-bold mb-3">Resolve</h3>
                    <p class="text-gray-500">Receive formal resolutions directly from the department heads.</p>
                </div>
            </div>
        </section>

        <!-- Information Banner -->
        <section class="bg-blue-50 border-y border-blue-100 py-12">
            <div class="max-w-4xl mx-auto px-6 text-center">
                <h2 class="text-2xl font-bold text-slate-800 mb-4">Strictly Confidential</h2>
                <p class="text-slate-600">All submissions are handled with the highest level of privacy and directed to the appropriate authorities for impartial review.</p>
            </div>
        </section>
    </main>

    <!-- Footer -->
    <footer class="bg-slate-900 text-slate-400 py-10 border-t border-slate-800">
        <div class="max-w-6xl mx-auto px-6 text-center">
            <p class="mb-2 font-semibold text-white">© 2026 Mizoram University</p>
            <p class="text-sm">Technical Support: <a href="mailto:support@mzu.edu.in" class="text-blue-400 hover:underline">support@mzu.edu.in</a></p>
            <div class="mt-6 flex justify-center space-x-6 text-lg">
                <a href="#" class="hover:text-white"><i class="fab fa-facebook"></i></a>
                <a href="#" class="hover:text-white"><i class="fab fa-twitter"></i></a>
                <a href="#" class="hover:text-white"><i class="fab fa-linkedin"></i></a>
            </div>
        </div>
    </footer>

</body>
</html>