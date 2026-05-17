<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Console - MZU')</title>
    <link rel="preload" as="image" href="{{ asset('images/MZU-LOGO-2001-new.png') }}">
    <link rel="icon" type="image/png" href="{{ asset('images/MZU-LOGO-2001-new.png') }}">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-slate-50 antialiased font-sans text-slate-900 selection:bg-emerald-100 selection:text-emerald-900 flex flex-col min-h-screen">

    <nav class="fixed top-0 z-50 w-full bg-emerald-950 border-b-2 border-emerald-500/30 shadow-[0_10px_30px_-10px_rgba(0,0,0,0.4)]">
        <div class="w-full px-6 lg:px-10">
            <div class="flex justify-between items-center h-20 sm:h-24">
                
                <div class="flex items-center gap-4 sm:gap-6">
                    <button id="mobile-menu-btn" class="lg:hidden text-emerald-400 hover:text-white focus:outline-none">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
                    </button>

                    <div class="relative group hidden sm:block">
                        <div class="absolute -inset-1.5 bg-emerald-400/25 rounded-full blur-md opacity-75 group-hover:opacity-100 transition duration-500"></div>
                        <img src="{{ asset('images/MZU-LOGO-2001-new.png') }}" alt="MZU Logo" width="56" height="56"
                             class="relative w-14 h-14 object-contain bg-white rounded-full p-1.5 shadow-xl border-2 border-emerald-400/50 transition-all duration-500">
                    </div>

                    <div class="flex flex-col">
                        <h1 class="text-2xl sm:text-3xl font-black tracking-tighter text-white leading-none">
                            MIZORAM <span class="text-emerald-400">UNIVERSITY</span>
                        </h1>
                        <div class="flex items-center gap-2 mt-1 sm:mt-1.5">
                            <span class="h-[1px] w-6 sm:w-8 bg-emerald-500/50"></span>
                            <p class="text-[9px] sm:text-[10px] font-black uppercase tracking-[0.3em] text-emerald-500/90">
                                Global Admin Console
                            </p>
                        </div>
                    </div>
                </div>

                <div class="flex items-center gap-4">
                    <div class="hidden sm:flex items-center gap-4 bg-white/5 px-4 sm:px-5 py-2.5 h-[48px] sm:h-[52px] rounded-xl border border-white/10 backdrop-blur-md shadow-sm">
                        <div class="flex flex-col items-end">
                            <span class="text-[8px] sm:text-[9px] font-black text-emerald-400 uppercase tracking-widest leading-none mb-1">
                                ADMIN
                            </span>
                            <span class="text-xs sm:text-sm font-bold text-white leading-none tracking-tight">{{ Auth::user()->name }}</span>
                        </div>
                        <div class="w-7 h-7 sm:w-8 sm:h-8 rounded-lg bg-gradient-to-br from-emerald-400 to-emerald-600 text-emerald-950 flex items-center justify-center text-xs sm:text-sm font-black shadow-lg">
                            {{ substr(Auth::user()->name, 0, 1) }}
                        </div>
                    </div>

                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="group flex items-center gap-2 sm:gap-3 bg-red-500/10 hover:bg-red-600 border border-red-500/20 hover:border-red-500 px-3 sm:px-5 py-2.5 h-[48px] sm:h-[52px] rounded-xl transition-all shadow-lg active:scale-95 focus:outline-none">
                            <span class="hidden md:inline text-xs font-black text-white uppercase tracking-widest group-hover:text-white">Logout</span>
                            <div class="w-7 h-7 sm:w-8 sm:h-8 rounded-lg bg-red-500/20 group-hover:bg-white/20 flex items-center justify-center transition-colors">
                                <svg class="w-4 h-4 text-red-500 group-hover:text-white transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                            </div>
                        </button>
                    </form>
                </div>

            </div>
        </div>
    </nav>

    <div class="flex pt-20 sm:pt-24 min-h-screen">
        
        <aside id="admin-sidebar" class="fixed lg:sticky top-20 sm:top-24 left-0 h-[calc(100vh-5rem)] sm:h-[calc(100vh-6rem)] w-72 bg-white border-r border-slate-200 shadow-[4px_0_24px_-10px_rgba(0,0,0,0.05)] z-40 transform -translate-x-full lg:translate-x-0 transition-transform duration-300 ease-in-out overflow-y-auto flex flex-col">
            
            <div class="p-6">
                <div class="space-y-1.5">
                    
                    <a href="{{ route('admin.dashboard') }}" class="group flex items-center gap-3 px-4 py-3.5 rounded-xl transition-all duration-200 font-bold text-sm
                        {{ request()->routeIs('admin.dashboard') 
                            ? 'bg-emerald-50 border border-emerald-100 text-emerald-700 shadow-sm' 
                            : 'text-slate-500 hover:bg-slate-50 hover:text-emerald-700 border border-transparent' }}">
                        <div class="w-8 h-8 rounded-lg flex items-center justify-center transition-colors {{ request()->routeIs('admin.dashboard') ? 'bg-emerald-100 text-emerald-600' : 'bg-slate-100 text-slate-400 group-hover:bg-emerald-50 group-hover:text-emerald-600' }}">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
                        </div>
                        System Overview
                    </a>

                    <a href="{{ route('admin.grievances') }}" class="group flex items-center gap-3 px-4 py-3.5 rounded-xl transition-all duration-200 font-bold text-sm
                        {{ request()->routeIs('admin.grievances') 
                            ? 'bg-emerald-50 border border-emerald-100 text-emerald-700 shadow-sm' 
                            : 'text-slate-500 hover:bg-slate-50 hover:text-emerald-700 border border-transparent' }}">
                        <div class="w-8 h-8 rounded-lg flex items-center justify-center transition-colors {{ request()->routeIs('admin.grievances') ? 'bg-emerald-100 text-emerald-600' : 'bg-slate-100 text-slate-400 group-hover:bg-emerald-50 group-hover:text-emerald-600' }}">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 002-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                        </div>
                        Grievance Directory
                    </a>

                    <a href="{{ route('admin.users') }}" class="group flex items-center gap-3 px-4 py-3.5 rounded-xl transition-all duration-200 font-bold text-sm
                        {{ request()->routeIs('admin.users') 
                            ? 'bg-emerald-50 border border-emerald-100 text-emerald-700 shadow-sm' 
                            : 'text-slate-500 hover:bg-slate-50 hover:text-emerald-700 border border-transparent' }}">
                        <div class="w-8 h-8 rounded-lg flex items-center justify-center transition-colors {{ request()->routeIs('admin.users') ? 'bg-emerald-100 text-emerald-600' : 'bg-slate-100 text-slate-400 group-hover:bg-emerald-50 group-hover:text-emerald-600' }}">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                        </div>
                        Staff & Student Directory
                    </a>

                    <a href="{{ route('admin.invite') }}" class="group flex items-center gap-3 px-4 py-3.5 rounded-xl transition-all duration-200 font-bold text-sm
                        {{ request()->routeIs('admin.invite') 
                            ? 'bg-emerald-50 border border-emerald-100 text-emerald-700 shadow-sm' 
                            : 'text-slate-500 hover:bg-slate-50 hover:text-emerald-700 border border-transparent' }}">
                        <div class="w-8 h-8 rounded-lg flex items-center justify-center transition-colors {{ request()->routeIs('admin.invite') ? 'bg-emerald-100 text-emerald-600' : 'bg-slate-100 text-slate-400 group-hover:bg-emerald-50 group-hover:text-emerald-600' }}">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path></svg>
                        </div>
                        Invite Authorities
                    </a>

                </div>
            </div>
        </aside>

        <div id="sidebar-backdrop" class="fixed inset-0 bg-slate-900/50 backdrop-blur-sm z-30 hidden lg:hidden opacity-0 transition-opacity duration-300"></div>

        <main class="flex-1 w-full p-4 sm:p-8 overflow-x-hidden">
            <div class="max-w-6xl mx-auto">
                <div class="mb-8 flex flex-col md:flex-row md:items-end justify-between gap-4">
                    <div>
                        <h2 class="text-2xl sm:text-3xl font-black text-slate-900 tracking-tight">@yield('header_title')</h2>
                        <p class="text-slate-500 mt-1.5 text-sm font-medium">@yield('header_subtitle', 'Manage university-wide operations.')</p>
                    </div>
                </div>

                @yield('content')
            </div>
        </main>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const btn = document.getElementById('mobile-menu-btn');
            const sidebar = document.getElementById('admin-sidebar');
            const backdrop = document.getElementById('sidebar-backdrop');
            let isOpen = false;

            function toggleSidebar() {
                isOpen = !isOpen;
                if (isOpen) {
                    sidebar.classList.remove('-translate-x-full');
                    backdrop.classList.remove('hidden');
                    // Small delay to allow display:block to apply before animating opacity
                    setTimeout(() => backdrop.classList.replace('opacity-0', 'opacity-100'), 10);
                    document.body.classList.add('overflow-hidden');
                } else {
                    sidebar.classList.add('-translate-x-full');
                    backdrop.classList.replace('opacity-100', 'opacity-0');
                    setTimeout(() => backdrop.classList.add('hidden'), 300);
                    document.body.classList.remove('overflow-hidden');
                }
            }

            btn.addEventListener('click', toggleSidebar);
            backdrop.addEventListener('click', toggleSidebar);
        });
    </script>
</body>
</html>