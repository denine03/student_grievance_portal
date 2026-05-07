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
            <a href="{{ route('grievance.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg font-semibold transition shadow-sm">
                + Submit New Grievance
            </a>
        </div>

    <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
            @forelse ($grievances as $grievance)
                <div class="p-6 border-b border-gray-100 last:border-0 hover:bg-gray-50 transition">
                    <div class="flex justify-between items-start mb-2">
                        <div>
                            <span class="text-xs font-bold uppercase tracking-wider text-blue-600 mb-1 block">
                                {{ $grievance->category }} 
                                @if($grievance->is_emergency)
                                    <span class="text-red-500 ml-2 animate-pulse">● URGENT</span>
                                @endif
                            </span>
                            <h3 class="text-lg font-bold text-gray-800">{{ $grievance->subject }}</h3>
                        </div>
                        
                        <span class="px-3 py-1 text-sm font-semibold rounded-full 
                            {{ $grievance->status === 'pending' ? 'bg-yellow-100 text-yellow-800' : '' }}
                            {{ $grievance->status === 'in_progress' ? 'bg-blue-100 text-blue-800' : '' }}
                            {{ $grievance->status === 'resolved' ? 'bg-green-100 text-green-800' : '' }}
                            {{ $grievance->status === 'closed' ? 'bg-gray-100 text-gray-800' : '' }}">
                            {{ ucfirst(str_replace('_', ' ', $grievance->status)) }}
                        </span>
                    </div>
                    
                    <p class="text-gray-600 text-sm mb-4">{{ Str::limit($grievance->description, 150) }}</p>
                    
                    <div class="flex items-center justify-between text-sm text-gray-500">
                        <span>Submitted on: {{ $grievance->created_at->format('M d, Y') }}</span>
                    </div>
                </div>
            @empty
                <div class="p-10 text-center">
                    <p class="text-gray-500 mb-4">You haven't submitted any grievances yet.</p>
                </div>
            @endforelse
        </div>
    </div>

</body>
</html>