@extends('layouts.admin')

@section('title', 'Invite Staff - Admin Console')
@section('header_title', 'Staff Management')
@section('header_subtitle', 'Securely onboard new university officials and administrators.')

@section('content')
    <div class="max-w-3xl mx-auto">
        <div class="bg-white rounded-3xl shadow-sm border border-slate-200 overflow-hidden">
            
            <div class="p-8 sm:p-10 border-b border-slate-100 bg-slate-50/50">
                <div class="flex items-center gap-5 mb-2">
                    <div class="w-12 h-12 bg-emerald-100 rounded-2xl flex items-center justify-center text-emerald-700 shadow-inner">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path></svg>
                    </div>
                    <div>
                        <h2 class="text-2xl font-black text-slate-800 tracking-tight">Send Staff Invitation</h2>
                        <p class="text-sm text-slate-500 font-medium mt-1">Generate a secure, expiring link to onboard new Deans, HODs, or DSW staff.</p>
                    </div>
                </div>
            </div>

            @if(session('success'))
                <div class="mx-8 sm:mx-10 mt-8 bg-emerald-50/80 backdrop-blur-sm border border-emerald-200 text-emerald-700 px-5 py-4 rounded-2xl flex items-center gap-3 shadow-sm animate-[fadeIn_0.3s_ease-out]">
                    <div class="bg-emerald-100 p-1.5 rounded-full shrink-0">
                        <svg class="w-4 h-4 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                    </div>
                    <span class="font-bold text-sm">{{ session('success') }}</span>
                </div>
            @endif

            <form action="{{ route('admin.send_invite') }}" method="POST" class="p-8 sm:p-10">
                @csrf
                
                <div class="mb-8">
                    <label class="block text-[11px] font-extrabold uppercase tracking-widest text-slate-400 mb-3" for="email">
                        Staff Email Address <span class="text-red-500 ml-1">*</span>
                    </label>
                    <div class="relative group">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-slate-400 group-focus-within:text-emerald-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                        </div>
                        <input type="email" id="email" name="email" value="{{ old('email') }}" 
                            class="block w-full pl-12 pr-5 py-4 bg-slate-50 border border-slate-200 rounded-2xl text-sm font-semibold text-slate-800 placeholder-slate-400 focus:ring-2 focus:ring-emerald-500 focus:bg-white outline-none transition-all shadow-sm @error('email') border-red-400 focus:ring-red-500 @enderror" 
                            placeholder="e.g., dean.engineering@mzu.edu.in" required>
                    </div>
                    
                    @error('email')
                        <div class="flex items-center gap-1.5 mt-2.5 text-red-500">
                            <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            <p class="text-xs font-bold">{{ $message }}</p>
                        </div>
                    @enderror
                    
                    <div class="flex items-start gap-2 mt-4 text-slate-500 bg-slate-50 p-4 rounded-xl border border-slate-100">
                        <svg class="w-4 h-4 shrink-0 mt-0.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        <p class="text-xs leading-relaxed font-medium">The recipient will receive an automated email containing a unique, cryptographically secure registration link. For security purposes, this link will automatically expire exactly <strong>48 hours</strong> after being generated.</p>
                    </div>
                </div>

                <div class="pt-6 border-t border-slate-100 flex justify-end">
                    <button type="submit" class="w-full sm:w-auto bg-emerald-800 hover:bg-emerald-700 text-white px-8 py-4 rounded-2xl font-bold transition-all shadow-md hover:shadow-emerald-900/20 active:scale-95 flex items-center justify-center gap-2 focus:outline-none">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path></svg>
                        Generate & Send Invitation
                    </button>
                </div>
            </form>
            
        </div>
    </div>
@endsection