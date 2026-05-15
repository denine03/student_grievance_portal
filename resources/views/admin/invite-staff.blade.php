@extends('layouts.admin')

@section('title', 'Invite Staff - Admin Console')
@section('header_title', 'Staff Management')

@section('content')
    <div class="max-w-2xl bg-white p-8 rounded-xl shadow-sm border border-gray-200">
        <div class="mb-8 border-b border-gray-100 pb-4">
            <h2 class="text-2xl font-extrabold text-gray-800">Send Staff Invitation</h2>
            <p class="text-gray-500 mt-1">Generate a secure, expiring link to onboard new Deans, HODs, or DSW staff.</p>
        </div>

        @if(session('success'))
            <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg mb-6 flex items-center gap-3 shadow-sm">
                <svg class="w-5 h-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                <span class="font-medium">{{ session('success') }}</span>
            </div>
        @endif

        <form action="{{ route('admin.send_invite') }}" method="POST">
            @csrf
            <div class="mb-6">
                <label class="block text-sm font-bold text-gray-700 mb-2" for="email">Staff Email Address <span class="text-red-500">*</span></label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" class="w-full px-4 py-3 bg-gray-50 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition" placeholder="e.g., dean.engineering@mzu.edu.in" required>
                @error('email')
                    <p class="text-red-500 text-xs mt-2 font-semibold">{{ $message }}</p>
                @enderror
                <p class="text-xs text-gray-400 mt-2">This email will receive a unique registration link valid for 48 hours.</p>
            </div>

            <button type="submit" class="w-full sm:w-auto bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-3 rounded-lg font-bold transition shadow-md flex items-center justify-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path></svg>
                Send Invitation Email
            </button>
        </form>
    </div>
@endsection