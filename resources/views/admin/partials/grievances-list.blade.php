<div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-6 mb-10">
    <a href="{{ route('admin.grievances') }}" class="ajax-filter-link group rounded-2xl p-7 shadow-[0_2px_10px_-3px_rgba(6,78,59,0.05)] border transition-all duration-300 flex items-center justify-between focus:outline-none {{ !request('status') ? 'bg-blue-50/30 border-blue-500 ring-1 ring-blue-500' : 'bg-white border-slate-100 hover:border-blue-200' }}">
        <div>
            <p class="text-[10px] font-extrabold text-slate-400 uppercase tracking-widest mb-1">Total Grievances</p>
            <h3 class="text-3xl font-black text-slate-900">{{ $totalGrievances }}</h3>
            <p class="text-xs text-blue-600 mt-1.5 font-bold">System Wide</p>
        </div>
        <div class="w-14 h-14 bg-blue-50 text-blue-600 rounded-2xl flex items-center justify-center shadow-inner group-hover:scale-110 transition-transform">
            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 002-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
        </div>
    </a>

    <a href="{{ route('admin.grievances', ['status' => 'pending']) }}" class="ajax-filter-link group rounded-2xl p-7 shadow-[0_2px_10px_-3px_rgba(6,78,59,0.05)] border transition-all duration-300 flex items-center justify-between focus:outline-none {{ request('status') === 'pending' ? 'bg-amber-50/30 border-amber-500 ring-1 ring-amber-500' : 'bg-white border-slate-100 hover:border-amber-200' }}">
        <div>
            <p class="text-[10px] font-extrabold text-slate-400 uppercase tracking-widest mb-1">Pending Review</p>
            <h3 class="text-3xl font-black text-slate-900">{{ $pendingCount }}</h3>
            <p class="text-xs text-amber-600 mt-1.5 font-bold flex items-center gap-1">
                <span class="w-1.5 h-1.5 rounded-full bg-amber-500 animate-pulse"></span> Requires Action
            </p>
        </div>
        <div class="w-14 h-14 bg-amber-50 text-amber-600 rounded-2xl flex items-center justify-center shadow-inner group-hover:scale-110 transition-transform">
            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
        </div>
    </a>

    <a href="{{ route('admin.grievances', ['status' => 'resolved']) }}" class="ajax-filter-link group rounded-2xl p-7 shadow-[0_2px_10px_-3px_rgba(6,78,59,0.05)] border transition-all duration-300 flex items-center justify-between focus:outline-none {{ request('status') === 'resolved' ? 'bg-emerald-50/30 border-emerald-500 ring-1 ring-emerald-500' : 'bg-white border-slate-100 hover:border-emerald-200' }}">
        <div>
            <p class="text-[10px] font-extrabold text-slate-400 uppercase tracking-widest mb-1">Total Resolved</p>
            <h3 class="text-3xl font-black text-slate-900">{{ $resolvedCount }}</h3>
            <p class="text-xs text-emerald-600 mt-1.5 font-bold">Successfully Closed</p>
        </div>
        <div class="w-14 h-14 bg-emerald-50 text-emerald-600 rounded-2xl flex items-center justify-center shadow-inner group-hover:scale-110 transition-transform">
            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
        </div>
    </a>

    <a href="{{ route('admin.grievances', ['status' => 'urgent']) }}" class="ajax-filter-link group rounded-2xl p-7 shadow-[0_2px_10px_-3px_rgba(6,78,59,0.05)] border transition-all duration-300 flex items-center justify-between focus:outline-none {{ request('status') === 'urgent' ? 'bg-red-50/30 border-red-500 ring-1 ring-red-500' : 'bg-white border-slate-100 hover:border-red-200' }}">
        <div>
            <p class="text-[10px] font-extrabold text-slate-400 uppercase tracking-widest mb-1">Urgent / Emergency</p>
            <h3 class="text-3xl font-black text-slate-900">{{ $urgentCount }}</h3>
            <p class="text-xs text-red-600 mt-1.5 font-bold flex items-center gap-1">
                <span class="w-1.5 h-1.5 rounded-full bg-red-500 animate-pulse"></span> High Priority
            </p>
        </div>
        <div class="w-14 h-14 bg-red-50 text-red-600 rounded-2xl flex items-center justify-center shadow-inner group-hover:scale-110 transition-transform">
            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
        </div>
    </a>
</div>

