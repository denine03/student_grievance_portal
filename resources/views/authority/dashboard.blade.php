<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Authority Dashboard - MZU Portal</title>
    @vite(['resources/css/app.css'])
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

        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
            @forelse ($grievances as $grievance)
                <div class="p-6 border-b border-gray-100 last:border-0 hover:bg-gray-50 transition flex justify-between items-center">
                    
                    <div class="w-2/3">
                        <span class="text-xs font-bold uppercase tracking-wider text-teal-600 mb-1 block">
                            {{ $grievance->category }}
                            @if($grievance->is_emergency)
                                <span class="text-red-500 ml-2 animate-pulse">● URGENT</span>
                            @endif
                        </span>
                        <h3 class="text-lg font-bold text-gray-800">{{ $grievance->subject }}</h3>
                        <p class="text-gray-600 text-sm mt-2">{{ Str::limit($grievance->description, 100) }}</p>
                        <p class="text-xs text-gray-400 mt-2">Student ID: {{ $grievance->student_id }} | Submitted: {{ $grievance->created_at->format('M d, Y') }}</p>
                    </div>

                    <div class="w-1/3 flex flex-col items-end">
                        <form action="{{ route('authority.grievance.update', $grievance->id) }}" method="POST" class="flex items-center gap-2">
                            @csrf
                            @method('PATCH')
                            
                            <select name="status" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded focus:ring-teal-500 focus:border-teal-500 block p-2">
                                <option value="pending" {{ $grievance->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="in_progress" {{ $grievance->status == 'in_progress' ? 'selected' : '' }}>In Progress</option>
                                <option value="resolved" {{ $grievance->status == 'resolved' ? 'selected' : '' }}>Resolved</option>
                                <option value="closed" {{ $grievance->status == 'closed' ? 'selected' : '' }}>Closed</option>
                            </select>

                            <button type="submit" class="bg-teal-600 hover:bg-teal-700 text-white px-3 py-2 rounded text-sm font-semibold transition">
                                Update
                            </button>
                        </form>
                    </div>

                </div>
            @empty
                <div class="p-10 text-center">
                    <p class="text-gray-500">Your queue is empty. No pending grievances require your attention.</p>
                </div>
            @endforelse
        </div>
    </main>

    <footer class="bg-teal-800 text-center text-teal-200 p-4 text-sm mt-auto">
        &copy; 2026 Mizoram University - Authority Console
    </footer>
</body>
</html>