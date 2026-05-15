@extends('layouts.admin')

@section('title', 'User Management - Admin Console')
@section('header_title', 'Staff & Student Directory')

@section('content')
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
                <tbody class="divide-y divide-gray-100">
                    @forelse ($users as $user)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <div class="w-8 h-8 rounded-full bg-indigo-100 text-indigo-700 flex items-center justify-center font-bold text-xs">
                                        {{ substr($user->name, 0, 1) }}
                                    </div>
                                    <div>
                                        <p class="font-bold text-gray-800">{{ $user->name }}</p>
                                        <p class="text-xs text-gray-500">{{ $user->email }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <span class="px-3 py-1 rounded-full text-xs font-bold
                                    {{ $user->role === 'student' ? 'bg-blue-50 text-blue-700 border border-blue-200' : '' }}
                                    {{ $user->role === 'hod' ? 'bg-purple-50 text-purple-700 border border-purple-200' : '' }}
                                    {{ $user->role === 'dean' ? 'bg-amber-50 text-amber-700 border border-amber-200' : '' }}
                                    {{ $user->role === 'dsw_head' ? 'bg-teal-50 text-teal-700 border border-teal-200' : '' }}
                                    {{ $user->role === 'admin' ? 'bg-red-50 text-red-700 border border-red-200' : '' }}">
                                    {{ strtoupper(str_replace('_', ' ', $user->role)) }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                @if($user->department)
                                    <p class="text-sm text-gray-800">{{ $user->department }}</p>
                                @elseif($user->school)
                                    <p class="text-sm text-gray-800">{{ $user->school }}</p>
                                @else
                                    <p class="text-sm text-gray-400 italic">N/A</p>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-center text-sm text-gray-600">
                                {{ $user->created_at->format('M d, Y') }}
                            </td>
                            <td class="px-6 py-4 text-right">
                                <button onclick="openEditModal({{ $user->id }}, '{{ addslashes($user->name) }}', '{{ $user->role }}', '{{ addslashes($user->department) }}', '{{ addslashes($user->school) }}')" class="text-indigo-600 hover:text-indigo-900 font-bold text-sm bg-indigo-50 hover:bg-indigo-100 px-3 py-1.5 rounded transition">
                                    Edit
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-12 text-center text-gray-500">
                                No users found in the database.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <div class="px-6 py-4 border-t border-gray-100 bg-gray-50">
            {{ $users->links() }}
        </div>
    </div>
    <div id="edit-user-modal" class="hidden fixed inset-0 z-50 items-center justify-center bg-slate-900 bg-opacity-60 backdrop-blur-sm p-4 transition-opacity">
        <div class="bg-white rounded-xl shadow-2xl w-full max-w-md overflow-hidden transform transition-transform scale-100">
            
            <div class="bg-slate-50 border-b border-gray-200 px-6 py-4 flex justify-between items-center">
                <h3 class="text-lg font-bold text-gray-800">Edit User Account</h3>
                <button type="button" onclick="closeEditModal()" class="text-gray-400 hover:text-red-500 transition focus:outline-none">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
            </div>
            
            <form id="edit-user-form" method="POST" class="p-6">
                @csrf
                @method('PATCH')
                
                <div class="mb-4">
                    <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-1">User Name</label>
                    <p id="modal-user-name" class="font-bold text-gray-900 text-lg"></p>
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-bold text-gray-700 mb-2">System Role</label>
                    <select id="modal-role" name="role" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 outline-none bg-gray-50">
                        <option value="student">Student</option>
                        <option value="hod">Head of Department (HOD)</option>
                        <option value="dean">Dean</option>
                        <option value="dsw_head">DSW Head</option>
                        <option value="admin">Super Admin</option>
                    </select>
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-bold text-gray-700 mb-2">Department <span class="text-gray-400 font-normal">(Optional)</span></label>
                    <input type="text" id="modal-department" name="department" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 outline-none" placeholder="e.g., Information Technology">
                </div>

                <div class="mb-6">
                    <label class="block text-sm font-bold text-gray-700 mb-2">School <span class="text-gray-400 font-normal">(Optional)</span></label>
                    <input type="text" id="modal-school" name="school" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 outline-none" placeholder="e.g., School of Engineering">
                </div>

                <div class="flex justify-end gap-3 pt-4 border-t border-gray-100">
                    <button type="button" onclick="closeEditModal()" class="px-4 py-2 text-gray-600 font-bold hover:bg-gray-100 rounded-lg transition">Cancel</button>
                    <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-2 rounded-lg font-bold shadow-md transition">Save Changes</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function openEditModal(id, name, role, department, school) {
            // Update the form's action URL to target this specific user
            const form = document.getElementById('edit-user-form');
            form.action = `/admin/users/${id}`;
            
            // Populate the fields with the user's current data
            document.getElementById('modal-user-name').innerText = name;
            document.getElementById('modal-role').value = role;
            document.getElementById('modal-department').value = department || '';
            document.getElementById('modal-school').value = school || '';

            // Show the modal
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