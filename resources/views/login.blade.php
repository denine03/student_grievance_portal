<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Login - MZU</title>
    <link rel="preload" as="image" href="{{ asset('images/MZU-LOGO-2001-new.png') }}">
    <link rel="icon" type="image/png" href="{{ asset('images/MZU-LOGO-2001-new.png') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-slate-50 antialiased font-sans text-slate-900 selection:bg-emerald-100 selection:text-emerald-900">

    <nav class="sticky top-0 z-40 w-full bg-emerald-950 border-b-2 border-emerald-500/30 shadow-[0_10px_30px_-10px_rgba(0,0,0,0.4)]">
        <div class="max-w mx-auto px-6 sm:px-10">
            <div class="flex justify-between items-center h-24"> 
                <div class="flex items-center gap-6">
                    <div class="relative group">
                        <div class="absolute -inset-1.5 bg-emerald-400/25 rounded-full blur-md opacity-75 group-hover:opacity-100 transition duration-500"></div>
                        <img src="{{ asset('images/MZU-LOGO-2001-new.png') }}" 
                            alt="MZU Logo" 
                            width="64" 
                            height="64" 
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
            </div>
        </div>
    </nav>

    <main class="max-w-xl mx-auto mt-16 p-6 mb-20">
        <div class="text-center mb-10">
            <h2 class="text-4xl font-black text-slate-900 tracking-tight">Welcome Back</h2>
            <p class="text-slate-500 mt-2 text-sm font-medium">Sign in to track status and have live chat.</p>
        </div>

        <div class="bg-white rounded-3xl shadow-[0_2px_15px_-3px_rgba(6,78,59,0.08)] border border-slate-100 p-8 sm:p-10 transition-all">
            
            @if ($errors->has('login_error'))
                <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-2xl mb-6 text-xs font-bold uppercase tracking-wide text-center animate-[fadeIn_0.5s_ease-out]">
                    {{ $errors->first('login_error') }}
                </div>
            @endif

            <form action="{{ route('login.submit') }}" method="POST" class="space-y-6">
                @csrf

                <div class="group">
                    <label class="block text-[12px] font-black uppercase tracking-widest text-slate-400 mb-2 group-focus-within:text-emerald-600 transition-colors" for="email">University Email</label>
                    <input type="email" id="email" name="email" value="{{ old('email') }}" 
                        class="w-full px-5 py-3.5 bg-slate-50 border border-slate-200 rounded-2xl text-sm font-bold focus:ring-4 focus:ring-emerald-500/10 focus:border-emerald-500 focus:bg-white transition-all outline-none @error('email') border-red-500 @enderror" 
                        placeholder="mzu123456789@mzu.edu.in" required autofocus>
                    @error('email') 
                        <span class="text-red-500 text-[10px] font-bold uppercase mt-2 block">{{ $message }}</span> 
                    @enderror
                </div>

                <div class="group">
                    <div class="flex justify-between items-center mb-2">
                        <label class="block text-[12px] font-black uppercase tracking-widest text-slate-400 group-focus-within:text-emerald-600 transition-colors" for="password">Password</label>
                        <a href="{{ route('password.request') }}" class="text-[10px] font-black text-emerald-700 hover:text-emerald-800 uppercase tracking-widest transition-colors">Forgot Password?</a>
                    </div>
                    <input type="password" id="password" name="password" 
                        class="w-full px-5 py-3.5 bg-slate-50 border border-slate-200 rounded-2xl text-sm font-bold focus:ring-4 focus:ring-emerald-500/10 focus:border-emerald-500 focus:bg-white transition-all outline-none @error('password') border-red-500 @enderror" required>
                    @error('password') 
                        <span class="text-red-500 text-[10px] font-bold uppercase mt-2 block">{{ $message }}</span> 
                    @enderror
                </div>

                <div class="flex items-center">
                    <label class="flex items-center cursor-pointer group">
                        <input type="checkbox" name="remember" id="remember" class="hidden peer">
                        <div class="w-5 h-5 border-2 border-slate-200 rounded-md bg-slate-50 peer-checked:bg-emerald-600 peer-checked:border-emerald-600 transition-all flex items-center justify-center mr-3">
                            <svg class="w-3 h-3 text-white opacity-0 peer-checked:opacity-100 transition-opacity" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                        </div>
                        <span class="text-sm font-bold text-slate-600 group-hover:text-slate-900 transition-colors">Remember me</span>
                    </label>
                </div>

                <button type="submit" class="w-full bg-emerald-800 hover:bg-emerald-700 text-white text-base font-black py-4 rounded-2xl transition-all duration-300 shadow-lg shadow-emerald-900/20 active:scale-95 flex items-center justify-center gap-2">
                    Log In
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                </button>
            </form>

            <div class="mt-8 pt-8 border-t border-slate-100 text-center">
                <p class="text-slate-500 text-sm font-bold tracking-tight">
                    New to the portal? 
                    <a href="{{ route('register.form') }}" class="text-emerald-700 hover:text-emerald-800 hover:underline ml-1 transition-all">Create an account</a>
                </p>
            </div>
        </div>
    </main>

</body>
</html>