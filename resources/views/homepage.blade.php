<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Grievance Management System - Mizoram University</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-slate-50 antialiased font-sans text-slate-900 selection:bg-emerald-100 selection:text-emerald-900 flex flex-col min-h-screen">

    <nav class="sticky top-0 z-40 w-full bg-emerald-950 border-b-2 border-emerald-500/30 shadow-[0_10px_30px_-10px_rgba(0,0,0,0.4)]">
        <div class="max-w mx-auto px-6 sm:px-10">
            <div class="flex justify-between items-center h-24"> 
                
                <div class="flex items-center gap-6">
                    <div class="relative group">
                        <div class="absolute -inset-1.5 bg-emerald-400/25 rounded-full blur-md opacity-75 group-hover:opacity-100 transition duration-500"></div>
                        <img src="{{ asset('images/MZU-LOGO-2001-new.png') }}" alt="MZU Logo" 
                             class="relative w-16 h-16 object-contain bg-white rounded-full p-1.5 shadow-xl border-2 border-emerald-400/50 transition-all duration-500">
                    </div>
                    <div class="flex flex-col">
                        <h1 class="text-3xl font-black tracking-tighter text-white leading-none">
                            MIZORAM <span class="text-emerald-400">UNIVERSITY</span>
                        </h1>
                        <div class="flex items-center gap-2 mt-1.5">
                            <span class="h-[1px] w-8 bg-emerald-500/50"></span>
                            <p class="text-[10px] font-black uppercase tracking-[0.3em] text-emerald-500/90">
                                Grievance Management System
                            </p>
                        </div>
                    </div>
                </div>

                <div class="flex items-center gap-4">
                    @if (Route::has('login'))
                        @auth
                            <a href="{{ Auth::user()->role === 'student' ? route('student.dashboard') : route('authority.dashboard') }}" 
                               class="group flex items-center gap-3 bg-emerald-500/10 hover:bg-emerald-500/20 border border-emerald-500/20 px-6 py-2.5 h-[52px] rounded-xl transition-all shadow-lg active:scale-95 focus:outline-none">
                                <span class="text-xs font-black text-emerald-400 uppercase tracking-widest">Dashboard</span>
                                <svg class="w-4 h-4 text-emerald-500 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                            </a>
                        @endauth
                    @endif
                </div>

            </div>
        </div>
    </nav>

    <main class="flex-grow flex flex-col items-center justify-center px-6 py-12">
        
        <div class="max-w-4xl mx-auto text-center mt-8 sm:mt-12 mb-20 animate-[fadeIn_0.5s_ease-out]">
            
            <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-emerald-100 border border-emerald-200 text-emerald-800 text-[10px] font-black uppercase tracking-widest mb-8">
                <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                Official Student Portal Live
            </div>
            
            <h2 class="text-5xl sm:text-6xl md:text-7xl font-black text-slate-900 tracking-tighter leading-[1.1] mb-6">
                Your Voice, <br />
                <span class="text-emerald-700 bg-clip-text text-transparent bg-gradient-to-r from-emerald-700 to-teal-500">Heard and Resolved.</span>
            </h2>
            
            <p class="text-slate-500 text-lg sm:text-xl font-medium leading-relaxed max-w-2xl mx-auto mb-10">
                A secure, transparent, and direct channel to submit academic, administrative, or hostel concerns. Track your grievance progress in real-time.
            </p>
            
            @guest
                <div class="flex flex-col sm:flex-row items-center justify-center gap-4 w-full sm:w-auto px-4">
                    <a href="{{ route('register.form') }}" class="w-full sm:w-auto flex items-center justify-center gap-2 bg-emerald-800 hover:bg-emerald-700 text-white px-8 py-4 h-14 rounded-2xl text-sm font-black transition-all duration-300 shadow-xl shadow-emerald-900/20 active:scale-95">
                        File a New Grievance
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                    </a>
                    <a href="{{ route('login') }}" class="w-full sm:w-auto flex items-center justify-center gap-2 bg-white hover:bg-slate-50 text-slate-700 border-2 border-slate-200 hover:border-slate-300 px-8 py-4 h-14 rounded-2xl text-sm font-black transition-all duration-300 shadow-sm active:scale-95">
                        Track Existing Status
                    </a>
                </div>
            @endguest
        </div>

        <div class="max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-3 gap-6 sm:gap-8 w-full mb-12">
            
            <div class="bg-white p-8 rounded-3xl shadow-[0_2px_15px_-3px_rgba(6,78,59,0.05)] border border-slate-100 hover:border-emerald-200 transition-colors">
                <div class="w-12 h-12 bg-emerald-50 text-emerald-600 rounded-2xl flex items-center justify-center mb-6">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                </div>
                <h3 class="text-lg font-black text-slate-800 mb-2 tracking-tight">Direct Routing</h3>
                <p class="text-sm text-slate-500 leading-relaxed font-medium">Your grievance is automatically routed to the correct authority—whether it's the HOD, Dean, or DSW—ensuring rapid response times.</p>
            </div>

            <div class="bg-white p-8 rounded-3xl shadow-[0_2px_15px_-3px_rgba(6,78,59,0.05)] border border-slate-100 hover:border-emerald-200 transition-colors">
                <div class="w-12 h-12 bg-blue-50 text-blue-600 rounded-2xl flex items-center justify-center mb-6">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
                <h3 class="text-lg font-black text-slate-800 mb-2 tracking-tight">Real-Time Tracking</h3>
                <p class="text-sm text-slate-500 leading-relaxed font-medium">Never wonder about the status of your report. Watch your grievance move through the pipeline with live updates and built-in chat.</p>
            </div>

            <div class="bg-white p-8 rounded-3xl shadow-[0_2px_15px_-3px_rgba(6,78,59,0.05)] border border-slate-100 hover:border-emerald-200 transition-colors">
                <div class="w-12 h-12 bg-amber-50 text-amber-600 rounded-2xl flex items-center justify-center mb-6">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                </div>
                <h3 class="text-lg font-black text-slate-800 mb-2 tracking-tight">Secure & Confidential</h3>
                <p class="text-sm text-slate-500 leading-relaxed font-medium">Upload necessary evidence safely. Strict access controls ensure your sensitive information is only viewed by authorized personnel.</p>
            </div>

        </div>
    </main>

</body>
</html>