<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password - MZU</title>
    <link rel="preload" as="image" href="{{ asset('images/MZU-LOGO-2001-new.png') }}">
    <link rel="icon" type="image/png" href="{{ asset('images/MZU-LOGO-2001-new.png') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-slate-50 antialiased font-sans text-slate-900 flex flex-col min-h-screen items-center justify-center p-6">

    <div class="max-w-md w-full animate-[fadeIn_0.5s_ease-out]">
        <div class="text-center mb-10">
            <div class="w-50 h-50 bg-white rounded-full p-2 shadow-xl border-2 border-emerald-400/50 mx-auto mb-6">
                <img src="{{ asset('images/MZU-LOGO-2001-new.png') }}" alt="MZU Logo" class="w-full h-full object-contain">
            </div>
            <h2 class="text-3xl font-black text-slate-900 tracking-tight">Recovery</h2>
            <p class="text-slate-500 mt-2 text-sm font-medium">Enter your university email to receive a reset link.</p>
        </div>

        <div class="bg-white rounded-3xl shadow-[0_2px_15px_-3px_rgba(6,78,59,0.08)] border border-slate-100 p-8">
            
            @if (session('success'))
                <div class="bg-emerald-50 border border-emerald-200 text-emerald-700 px-4 py-3 rounded-2xl mb-6 text-xs font-bold uppercase tracking-wide text-center">
                    {{ session('success') }}
                </div>
            @endif

            <form action="{{ route('password.email') }}" method="POST" class="space-y-6">
                @csrf
                <div class="group">
                    <label class="block text-[12px] font-black uppercase tracking-widest text-slate-400 mb-2 group-focus-within:text-emerald-600 transition-colors" for="email">University Email</label>
                    <input type="email" id="email" name="email" value="{{ old('email') }}" required autofocus
                        class="w-full px-5 py-3.5 bg-slate-50 border border-slate-200 rounded-2xl text-sm font-bold focus:ring-4 focus:ring-emerald-500/10 focus:border-emerald-500 focus:bg-white transition-all outline-none @error('email') border-red-500 @enderror">
                    @error('email') <span class="text-red-500 text-[10px] font-bold uppercase mt-2 block">{{ $message }}</span> @enderror
                </div>

                <button type="submit" class="w-full bg-emerald-800 hover:bg-emerald-700 text-white text-base font-black py-4 rounded-2xl transition-all shadow-lg active:scale-95 flex items-center justify-center gap-2">
                    Send Link
                </button>
            </form>
            
            <div class="mt-6 text-center">
                <a href="{{ route('login') }}" class="text-slate-500 text-sm font-bold tracking-tight hover:text-emerald-700 transition-colors">Return to Login</a>
            </div>
        </div>
    </div>
</body>
</html>