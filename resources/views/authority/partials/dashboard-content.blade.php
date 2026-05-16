<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
    
    <a href="{{ route('authority.dashboard', ['status' => 'pending']) }}" class="ajax-filter-link group rounded-2xl p-7 shadow-[0_2px_10px_-3px_rgba(6,78,59,0.05)] border transition-all duration-300 flex items-center justify-between cursor-pointer focus:outline-none {{ request('status') === 'pending' ? 'bg-red-50/30 border-red-400 ring-1 ring-red-400' : 'bg-white border-slate-100 hover:border-red-100' }}">
        <div>
            <p class="text-[10px] font-extrabold text-slate-400 uppercase tracking-widest mb-1">Action Required</p>
            <h3 class="text-3xl font-black text-slate-900">{{ $pendingCount }}</h3>
            <p class="text-xs text-red-500 mt-1.5 font-bold flex items-center gap-1">
                <span class="w-1.5 h-1.5 rounded-full bg-red-500 animate-pulse"></span> Pending Review
            </p>
        </div>
        <div class="w-14 h-14 bg-red-50 text-red-500 rounded-2xl flex items-center justify-center shadow-inner group-hover:scale-110 transition-transform">
            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
        </div>
    </a>

    <a href="{{ route('authority.dashboard', ['status' => 'in_progress']) }}" class="ajax-filter-link group rounded-2xl p-7 shadow-[0_2px_10px_-3px_rgba(6,78,59,0.05)] border transition-all duration-300 flex items-center justify-between cursor-pointer focus:outline-none {{ request('status') === 'in_progress' ? 'bg-teal-50/30 border-teal-500 ring-1 ring-teal-500' : 'bg-white border-slate-100 hover:border-teal-100' }}">
        <div>
            <p class="text-[10px] font-extrabold text-slate-400 uppercase tracking-widest mb-1">Active Cases</p>
            <h3 class="text-3xl font-black text-slate-900">{{ $inProgressCount }}</h3>
            <p class="text-xs text-teal-600 mt-1.5 font-bold">Currently Processing</p>
        </div>
        <div class="w-14 h-14 bg-teal-50 text-teal-600 rounded-2xl flex items-center justify-center shadow-inner group-hover:scale-110 transition-transform">
            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
        </div>
    </a>

    <a href="{{ route('authority.dashboard', ['status' => 'resolved']) }}" class="ajax-filter-link group rounded-2xl p-7 shadow-[0_2px_10px_-3px_rgba(6,78,59,0.05)] border transition-all duration-300 flex items-center justify-between cursor-pointer focus:outline-none {{ request('status') === 'resolved' ? 'bg-emerald-50/30 border-emerald-500 ring-1 ring-emerald-500' : 'bg-white border-slate-100 hover:border-emerald-100' }}">
        <div>
            <p class="text-[10px] font-extrabold text-slate-400 uppercase tracking-widest mb-1">Total Resolved</p>
            <h3 class="text-3xl font-black text-slate-900">{{ $resolvedCount }}</h3>
            <p class="text-xs text-emerald-600 mt-1.5 font-bold">Successfully Closed</p>
        </div>
        <div class="w-14 h-14 bg-emerald-50 text-emerald-600 rounded-2xl flex items-center justify-center shadow-inner group-hover:scale-110 transition-transform">
            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
        </div>
    </a>

</div>

@if(request()->filled('status'))
    <div class="flex justify-end mb-8">
        <a href="{{ route('authority.dashboard') }}" class="ajax-filter-link text-xs font-bold bg-slate-200 hover:bg-slate-300 text-slate-600 px-4 py-2.5 rounded-lg transition-colors flex items-center gap-2">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
            Clear Filter (Viewing {{ ucfirst(str_replace('_', ' ', request('status'))) }})
        </a>
    </div>
@endif

