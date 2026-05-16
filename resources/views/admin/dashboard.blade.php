@extends('layouts.admin')

@section('title', 'Overview - Admin Console')
@section('header_title', 'System Overview')

@section('content')
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-200 border-l-4 border-l-blue-500 hover:shadow-md transition">
            <p class="text-sm text-gray-500 font-bold uppercase tracking-wider">Total Grievances</p>
            <h3 class="text-3xl font-black text-gray-800 mt-1">{{ $totalGrievances }}</h3>
        </div>
        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-200 border-l-4 border-l-yellow-500 hover:shadow-md transition">
            <p class="text-sm text-gray-500 font-bold uppercase tracking-wider">Pending Review</p>
            <h3 class="text-3xl font-black text-gray-800 mt-1">{{ $pendingCount }}</h3>
        </div>
        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-200 border-l-4 border-l-green-500 hover:shadow-md transition">
            <p class="text-sm text-gray-500 font-bold uppercase tracking-wider">Resolved</p>
            <h3 class="text-3xl font-black text-gray-800 mt-1">{{ $resolvedCount }}</h3>
        </div>
        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-200 border-l-4 border-l-red-500 bg-red-50 hover:shadow-md transition">
            <p class="text-sm text-red-600 font-bold uppercase tracking-wider">Urgent / Emergency</p>
            <h3 class="text-3xl font-black text-red-700 mt-1">{{ $urgentCount }}</h3>
        </div>
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
        <div class="p-6 border-b border-gray-100 flex justify-between items-center bg-gray-50">
            <h2 class="text-lg font-bold text-gray-800">Recent Global Activity</h2>
        </div>
        
        <div class="divide-y divide-gray-100">
            @forelse($recentGrievances as $grievance)
                <div class="p-6 hover:bg-gray-50 transition flex justify-between items-center gap-4">
                    <div>
                        <div class="flex items-center gap-3 mb-1">
                            <span class="text-xs font-bold px-2 py-1 bg-gray-100 text-gray-600 rounded">{{ $grievance->category }}</span>
                            @if($grievance->is_emergency)
                                <span class="text-xs font-bold px-2 py-1 bg-red-100 text-red-600 rounded">Urgent</span>
                            @endif
                        </div>
                        <h4 class="font-bold text-gray-800">{{ $grievance->subject }}</h4>
                        <p class="text-sm text-gray-500 mt-1">Submitted by {{ $grievance->student->name ?? 'Unknown' }} • {{ $grievance->created_at->diffForHumans() }}</p>
                    </div>
                    <div>
                        <span class="px-3 py-1 text-xs font-bold rounded-full border
                            {{ $grievance->status === 'pending' ? 'bg-yellow-50 text-yellow-700 border-yellow-200' : '' }}
                            {{ $grievance->status === 'in_progress' ? 'bg-blue-50 text-blue-700 border-blue-200' : '' }}
                            {{ $grievance->status === 'resolved' ? 'bg-green-50 text-green-700 border-green-200' : '' }}
                            {{ $grievance->status === 'closed' ? 'bg-gray-100 text-gray-600 border-gray-200' : '' }}">
                            {{ ucfirst(str_replace('_', ' ', $grievance->status)) }}
                        </span>
                    </div>
                </div>
            @empty
                <div class="p-16 text-center">
                    <svg class="mx-auto h-12 w-12 text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                    <h3 class="text-lg font-medium text-gray-900">No grievances found</h3>
                    <p class="text-gray-500 mt-1">The system is currently empty. Grievances will appear here once submitted.</p>
                </div>
            @endforelse
        </div>
    </div>
@endsection