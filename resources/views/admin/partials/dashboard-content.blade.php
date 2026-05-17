<div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-6 mb-10">
    <a href="{{ route('admin.dashboard') }}" class="ajax-filter-link group rounded-2xl p-7 shadow-[0_2px_10px_-3px_rgba(6,78,59,0.05)] border transition-all duration-300 flex items-center justify-between focus:outline-none {{ !request('status') ? 'bg-blue-50/30 border-blue-500 ring-1 ring-blue-500' : 'bg-white border-slate-100 hover:border-blue-200' }}">
        <div>
            <p class="text-[10px] font-extrabold text-slate-400 uppercase tracking-widest mb-1">Total Grievances</p>
            <h3 class="text-3xl font-black text-slate-900">{{ $totalGrievances }}</h3>
            <p class="text-xs text-blue-600 mt-1.5 font-bold">System Wide</p>
        </div>
        <div class="w-14 h-14 bg-blue-50 text-blue-600 rounded-2xl flex items-center justify-center shadow-inner group-hover:scale-110 transition-transform">
            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 002-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
        </div>
    </a>

    <a href="{{ route('admin.dashboard', ['status' => 'pending']) }}" class="ajax-filter-link group rounded-2xl p-7 shadow-[0_2px_10px_-3px_rgba(6,78,59,0.05)] border transition-all duration-300 flex items-center justify-between focus:outline-none {{ request('status') === 'pending' ? 'bg-amber-50/30 border-amber-500 ring-1 ring-amber-500' : 'bg-white border-slate-100 hover:border-amber-200' }}">
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

    <a href="{{ route('admin.dashboard', ['status' => 'resolved']) }}" class="ajax-filter-link group rounded-2xl p-7 shadow-[0_2px_10px_-3px_rgba(6,78,59,0.05)] border transition-all duration-300 flex items-center justify-between focus:outline-none {{ request('status') === 'resolved' ? 'bg-emerald-50/30 border-emerald-500 ring-1 ring-emerald-500' : 'bg-white border-slate-100 hover:border-emerald-200' }}">
        <div>
            <p class="text-[10px] font-extrabold text-slate-400 uppercase tracking-widest mb-1">Total Resolved</p>
            <h3 class="text-3xl font-black text-slate-900">{{ $resolvedCount }}</h3>
            <p class="text-xs text-emerald-600 mt-1.5 font-bold">Successfully Closed</p>
        </div>
        <div class="w-14 h-14 bg-emerald-50 text-emerald-600 rounded-2xl flex items-center justify-center shadow-inner group-hover:scale-110 transition-transform">
            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
        </div>
    </a>

    <a href="{{ route('admin.dashboard', ['status' => 'urgent']) }}" class="ajax-filter-link group rounded-2xl p-7 shadow-[0_2px_10px_-3px_rgba(6,78,59,0.05)] border transition-all duration-300 flex items-center justify-between focus:outline-none {{ request('status') === 'urgent' ? 'bg-red-50/30 border-red-500 ring-1 ring-red-500' : 'bg-white border-slate-100 hover:border-red-200' }}">
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

