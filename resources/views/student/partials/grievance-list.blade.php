@forelse ($grievances as $grievance)
    <div class="mb-6 group bg-white rounded-2xl shadow-[0_2px_10px_-3px_rgba(6,78,59,0.05)] border border-slate-100 hover:border-emerald-200 transition-all duration-300 overflow-hidden">
        <div class="p-6 sm:p-7">
            <div class="flex flex-col sm:flex-row justify-between items-start gap-4 mb-4">
                <div class="space-y-1">
                    <div class="flex items-center gap-3">
                        <span class="text-[10px] font-extrabold uppercase tracking-widest text-emerald-700/80 bg-emerald-50 px-2.5 py-1 rounded-md">
                            {{ $grievance->category }}
                        </span>
                        @if($grievance->is_emergency)
                            <span class="flex items-center gap-1.5 text-[10px] font-extrabold uppercase tracking-widest text-red-600 bg-red-50 px-2.5 py-1 rounded-md">
                                <span class="w-1.5 h-1.5 rounded-full bg-red-500 animate-pulse"></span>
                                Urgent
                            </span>
                        @endif
                    </div>
                    <h3 class="text-xl font-bold text-slate-800 leading-tight group-hover:text-emerald-700 transition-colors">{{ $grievance->subject }}</h3>
                </div>
                
                <span id="status-badge-{{ $grievance->id }}" class="shrink-0 inline-flex items-center gap-1.5 px-3 py-1 text-xs font-bold rounded-full border transition-colors duration-300
                    {{ $grievance->status === 'pending' ? 'bg-amber-50 text-amber-700 border-amber-200/60' : '' }}
                    {{ $grievance->status === 'in_progress' ? 'bg-teal-50 text-teal-700 border-teal-200/60' : '' }}
                    {{ $grievance->status === 'resolved' ? 'bg-emerald-50 text-emerald-700 border-emerald-200/60' : '' }}
                    {{ $grievance->status === 'closed' ? 'bg-slate-50 text-slate-600 border-slate-200' : '' }}">
                    @if($grievance->status === 'pending')
                        <span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span>
                    @elseif($grievance->status === 'in_progress')
                        <span class="w-1.5 h-1.5 rounded-full bg-teal-500"></span>
                    @endif
                    {{ ucfirst(str_replace('_', ' ', $grievance->status)) }}
                </span>
            </div>
            
            <p class="text-slate-500 text-sm leading-relaxed mb-5 line-clamp-2">{{ $grievance->description }}</p>
            
            <div class="flex items-center justify-between pt-5 border-t border-slate-100">
                <div class="flex items-center gap-2 text-xs font-medium text-slate-400">
                    <span>#{{ str_pad($grievance->id, 4, '0', STR_PAD_LEFT) }}</span>
                    <span class="w-1 h-1 rounded-full bg-slate-300"></span>
                    <span>{{ $grievance->created_at->format('M d, Y') }}</span>
                </div>
                
                <button onclick="toggleDetails('{{ $grievance->id }}')" class="text-sm font-bold text-slate-600 hover:text-emerald-700 flex items-center gap-1 transition-colors focus:outline-none">
                    View Details 
                    <svg id="icon-{{ $grievance->id }}" class="w-4 h-4 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                </button>
            </div>

            <div id="details-{{ $grievance->id }}" class="hidden mt-6 bg-slate-50/50 rounded-xl border border-slate-100 p-5 sm:p-6 transition-all">
                
                @php
                    $statusLevel = 1;
                    if($grievance->status === 'in_progress') $statusLevel = 2;
                    elseif($grievance->status === 'resolved') $statusLevel = 3;
                    elseif($grievance->status === 'closed') $statusLevel = 4;
                    $progressWidth = ($statusLevel - 1) * 33.33;
                @endphp

                <div class="mb-10 pt-2">
                    <h4 class="text-xs font-extrabold text-slate-400 uppercase tracking-wider mb-6 text-center">Live Progress Tracker</h4>
                    
                    <div class="relative max-w-2xl mx-auto">
                        <div class="absolute left-0 top-1/2 transform -translate-y-1/2 w-full h-1 bg-slate-200 rounded-full"></div>
                        
                        <div id="progress-line-{{ $grievance->id }}" class="absolute left-0 top-1/2 transform -translate-y-1/2 h-1 bg-emerald-500 rounded-full transition-all duration-700 ease-out" style="width: {{ $progressWidth }}%"></div>

                        <div class="relative flex justify-between items-center w-full">
                            
                            <div class="flex flex-col items-center relative">
                                <div id="step-1-{{ $grievance->id }}" class="w-8 h-8 rounded-full flex items-center justify-center shadow-md z-10 transition-colors duration-500 {{ $statusLevel >= 1 ? 'bg-emerald-600 text-white ring-4 ring-emerald-50' : 'bg-white border-2 border-slate-200 text-slate-300' }}">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                </div>
                                <span id="step-text-1-{{ $grievance->id }}" class="absolute top-10 mt-1 text-[11px] uppercase tracking-wide whitespace-nowrap {{ $statusLevel >= 1 ? 'font-bold text-emerald-800' : 'font-semibold text-slate-400' }}">Submitted</span>
                            </div>

                            <div class="flex flex-col items-center relative">
                                <div id="step-2-{{ $grievance->id }}" class="w-8 h-8 rounded-full flex items-center justify-center shadow-md z-10 transition-colors duration-500 {{ $statusLevel >= 2 ? 'bg-emerald-600 text-white ring-4 ring-emerald-50' : 'bg-white border-2 border-slate-200 text-slate-300' }}">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                                </div>
                                <span id="step-text-2-{{ $grievance->id }}" class="absolute top-10 mt-1 text-[11px] uppercase tracking-wide whitespace-nowrap {{ $statusLevel >= 2 ? 'font-bold text-emerald-800' : 'font-semibold text-slate-400' }}">Reviewing</span>
                            </div>

                            <div class="flex flex-col items-center relative">
                                <div id="step-3-{{ $grievance->id }}" class="w-8 h-8 rounded-full flex items-center justify-center shadow-md z-10 transition-colors duration-500 {{ $statusLevel >= 3 ? 'bg-emerald-600 text-white ring-4 ring-emerald-50' : 'bg-white border-2 border-slate-200 text-slate-300' }}">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                </div>
                                <span id="step-text-3-{{ $grievance->id }}" class="absolute top-10 mt-1 text-[11px] uppercase tracking-wide whitespace-nowrap {{ $statusLevel >= 3 ? 'font-bold text-emerald-800' : 'font-semibold text-slate-400' }}">Resolved</span>
                            </div>

                            <div class="flex flex-col items-center relative">
                                <div id="step-4-{{ $grievance->id }}" class="w-8 h-8 rounded-full flex items-center justify-center shadow-md z-10 transition-colors duration-500 {{ $statusLevel >= 4 ? 'bg-emerald-600 text-white ring-4 ring-emerald-50' : 'bg-white border-2 border-slate-200 text-slate-300' }}">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"></path></svg>
                                </div>
                                <span id="step-text-4-{{ $grievance->id }}" class="absolute top-10 mt-1 text-[11px] uppercase tracking-wide whitespace-nowrap {{ $statusLevel >= 4 ? 'font-bold text-emerald-800' : 'font-semibold text-slate-400' }}">Closed</span>
                            </div>
                            
                        </div>
                    </div>
                </div>
                <div class="border-t border-slate-200/60 pt-6">
                    <h4 class="text-xs font-extrabold text-slate-400 uppercase tracking-wider mb-3">Complete Report</h4>
                    <p class="text-slate-700 text-sm leading-relaxed whitespace-pre-wrap">{{ $grievance->description }}</p>
                    
                    @if($grievance->attachment_path)
                        <div class="mt-6 pt-5 border-t border-slate-200/60">
                            <button onclick="openEvidenceModal('{{ route('grievance.attachment', $grievance->id) }}')" class="group inline-flex items-center gap-2.5 bg-white border border-slate-200 px-4 py-2.5 rounded-lg text-sm font-bold text-slate-700 hover:text-emerald-700 hover:border-emerald-300 hover:shadow-sm hover:bg-emerald-50/50 transition-all focus:outline-none">
                                <svg class="w-5 h-5 text-slate-400 group-hover:text-emerald-600 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13"></path></svg>
                                View Attached Evidence
                            </button>
                        </div>
                    @endif
                </div>
                <div class="mt-8 border-t border-slate-200/60 pt-6">
                    <h4 class="text-xs font-extrabold text-slate-400 uppercase tracking-wider mb-5">Case Communication</h4>
                    
                    <div id="chat-container-{{ $grievance->id }}" class="space-y-4 max-h-72 overflow-y-auto pr-2 mb-5 flex flex-col-reverse no-scrollbar">
                        @forelse($grievance->comments as $comment)
                            @if($comment->user_id === Auth::id())
                                <div class="flex justify-end mb-4">
                                    <div class="bg-emerald-600 text-white p-3.5 rounded-2xl rounded-tr-sm max-w-[85%] shadow-sm">
                                        <p class="text-sm leading-relaxed">{{ $comment->body }}</p>
                                        <span class="text-[10px] text-emerald-200 mt-1.5 block text-right font-medium">
                                            {{ $comment->created_at->diffForHumans() }}
                                        </span>
                                    </div>
                                </div>
                            @else
                                <div class="flex justify-start gap-3 mb-4">
                                    <div class="w-8 h-8 rounded-full bg-slate-200 flex-shrink-0 flex items-center justify-center font-bold text-slate-500 text-xs shadow-inner">
                                        {{ substr($comment->user->name, 0, 1) }}
                                    </div>
                                    <div class="bg-white border border-slate-200/60 text-slate-700 p-3.5 rounded-2xl rounded-tl-sm max-w-[85%] shadow-sm">
                                        <p class="text-xs font-extrabold text-slate-800 mb-1">
                                            {{ $comment->user->name }} <span class="text-slate-400 font-medium">({{ strtoupper(str_replace('_', ' ', $comment->user->role)) }})</span>
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
                                <p class="text-sm text-slate-400 italic">No messages yet. Send a message to the reviewing authority.</p>
                            </div>
                        @endforelse
                    </div>

                    <div id="typing-indicator-{{ $grievance->id }}" class="text-[10px] font-extrabold text-emerald-500 uppercase tracking-widest mb-2 h-4 transition-opacity duration-300 opacity-0">
                    </div>

                    <form action="{{ route('grievance.comment', $grievance->id) }}" method="POST" class="chat-ajax-form relative flex items-end gap-2" data-grievance-id="{{ $grievance->id }}">
                        @csrf
                        <div class="relative w-full">
                            <textarea name="body" rows="2" placeholder="Type a message..." required class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 outline-none resize-none shadow-sm transition-all"></textarea>
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
@empty
    <div class="bg-white rounded-3xl shadow-sm border border-slate-100 p-16 flex flex-col items-center justify-center text-center">
        <div class="w-20 h-20 bg-emerald-50 rounded-full flex items-center justify-center mb-6">
            <svg class="w-10 h-10 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
        </div>
        <h3 class="text-xl font-bold text-slate-800 mb-2">No grievances found</h3>
        <p class="text-slate-500 text-sm mb-8 max-w-sm">You haven't submitted any tickets yet. When you do, you can track their real-time progress right here.</p>
        <a href="{{ route('grievance.create') }}" class="bg-emerald-800 hover:bg-emerald-700 text-white px-6 py-2.5 rounded-xl font-bold text-sm transition-colors shadow-sm">
            File a New Grievance
        </a>
    </div>
@endforelse