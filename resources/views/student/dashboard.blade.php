<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Dashboard - MZU</title>
    @vite(['resources/css/app.css', 'resources/js/app.js']) 
</head>
<body class="bg-slate-50 antialiased font-sans text-gray-900">

    <nav class="bg-slate-900 text-white p-4 shadow-md flex justify-between items-center">
        <h1 class="text-xl font-bold tracking-wide">MZU Grievance Portal</h1>
        <div class="flex items-center gap-6">
            <span class="font-medium">Welcome, {{ Auth::user()->name }}</span>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="bg-red-500 hover:bg-red-600 px-4 py-2 rounded text-sm font-bold transition shadow-sm">Logout</button>
            </form>
        </div>
    </nav>

    <div class="max-w-5xl mx-auto mt-10 p-6">
        <div class="flex justify-between items-center mb-8 border-b pb-4">
            <div>
                <h2 class="text-3xl font-extrabold text-gray-800">My Grievances</h2>
                <p class="text-gray-500 mt-1">Track the real-time status of your submitted issues.</p>
            </div>
            <a href="{{ route('grievance.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg font-bold transition shadow-md transform hover:-translate-y-0.5">
                + Submit New Grievance
            </a>
        </div>

        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg mb-6 shadow-sm">
                {{ session('success') }}
            </div>
        @endif

        <div class="space-y-4">
            @forelse ($grievances as $grievance)
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden hover:shadow-md transition">
                    <div class="p-6">
                        <div class="flex justify-between items-start mb-3">
                            <div>
                                <span class="text-xs font-black uppercase tracking-wider text-blue-600 mb-1 block">
                                    {{ $grievance->category }} 
                                    @if($grievance->is_emergency)
                                        <span class="bg-red-100 text-red-700 px-2 py-0.5 rounded ml-2 animate-pulse">● URGENT</span>
                                    @endif
                                </span>
                                <h3 class="text-xl font-bold text-gray-800">{{ $grievance->subject }}</h3>
                            </div>
                            
                            <span id="status-badge-{{ $grievance->id }}" class="px-4 py-1.5 text-sm font-bold rounded-full border transition-colors duration-300
                                {{ $grievance->status === 'pending' ? 'bg-yellow-50 text-yellow-700 border-yellow-200' : '' }}
                                {{ $grievance->status === 'in_progress' ? 'bg-blue-50 text-blue-700 border-blue-200' : '' }}
                                {{ $grievance->status === 'resolved' ? 'bg-green-50 text-green-700 border-green-200' : '' }}
                                {{ $grievance->status === 'closed' ? 'bg-gray-50 text-gray-700 border-gray-200' : '' }}">
                                {{ ucfirst(str_replace('_', ' ', $grievance->status)) }}
                            </span>
                        </div>
                        
                        <p class="text-gray-600 text-base mb-4">{{ Str::limit($grievance->description, 120) }}</p>
                        
                        <div class="flex items-center justify-between text-sm text-gray-500 border-t pt-4">
                            <span>Ticket #{{ $grievance->id }} • Submitted on {{ $grievance->created_at->format('M d, Y \a\t h:i A') }}</span>
                            
                            <button onclick="toggleDetails('{{ $grievance->id }}')" class="text-blue-600 font-bold hover:underline focus:outline-none">
                                View Full Details ↓
                            </button>
                        </div>

                        <div id="details-{{ $grievance->id }}" class="hidden mt-6 bg-slate-50 p-5 rounded-lg border border-slate-200">
                            <h4 class="font-bold text-gray-800 mb-2">Full Description:</h4>
                            <p class="text-gray-700 whitespace-pre-wrap">{{ $grievance->description }}</p>
                            
                            @if($grievance->attachment_path)
                                <div class="mt-4 pt-4 border-t border-slate-200">
                                    <h4 class="font-bold text-gray-800 mb-2">Attached Evidence:</h4>
                                    <a href="{{ asset('storage/' . $grievance->attachment_path) }}" target="_blank" class="inline-flex items-center gap-2 bg-white border border-gray-300 px-4 py-2 rounded-md text-sm font-semibold text-blue-600 hover:bg-blue-50 transition">
                                        📄 View File
                                    </a>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            @empty
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-12 text-center">
                    <p class="text-gray-500 text-lg mb-4">You haven't submitted any grievances yet.</p>
                    <a href="{{ route('grievance.create') }}" class="text-blue-600 font-bold hover:underline">File your first grievance</a>
                </div>
            @endforelse
        </div>
    </div>

    <script>
        // Simple Vanilla JS to toggle the accordion
        function toggleDetails(id) {
            const detailsDiv = document.getElementById('details-' + id);
            if (detailsDiv.classList.contains('hidden')) {
                detailsDiv.classList.remove('hidden');
            } else {
                detailsDiv.classList.add('hidden');
            }
        }
    </script>

    <script type="module">
        const userId = {{ Auth::user()->id }};

        window.Echo.private(`student.${userId}`)
            .listen('GrievanceStatusUpdated', (event) => {
                const badge = document.getElementById(`status-badge-${event.grievance.id}`);
                
                if (badge) {
                    let statusText = event.grievance.status.replace('_', ' ');
                    badge.innerText = statusText.charAt(0).toUpperCase() + statusText.slice(1);
                    
                    badge.className = 'px-4 py-1.5 text-sm font-bold rounded-full border transition-colors duration-300 ';
                    
                    switch(event.grievance.status) {
                        case 'pending': badge.className += 'bg-yellow-50 text-yellow-700 border-yellow-200'; break;
                        case 'in_progress': badge.className += 'bg-blue-50 text-blue-700 border-blue-200'; break;
                        case 'resolved': badge.className += 'bg-green-50 text-green-700 border-green-200'; break;
                        case 'closed': badge.className += 'bg-gray-50 text-gray-700 border-gray-200'; break;
                    }
                }
            });
    </script>
</body>
</html>