<div class="space-y-5">
    @forelse ($grievances as $grievance)
        <div class="group bg-white rounded-2xl shadow-[0_2px_10px_-3px_rgba(6,78,59,0.05)] border border-slate-100 hover:border-emerald-200 transition-all duration-300 overflow-hidden">
            <div class="p-6 sm:p-8 flex flex-col md:flex-row justify-between items-start md:items-center gap-6">
                
                <div class="flex-1 space-y-2">
                    <div class="flex items-center flex-wrap gap-2">
                        <span class="text-[10px] font-extrabold uppercase tracking-widest text-emerald-700/80 bg-emerald-50 px-2.5 py-1 rounded-md">
                            {{ $grievance->category }}
                        </span>
                        @if($grievance->is_emergency)
                            <span class="flex items-center gap-1.5 text-[10px] font-extrabold uppercase tracking-widest text-red-600 bg-red-50 px-2.5 py-1 rounded-md">
                                <span class="w-1.5 h-1.5 rounded-full bg-red-500 animate-pulse"></span> URGENT
                            </span>
                        @endif
                        @if($grievance->is_anonymous)
                            <span class="text-[10px] font-extrabold uppercase tracking-widest text-white bg-slate-800 px-2.5 py-1 rounded-md flex items-center gap-1">
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                                Anonymous
                            </span>
                        @endif
                    </div>
                    
                    <h3 class="text-xl font-bold text-slate-800 leading-tight group-hover:text-emerald-700 transition-colors">{{ $grievance->subject }}</h3>
                    <p class="text-slate-500 text-sm leading-relaxed line-clamp-1 max-w-2xl">{{ $grievance->description }}</p>
                    
                    <div class="flex items-center gap-3 pt-2">
                        @if($grievance->is_anonymous)
                            <p class="text-[11px] font-bold text-slate-400 uppercase tracking-wide">Identity Protected • {{ $grievance->created_at->format('M d, Y') }}</p>
                        @else
                            <p class="text-[11px] font-bold text-slate-400 uppercase tracking-wide">
                                Student: <span class="text-slate-600 underline decoration-emerald-200">{{ $grievance->student->name ?? 'ID: '.$grievance->student_id }}</span> • {{ $grievance->created_at->format('M d, Y') }}
                            </p>
                        @endif
                    </div>
                </div>

                <div class="flex flex-col sm:flex-row md:flex-col items-start sm:items-center md:items-end gap-4 w-full md:w-auto shrink-0 border-t md:border-t-0 md:border-l border-slate-100 pt-5 md:pt-0 md:pl-8">
                    <button onclick="openModal('{{ $grievance->id }}')" class="group/btn text-emerald-700 hover:text-emerald-900 font-extrabold text-sm flex items-center gap-2 transition-all focus:outline-none">
                        <div class="w-8 h-8 bg-emerald-50 rounded-lg flex items-center justify-center group-hover/btn:bg-emerald-100 transition-colors">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                        </div>
                        Review Case
                    </button>

                    <form action="{{ route('authority.grievance.update', $grievance->id) }}" method="POST" class="flex items-center gap-2 w-full sm:w-auto">
                        @csrf
                        @method('PATCH')
                        
                        <select name="status" class="bg-slate-50 border border-slate-200 text-slate-700 text-xs font-bold rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 block p-2.5 transition-all outline-none">
                            <option value="pending" {{ $grievance->status == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="in_progress" {{ $grievance->status == 'in_progress' ? 'selected' : '' }}>In Progress</option>
                            <option value="resolved" {{ $grievance->status == 'resolved' ? 'selected' : '' }}>Resolved</option>
                            <option value="closed" {{ $grievance->status == 'closed' ? 'selected' : '' }}>Closed</option>
                        </select>

                        <button type="submit" class="bg-emerald-800 hover:bg-emerald-700 text-white px-4 py-2.5 rounded-xl text-xs font-black transition-all shadow-sm">
                            UPDATE
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <div id="modal-{{ $grievance->id }}" class="hidden fixed inset-0 z-50 items-center justify-center bg-slate-900/70 backdrop-blur-md p-4 transition-all duration-300 opacity-0">
            <div class="bg-white rounded-3xl shadow-2xl w-full max-w-2xl overflow-hidden flex flex-col max-h-[90vh] transform scale-95 transition-all duration-300">
                
                <div class="bg-slate-50 border-b border-slate-100 px-8 py-5 flex justify-between items-center shrink-0">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 bg-emerald-100 rounded-xl flex items-center justify-center text-emerald-700">
                            <span class="font-black text-xs">#{{ $grievance->id }}</span>
                        </div>
                        <div>
                            <h3 class="text-lg font-black text-slate-800 tracking-tight">Grievance Report</h3>
                            <span class="text-[10px] uppercase font-extrabold tracking-widest text-emerald-600">{{ $grievance->category }}</span>
                        </div>
                    </div>
                    <button onclick="closeModal('{{ $grievance->id }}')" class="w-8 h-8 flex items-center justify-center rounded-full bg-slate-100 text-slate-400 hover:bg-red-50 hover:text-red-500 transition-all focus:outline-none">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                    </button>
                </div>
                
                <div class="p-8 overflow-y-auto no-scrollbar">
                    <div class="space-y-8">
                        <div>
                            <h4 class="text-[10px] font-extrabold text-slate-400 uppercase tracking-widest mb-2">Subject</h4>
                            <p class="text-xl font-bold text-slate-800 leading-snug">{{ $grievance->subject }}</p>
                        </div>

                        <div>
                            <h4 class="text-[10px] font-extrabold text-slate-400 uppercase tracking-widest mb-3">Case Description</h4>
                            <div class="bg-slate-50 p-6 rounded-2xl border border-slate-100 text-slate-700 text-sm leading-relaxed whitespace-pre-wrap italic">"{{ $grievance->description }}"</div>
                        </div>

                        <div class="pt-6 border-t border-slate-100">
                            <h4 class="text-[10px] font-extrabold text-slate-400 uppercase tracking-widest mb-4">Evidence & Artifacts</h4>
                            
                            @if($grievance->attachment_path)
                                <button onclick="toggleAttachment('{{ $grievance->id }}')" id="btn-attach-{{ $grievance->id }}" class="group flex items-center gap-3 bg-white border border-slate-200 px-5 py-3 rounded-xl text-sm font-bold text-slate-700 hover:text-emerald-700 hover:border-emerald-200 hover:bg-emerald-50/50 transition-all shadow-sm focus:outline-none">
                                    <svg class="w-5 h-5 text-slate-400 group-hover:text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13"></path></svg>
                                    <span>Show Attached Evidence</span>
                                </button>

                                <div id="viewer-{{ $grievance->id }}" class="hidden mt-4 border border-slate-200 rounded-2xl bg-white p-2 h-[400px] shadow-inner overflow-hidden">
                                    <iframe loading="lazy" src="{{ route('grievance.attachment', $grievance->id) }}" class="w-full h-full rounded-xl border-0"></iframe>
                                </div>
                            @else
                                <div class="flex items-center gap-3 text-slate-400 py-2">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                    <p class="text-sm italic">No supporting evidence was provided for this case.</p>
                                </div>
                            @endif
                        </div>

                        <div class="mt-8 pt-6 border-t border-slate-100">
                            <h4 class="text-[10px] font-extrabold text-slate-400 uppercase tracking-widest mb-4">Case Communication</h4>
                            
                            <div id="chat-container-{{ $grievance->id }}" class="space-y-4 max-h-72 overflow-y-auto pr-2 mb-5 flex flex-col-reverse no-scrollbar">
                                @forelse($grievance->comments as $comment)
                                    @if($comment->user_id === Auth::id())
                                        <div class="flex justify-end mb-2">
                                            <div class="bg-emerald-700 text-white p-3.5 rounded-2xl rounded-tr-sm max-w-[85%] shadow-sm">
                                                <p class="text-sm leading-relaxed">{{ $comment->body }}</p>
                                                <span class="text-[10px] text-emerald-200 mt-1.5 block text-right font-medium">
                                                    You • {{ $comment->created_at->diffForHumans() }}
                                                </span>
                                            </div>
                                        </div>
                                    @else
                                        <div class="flex justify-start gap-3 mb-2">
                                            <div class="w-8 h-8 rounded-full bg-slate-200 flex-shrink-0 flex items-center justify-center font-bold text-slate-500 text-xs shadow-inner">
                                                {{ substr($comment->user->name ?? 'S', 0, 1) }}
                                            </div>
                                            <div class="bg-slate-50 border border-slate-200/60 text-slate-700 p-3.5 rounded-2xl rounded-tl-sm max-w-[85%] shadow-sm">
                                                <p class="text-[10px] font-black text-emerald-800 uppercase tracking-widest mb-1">
                                                    {{ $comment->user->name ?? 'Student' }} 
                                                    <span class="text-slate-400 font-bold ml-1">({{ $grievance->is_anonymous ? 'Anonymous' : 'ID: '.$grievance->student_id }})</span>
                                                </p>
                                                <p class="text-sm leading-relaxed">{{ $comment->body }}</p>
                                                <span class="text-[10px] text-slate-400 mt-1.5 block font-medium">
                                                    {{ $comment->created_at->diffForHumans() }}
                                                </span>
                                            </div>
                                        </div>
                                    @endif
                                @empty
                                    <div class="text-center py-6">
                                        <p class="text-sm text-slate-400 italic">No conversation history yet. Send a message to the student.</p>
                                    </div>
                                @endforelse
                            </div>
                            
                            <div id="typing-indicator-{{ $grievance->id }}" class="text-[10px] font-extrabold text-emerald-500 uppercase tracking-widest mb-2 h-4 transition-opacity duration-300 opacity-0">
                            </div>
                            
                            <form action="{{ route('authority.comment', $grievance->id) }}" method="POST" class="chat-ajax-form relative flex items-end gap-2" data-grievance-id="{{ $grievance->id }}">
                                @csrf
                                <div class="relative w-full">
                                    <textarea name="body" rows="2" placeholder="Send a message to the student..." required class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 outline-none resize-none shadow-sm transition-all"></textarea>
                                </div>
                                <button type="submit" class="shrink-0 bg-emerald-800 hover:bg-emerald-700 text-white h-[46px] px-5 rounded-xl font-bold shadow-md transition-all flex items-center gap-2 focus:outline-none mb-1">
                                    <span class="hidden sm:inline text-sm">Send</span>
                                    <svg class="w-4 h-4 transform rotate-90" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path></svg>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    @empty
        <div class="bg-white rounded-3xl shadow-sm border border-slate-100 p-16 flex flex-col items-center justify-center text-center">
            <div class="w-20 h-20 bg-emerald-50 rounded-full flex items-center justify-center mb-6">
                <svg class="w-10 h-10 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
            </div>
            <h3 class="text-xl font-bold text-slate-800 mb-2">Queue is Empty</h3>
            <p class="text-slate-500 text-sm max-w-sm">There are no pending grievances in your department that require review at this time.</p>
        </div>
    @endforelse
</div>