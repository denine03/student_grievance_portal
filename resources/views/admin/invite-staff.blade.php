<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invite Staff - Admin Dashboard</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100 antialiased text-gray-900 min-h-screen">

    <nav class="bg-slate-900 text-white p-4 shadow-md flex justify-between items-center">
        <h1 class="text-xl font-bold">MZU Admin Console</h1>
        <a href="{{ route('admin.dashboard') }}" class="text-sm hover:underline">Back to Dashboard</a>
    </nav>

    <div class="max-w-lg mx-auto mt-16 bg-white p-8 rounded-lg shadow-sm border border-gray-200">
        <h2 class="text-2xl font-bold text-gray-800 mb-6">Send Staff Invitation</h2>

        @if(session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('admin.send_invite') }}" method="POST">
            @csrf
            <div class="mb-5">
                <label class="block text-gray-700 font-bold mb-2" for="email">Staff Email Address</label>
                <input type="email" id="email" name="email" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 outline-none" placeholder="dean@mzu.edu.in" required>
                @error('email')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-4 rounded-lg transition duration-200">
                Send Secure Invitation
            </button>
        </form>
    </div>

</body>
</html>