<div class="grid grid-cols-1 xl:grid-cols-3 gap-8">
    
    <div class="xl:col-span-2">
        <div class="flex items-center justify-between mb-6">
            <div class="flex items-center gap-3">
                <div class="w-8 h-8 rounded-lg bg-emerald-100 text-emerald-700 flex items-center justify-center shadow-sm">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
                <h2 class="text-lg font-black text-slate-800 tracking-tight">
                    @if(request('status') === 'pending') Pending Action Required
                    @elseif(request('status') === 'resolved') Resolved Cases
                    @elseif(request('status') === 'urgent') Urgent & Emergencies
                    @else Live Global Activity
                    @endif
                </h2>
            </div>
            @if(request()->filled('status'))
                <a href="{{ route('admin.dashboard') }}" class="ajax-filter-link text-xs font-bold text-slate-500 hover:text-slate-800 transition-colors">Clear Filter &times;</a>
            @endif
        </div>

        <div class="space-y-4">
            @forelse($recentGrievances as $grievance)
                <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-5 flex flex-col md:flex-row justify-between gap-4 hover:border-emerald-200 transition-colors">
                    <div class="flex-1">
                        <div class="flex items-center gap-3 mb-1.5">
                            <span class="text-[10px] font-extrabold uppercase tracking-widest text-emerald-700 bg-emerald-50 px-2.5 py-1 rounded-md">{{ $grievance->category }}</span>
                            @if($grievance->is_emergency)
                                <span class="text-[10px] font-extrabold uppercase tracking-widest text-red-600 bg-red-50 px-2.5 py-1 rounded-md flex items-center gap-1.5">
                                    <span class="w-1.5 h-1.5 rounded-full bg-red-500"></span> Urgent
                                </span>
                            @endif
                        </div>
                        <h4 class="font-bold text-slate-800 text-base mb-1">{{ $grievance->subject }}</h4>
                        <div class="flex items-center gap-2 text-[11px] font-bold text-slate-400">
                            <span>By {{ $grievance->student->name ?? 'Unknown Student' }}</span>
                            <span class="w-1 h-1 rounded-full bg-slate-300"></span>
                            <span>{{ $grievance->created_at->diffForHumans() }}</span>
                        </div>
                    </div>
                    <div class="flex items-center shrink-0">
                        <span class="px-3 py-1.5 text-[10px] uppercase tracking-widest font-bold rounded-lg border
                            {{ $grievance->status === 'pending' ? 'bg-amber-50 text-amber-700 border-amber-200/60' : '' }}
                            {{ $grievance->status === 'in_progress' ? 'bg-teal-50 text-teal-700 border-teal-200/60' : '' }}
                            {{ $grievance->status === 'resolved' ? 'bg-emerald-50 text-emerald-700 border-emerald-200/60' : '' }}
                            {{ $grievance->status === 'closed' ? 'bg-slate-50 text-slate-600 border-slate-200' : '' }}">
                            {{ str_replace('_', ' ', $grievance->status) }}
                        </span>
                    </div>
                </div>
            @empty
                <div class="bg-white rounded-3xl shadow-sm border border-slate-100 p-12 text-center">
                    <div class="w-16 h-16 bg-slate-50 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                    </div>
                    <h3 class="text-base font-bold text-slate-800 mb-1">No active grievances</h3>
                    <p class="text-slate-500 text-xs">The system is entirely clear at the moment.</p>
                </div>
            @endforelse
        </div>
    </div>

    <div class="space-y-6">
        <div class="flex items-center gap-3 mb-6">
            <div class="w-8 h-8 rounded-lg bg-indigo-100 text-indigo-700 flex items-center justify-center shadow-sm">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.488 9H15V3.512A9.025 9.025 0 0120.488 9z"></path></svg>
            </div>
            <h2 class="text-lg font-black text-slate-800 tracking-tight">System Analytics</h2>
        </div>

        <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-5 hover:border-emerald-200 transition-colors">
            <h3 class="text-xs font-semibold text-slate-400 uppercase tracking-widest mb-4">Grievance Distribution</h3>
            <div class="relative h-48 w-full flex items-center justify-center">
                <canvas id="grievanceChart"></canvas>
            </div>
        </div>

        <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-5 hover:border-blue-200 transition-colors">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-xs font-semibold text-slate-400 uppercase tracking-widest">Student Sessions</h3>
                <span class="text-[10px] font-bold bg-slate-100 text-slate-600 px-2 py-1 rounded-md">Total: {{ $chartStudents['total'] }}</span>
            </div>
            <div class="relative h-48 w-full flex items-center justify-center">
                <canvas id="studentChart"></canvas>
            </div>
        </div>

        <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-5 hover:border-amber-200 transition-colors">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-xs font-semibold text-slate-400 uppercase tracking-widest">Authority Sessions</h3>
                <span class="text-[10px] font-bold bg-slate-100 text-slate-600 px-2 py-1 rounded-md">Total: {{ $chartAuthorities['total'] }}</span>
            </div>
            <div class="relative h-48 w-full flex items-center justify-center">
                <canvas id="authChart"></canvas>
            </div>
        </div>
    </div>
</div>

<div id="chart-data-payload" class="hidden" 
     data-g-pending="{{ $chartGrievances['pending'] }}"
     data-g-progress="{{ $chartGrievances['in_progress'] }}"
     data-g-resolved="{{ $chartGrievances['resolved'] }}"
     data-g-closed="{{ $chartGrievances['closed'] }}"
     data-s-online="{{ $chartStudents['online'] }}"
     data-s-offline="{{ $chartStudents['offline'] }}"
     data-a-online="{{ $chartAuthorities['online'] }}"
     data-a-offline="{{ $chartAuthorities['offline'] }}">
</div>