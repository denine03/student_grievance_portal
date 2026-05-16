@extends('layouts.admin')

@section('title', 'User Management - Admin Console')
@section('header_title', 'Staff & Student Directory')

@section('content')
    @if(session('success'))
        <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg mb-6 shadow-sm">
            <span class="font-bold">{{ session('success') }}</span>
        </div>
    @endif

    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
        <div class="p-6 border-b border-gray-100 flex flex-col sm:flex-row justify-between items-center gap-4 bg-gray-50">
            <div>
                <h2 class="text-xl font-bold text-gray-800">{{ $pageTitle }}</h2>
                <p class="text-sm text-gray-500 mt-1">Manage all students, Deans, HODs, and DSW staff.</p>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-white border-b border-gray-200 text-xs uppercase tracking-wider text-gray-500">
                        <th class="px-6 py-4 font-bold">User</th>
                        <th class="px-6 py-4 font-bold">Role</th>
                        <th class="px-6 py-4 font-bold">Department / School</th>
                        <th class="px-6 py-4 font-bold text-center">Joined</th>
                        <th class="px-6 py-4 font-bold text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 text-sm">
                    @foreach($users as $user)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-6 py-4">
                                <p class="font-bold text-gray-800">{{ $user->name }}</p>
                                <p class="text-xs text-gray-500">{{ $user->email }}</p>
                            </td>
                            <td class="px-6 py-4">
                                <span class="px-2.5 py-1 rounded-md text-xs font-bold border 
                                    {{ $user->role === 'student' ? 'bg-blue-50 text-blue-700 border-blue-200' : 'bg-indigo-50 text-indigo-700 border-indigo-200' }}">
                                    {{ strtoupper(str_replace('_', ' ', $user->role)) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-gray-600 font-medium">
                                {{ $user->department ?? $user->school ?? 'N/A' }}
                            </td>
                            <td class="px-6 py-4 text-center text-gray-500">
                                {{ $user->created_at->format('M d, Y') }}
                            </td>
                            <td class="px-6 py-4 text-right">
                                <button onclick="openEditModal({{ $user->id }}, '{{ addslashes($user->name) }}', '{{ $user->role }}', '{{ addslashes($user->department ?? '') }}', '{{ addslashes($user->school ?? '') }}')" 
                                        class="text-indigo-600 hover:text-indigo-900 font-bold focus:outline-none">
                                    Edit Access
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="p-4 border-t border-gray-100">
            {{ $users->links() }}
        </div>
    </div>

    <div id="edit-user-modal" class="hidden fixed inset-0 z-50 items-center justify-center bg-gray-900/50 backdrop-blur-sm p-4">
        <div class="bg-white rounded-xl shadow-xl w-full max-w-md overflow-hidden">
            <div class="p-6 border-b border-gray-100 flex justify-between items-center bg-gray-50">
                <h3 class="font-bold text-gray-800 text-lg">Edit User Access</h3>
                <button onclick="closeEditModal()" class="text-gray-400 hover:text-gray-600">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
            </div>
            
            <form id="edit-user-form" method="POST" class="p-6">
                @csrf
                @method('PATCH')
                
                <p class="text-sm text-gray-600 mb-6">Updating role for: <strong id="modal-user-name" class="text-gray-900"></strong></p>

                <div class="mb-4">
                    <label class="block text-sm font-bold text-gray-700 mb-2">Role</label>
                    <select id="modal-role" name="role" class="w-full px-4 py-2.5 bg-gray-50 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 outline-none">
                        <option value="student">Student</option>
                        <option value="hod">HOD</option>
                        <option value="dean">Dean</option>
                        <option value="dsw_head">DSW Head</option>
                        <option value="admin">Admin</option>
                    </select>
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-bold text-gray-700 mb-2">Department (If Applicable)</label>
                    <input type="text" id="modal-department" name="department" class="w-full px-4 py-2.5 bg-gray-50 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 outline-none" placeholder="e.g. Computer Engineering">
                </div>

                <div class="mb-6">
                    <label class="block text-sm font-bold text-gray-700 mb-2">School (If Applicable)</label>
                    <input type="text" id="modal-school" name="school" class="w-full px-4 py-2.5 bg-gray-50 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 outline-none" placeholder="e.g. Engineering & Technology">
                </div>

                <div class="flex justify-end gap-3">
                    <button type="button" onclick="closeEditModal()" class="px-5 py-2.5 text-sm font-bold text-gray-600 hover:bg-gray-100 rounded-lg transition">Cancel</button>
                    <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white px-5 py-2.5 rounded-lg text-sm font-bold shadow-md transition">Save Changes</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function openEditModal(id, name, role, department, school) {
            const form = document.getElementById('edit-user-form');
            form.action = `/admin/users/${id}`;
            
            document.getElementById('modal-user-name').innerText = name;
            document.getElementById('modal-role').value = role;
            document.getElementById('modal-department').value = (department && department !== 'null') ? department : '';
            document.getElementById('modal-school').value = (school && school !== 'null') ? school : '';

            const modal = document.getElementById('edit-user-modal');
            modal.classList.remove('hidden');
            modal.classList.add('flex');
            document.body.classList.add('overflow-hidden');
        }

        function closeEditModal() {
            const modal = document.getElementById('edit-user-modal');
            modal.classList.add('hidden');
            modal.classList.remove('flex');
            document.body.classList.remove('overflow-hidden');
        }
    </script>
@endsection