@if(request()->filled('status'))
    <div class="flex justify-end mb-6">
        <a href="{{ route('admin.grievances') }}" class="ajax-filter-link text-xs font-bold text-slate-500 hover:text-slate-800 transition-colors">Clear Filter &times;</a>
    </div>
@endif

<div class="space-y-6">
    @forelse($grievances as $grievance)
        <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6 flex flex-col md:flex-row justify-between gap-6 hover:border-emerald-200 transition-colors">
            
            <div class="flex-1">
                <div class="flex items-center gap-3 mb-2">
                    <span class="text-[10px] font-extrabold uppercase tracking-widest text-emerald-700 bg-emerald-50 px-2.5 py-1 rounded-md">{{ $grievance->category }}</span>
                    @if($grievance->is_emergency)
                        <span class="text-[10px] font-extrabold uppercase tracking-widest text-red-600 bg-red-50 px-2.5 py-1 rounded-md flex items-center gap-1.5">
                            <span class="w-1.5 h-1.5 rounded-full bg-red-500 animate-pulse"></span> Urgent
                        </span>
                    @endif
                    <span class="text-[10px] font-bold text-slate-400">#{{ str_pad($grievance->id, 4, '0', STR_PAD_LEFT) }}</span>
                </div>
                
                <h3 class="text-lg font-bold text-slate-800 mb-1">{{ $grievance->subject }}</h3>
                <p class="text-sm text-slate-500 line-clamp-2 mb-3">{{ $grievance->description }}</p>
                
                <div class="flex items-center gap-2 text-[11px] font-bold text-slate-400">
                    <span>By {{ $grievance->student->name ?? 'Unknown Student' }}</span>
                    <span class="w-1 h-1 rounded-full bg-slate-300"></span>
                    <span>{{ $grievance->created_at->diffForHumans() }}</span>
                </div>
            </div>
            
            <div class="flex flex-col sm:flex-row md:flex-col justify-between items-start sm:items-center md:items-end gap-4 shrink-0 md:border-l border-slate-100 pt-5 md:pt-0 md:pl-8">
                
                <span class="px-10 py-5 text-[12px] uppercase tracking-widest font-black rounded-2xl border
                    {{ $grievance->status === 'pending' ? 'bg-amber-50 text-amber-700 border-amber-200/60' : '' }}
                    {{ $grievance->status === 'in_progress' ? 'bg-teal-50 text-teal-700 border-teal-200/60' : '' }}
                    {{ $grievance->status === 'resolved' ? 'bg-emerald-50 text-emerald-700 border-emerald-200/60' : '' }}
                    {{ $grievance->status === 'closed' ? 'bg-slate-50 text-slate-600 border-slate-200' : '' }}">
                    {{ str_replace('_', ' ', $grievance->status) }}
                </span>

                <div class="flex items-center gap-3 justify-end w-full">
                    <button onclick="toggleModal('modal-{{ $grievance->id }}', 'open')" class="group/btn text-emerald-700 hover:text-emerald-900 font-extrabold text-sm flex items-center gap-2 transition-all focus:outline-none">
                        <div class="w-8 h-8 bg-emerald-50 rounded-lg flex items-center justify-center group-hover/btn:bg-emerald-100 transition-colors">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                        </div>
                        Review Case
                    </button>
                    
                    <form action="{{ route('admin.grievances.destroy', $grievance->id) }}" method="POST" class="ml-2" onsubmit="return confirm('WARNING: Are you sure you want to permanently delete this grievance? This cannot be undone.');">
                        @csrf @method('DELETE')
                        <button type="submit" class="text-red-500 hover:text-red-700 font-bold text-sm transition-colors">Delete</button>
                    </form>
                </div>
            </div>
        </div>

        <div id="modal-{{ $grievance->id }}" class="hidden fixed inset-0 items-center justify-center p-4 transition-all duration-300 opacity-0" style="z-index: 50; background-color: rgba(15, 23, 42, 0.6); backdrop-filter: blur(4px);">
            <div class="bg-white rounded-3xl shadow-2xl w-full max-w-2xl max-h-[90vh] flex flex-col transform scale-95 transition-transform duration-300 overflow-hidden">
                <div class="bg-slate-50 border-b border-slate-100 px-6 py-4 flex justify-between items-center shrink-0">
                    <div>
                        <h3 class="font-bold text-slate-800">{{ $grievance->subject }}</h3>
                        <p class="text-xs text-slate-500 font-medium">Ticket #{{ str_pad($grievance->id, 4, '0', STR_PAD_LEFT) }}</p>
                    </div>
                    
                    <div class="flex items-center gap-3">
                        @if($grievance->attachment_path)
                            <button onclick="toggleModal('evidence-modal-{{ $grievance->id }}', 'open')" class="flex items-center gap-1.5 px-3 py-1.5 bg-blue-50 border border-blue-200 text-blue-700 hover:bg-blue-100 rounded-lg text-xs font-bold transition-colors">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13"></path></svg>
                                View Evidence
                            </button>
                        @endif
                        <button onclick="toggleModal('modal-{{ $grievance->id }}', 'close')" class="w-8 h-8 rounded-full bg-slate-200 text-slate-500 hover:text-red-500 flex justify-center items-center transition-colors">&times;</button>
                    </div>
                </div>
                
                <div class="flex-grow p-6 overflow-y-auto">
                    <p class="text-sm text-slate-700 leading-relaxed whitespace-pre-wrap mb-6">{{ $grievance->description }}</p>
                    
                    <div class="pt-6 border-t border-slate-100">
                        <h4 class="text-[10px] font-extrabold text-slate-400 uppercase tracking-widest mb-4">Communication Log</h4>
                        <div id="chat-container-{{ $grievance->id }}" class="space-y-4 flex flex-col-reverse no-scrollbar">
                            @forelse($grievance->comments as $comment)
                                <div class="flex justify-start gap-3 mb-4">
                                    <div class="bg-slate-50 border border-slate-200 text-slate-700 p-3.5 rounded-2xl rounded-tl-sm max-w-[85%]">
                                        <p class="text-xs font-extrabold text-slate-800">{{ $comment->user->name }}</p>
                                        <p class="text-sm mt-0.5">{{ $comment->body }}</p>
                                        <span class="text-[10px] font-semibold text-slate-400 mt-1 block">{{ $comment->created_at->diffForHumans() }}</span>
                                    </div>
                                </div>
                            @empty
                                <div class="text-center py-4 text-sm text-slate-400 italic">No communication logged yet.</div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @if($grievance->attachment_path)
            <div id="evidence-modal-{{ $grievance->id }}" class="hidden fixed inset-0 items-center justify-center p-4 transition-all opacity-0" style="z-index: 1050; background-color: rgba(15, 23, 42, 0.85); backdrop-filter: blur(8px);">
                <div class="bg-white rounded-2xl w-full border border-slate-300 flex flex-col transform scale-95 transition-all shadow-2xl" style="max-width: 65rem; height: 85vh;">
                    <div class="bg-slate-50 border-b border-slate-200 px-6 py-4 flex justify-between items-center rounded-t-2xl shrink-0">
                        <h3 class="text-base font-bold text-slate-800">Attached Evidence</h3>
                        <div class="flex items-center gap-3">
                            <a href="{{ route('grievance.attachment', $grievance->id) }}" download class="flex items-center gap-1.5 px-3 py-1.5 text-xs font-bold text-blue-700 bg-blue-50 border border-blue-200 hover:bg-blue-100 transition-colors rounded-lg">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                                Download
                            </a>
                            <button onclick="toggleModal('evidence-modal-{{ $grievance->id }}', 'close')" class="w-8 h-8 rounded-full bg-slate-200 hover:bg-red-50 text-slate-500 hover:text-red-500 transition-colors flex justify-center items-center">&times;</button>
                        </div>
                    </div>
                    <div class="flex-grow p-2 bg-slate-200/50 rounded-b-2xl overflow-hidden">
                        <iframe src="{{ route('grievance.attachment', $grievance->id) }}" class="w-full h-full rounded-xl border border-slate-300 bg-white shadow-inner"></iframe>
                    </div>
                </div>
            </div>
        @endif
    @empty
        <div class="bg-white rounded-3xl border border-slate-100 p-16 text-center shadow-sm">
            <div class="w-16 h-16 bg-slate-50 rounded-full flex items-center justify-center mx-auto mb-4">
                <svg class="w-8 h-8 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
            </div>
            <h3 class="text-lg font-bold text-slate-800">No grievances found</h3>
            <p class="text-slate-500 text-sm mt-1">No records match your selection.</p>
        </div>
    @endforelse
</div>

<div class="mt-6 local-ajax-pagination">
    {{ $grievances->links() }}
</div>