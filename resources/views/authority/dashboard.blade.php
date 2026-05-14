<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Authority Dashboard - MZU Portal</title>
    @vite(['resources/css/app.css'])
</head>
<body class="bg-gray-100 antialiased font-sans text-gray-900 flex flex-col min-h-screen">

    <nav class="bg-teal-800 text-white p-4 shadow-md flex justify-between items-center z-10 relative">
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
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4 shadow-sm">
                {{ session('success') }}
            </div>
        @endif

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            
            <div class="bg-white rounded-xl shadow-sm border border-red-100 p-6 flex items-center justify-between hover:shadow-md transition">
                <div>
                    <p class="text-sm font-bold text-gray-500 uppercase tracking-wider mb-1">Action Required</p>
                    <h3 class="text-3xl font-black text-gray-800">{{ $pendingCount }}</h3>
                    <p class="text-xs text-red-500 mt-1 font-semibold">Pending Review</p>
                </div>
                <div class="w-14 h-14 bg-red-50 text-red-500 rounded-full flex items-center justify-center">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-sm border border-blue-100 p-6 flex items-center justify-between hover:shadow-md transition">
                <div>
                    <p class="text-sm font-bold text-gray-500 uppercase tracking-wider mb-1">Active Cases</p>
                    <h3 class="text-3xl font-black text-gray-800">{{ $inProgressCount }}</h3>
                    <p class="text-xs text-blue-500 mt-1 font-semibold">In Progress</p>
                </div>
                <div class="w-14 h-14 bg-blue-50 text-blue-500 rounded-full flex items-center justify-center">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-sm border border-green-100 p-6 flex items-center justify-between hover:shadow-md transition">
                <div>
                    <p class="text-sm font-bold text-gray-500 uppercase tracking-wider mb-1">Total Resolved</p>
                    <h3 class="text-3xl font-black text-gray-800">{{ $resolvedCount }}</h3>
                    <p class="text-xs text-green-500 mt-1 font-semibold">Cases Closed</p>
                </div>
                <div class="w-14 h-14 bg-green-50 text-green-600 rounded-full flex items-center justify-center">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
            </div>

        </div>
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">

        <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
            @forelse ($grievances as $grievance)
                <div class="p-6 border-b border-gray-100 last:border-0 hover:bg-gray-50 transition flex justify-between items-center">
                    
                    <div class="w-2/3">
                        <span class="text-xs font-bold uppercase tracking-wider text-teal-600 mb-1 block">
                            {{ $grievance->category }}
                            @if($grievance->is_emergency)
                                <span class="bg-red-100 text-red-700 px-2 py-0.5 rounded ml-2 animate-pulse">● URGENT</span>
                            @endif
                            @if($grievance->is_anonymous)
                                <span class="bg-slate-800 text-white px-2 py-0.5 rounded ml-2">ANONYMOUS</span>
                            @endif
                        </span>
                        
                        <h3 class="text-lg font-bold text-gray-800">{{ $grievance->subject }}</h3>
                        <p class="text-gray-600 text-sm mt-2">{{ Str::limit($grievance->description, 100) }}</p>
                        
                        <div class="mt-3">
                            @if($grievance->is_anonymous)
                                <p class="text-xs text-gray-500 italic flex items-center gap-1">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                                    Identity protected at student's request | Submitted: {{ $grievance->created_at->format('M d, Y') }}
                                </p>
                            @else
                                <p class="text-xs text-gray-400 mt-2">
                                    Submitted by: <span class="font-semibold text-gray-600">{{ $grievance->student->name ?? 'Student ID: ' . $grievance->student_id }}</span> | 
                                    Submitted: {{ $grievance->created_at->format('M d, Y') }}
                                </p>
                            @endif
                        </div>
                    </div>

                    <div class="w-1/3 flex flex-col items-end gap-3">
                        <button onclick="openModal('{{ $grievance->id }}')" class="text-teal-600 hover:text-teal-800 font-bold text-sm flex items-center gap-1 transition focus:outline-none">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                            Review Full Case
                        </button>

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

                <div id="modal-{{ $grievance->id }}" class="hidden fixed inset-0 z-50 items-center justify-center bg-slate-900 bg-opacity-60 backdrop-blur-sm p-4 transition-opacity duration-300">
                    <div class="bg-white rounded-xl shadow-2xl w-full max-w-2xl overflow-hidden flex flex-col max-h-[90vh] transform transition-transform scale-100">
                        
                        <div class="bg-slate-50 border-b border-gray-200 px-6 py-4 flex justify-between items-center">
                            <div>
                                <h3 class="text-xl font-extrabold text-gray-800">Case #{{ $grievance->id }} Details</h3>
                                <span class="text-sm text-teal-600 font-semibold">{{ $grievance->category }}</span>
                            </div>
                            <button onclick="closeModal('{{ $grievance->id }}')" class="text-gray-400 hover:text-red-500 transition focus:outline-none">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                            </button>
                        </div>
                        
                        <div class="p-6 overflow-y-auto">
                            
                            <div class="mb-5">
                                <h4 class="text-xs font-bold text-gray-500 uppercase tracking-wider mb-1">Subject</h4>
                                <p class="text-gray-900 font-bold text-lg">{{ $grievance->subject }}</p>
                            </div>

                            <div class="mb-6">
                                <h4 class="text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">Detailed Description</h4>
                                <div class="bg-gray-50 p-4 rounded-lg border border-gray-200 text-gray-700 whitespace-pre-wrap leading-relaxed break-words">{{ $grievance->description }}</div>
                            </div>

                            <div class="mt-6 pt-6 border-t border-gray-100">
                                <h4 class="text-xs font-bold text-gray-500 uppercase tracking-wider mb-3">Attached Evidence</h4>
                                
                                @if($grievance->attachment_path)
                                    <button onclick="toggleAttachment('{{ $grievance->id }}')" id="btn-attach-{{ $grievance->id }}" class="inline-flex items-center gap-2 bg-white border border-gray-300 px-4 py-2.5 rounded-lg text-sm font-bold text-blue-600 hover:bg-blue-50 hover:border-blue-300 transition shadow-sm focus:outline-none">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13"></path></svg>
                                        <span>Show Attached File</span>
                                    </button>

                                    <div id="viewer-{{ $grievance->id }}" class="hidden mt-4 border border-gray-200 rounded-lg bg-gray-100 p-2 h-96 shadow-inner">
                                        <iframe src="{{ asset('storage/' . $grievance->attachment_path) }}" class="w-full h-full rounded border border-gray-300 bg-white"></iframe>
                                    </div>
                                @else
                                    <div class="bg-gray-50 px-4 py-3 rounded-lg border border-gray-100 border-dashed">
                                        <p class="text-sm text-gray-400 italic flex items-center gap-2">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                            No evidence was uploaded for this case.
                                        </p>
                                    </div>
                                @endif
                            </div>

                        </div>
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

    <script>
        // Modal logic
        function openModal(id) {
            const modal = document.getElementById('modal-' + id);
            modal.classList.remove('hidden');
            modal.classList.add('flex');
            document.body.classList.add('overflow-hidden');
        }

        function closeModal(id) {
            const modal = document.getElementById('modal-' + id);
            modal.classList.add('hidden');
            modal.classList.remove('flex');
            document.body.classList.remove('overflow-hidden');
            
            const viewer = document.getElementById('viewer-' + id);
            if(viewer && !viewer.classList.contains('hidden')) {
                toggleAttachment(id);
            }
        }

        window.onclick = function(event) {
            if (event.target.id.startsWith('modal-')) {
                event.target.classList.add('hidden');
                event.target.classList.remove('flex');
                document.body.classList.remove('overflow-hidden');
            }
        }

        function toggleAttachment(id) {
            const viewer = document.getElementById('viewer-' + id);
            const btnSpan = document.querySelector('#btn-attach-' + id + ' span');

            if (viewer.classList.contains('hidden')) {
                viewer.classList.remove('hidden');
                btnSpan.innerText = 'Hide Attached File';
            } else {
                viewer.classList.add('hidden');
                btnSpan.innerText = 'Show Attached File';
            }
        }
    </script>
</body>
</html>