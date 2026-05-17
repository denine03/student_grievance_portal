<div class="bg-white rounded-3xl shadow-sm border border-slate-200 overflow-hidden mb-8">
    <div class="flex border-b border-slate-200 bg-slate-50">
        <a href="{{ route('admin.users', ['tab' => 'students']) }}" 
           class="ajax-tab-link flex-1 text-center py-4 text-sm font-bold transition-colors border-b-2 {{ $tab === 'students' ? 'border-emerald-600 text-emerald-700 bg-white' : 'border-transparent text-slate-500 hover:text-slate-700 hover:bg-slate-100/50' }}">
            Student Directory
        </a>
        <a href="{{ route('admin.users', ['tab' => 'authorities']) }}" 
           class="ajax-tab-link flex-1 text-center py-4 text-sm font-bold transition-colors border-b-2 {{ $tab === 'authorities' ? 'border-emerald-600 text-emerald-700 bg-white' : 'border-transparent text-slate-500 hover:text-slate-700 hover:bg-slate-100/50' }}">
            Authority & Staff Directory
        </a>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-white border-b border-slate-100 text-[10px] uppercase tracking-widest text-slate-400">
                    <th class="px-6 py-4 font-extrabold">User Profile</th>
                    <th class="px-6 py-4 font-extrabold">System Role</th>
                    <th class="px-6 py-4 font-extrabold">Assignment (Dept/School)</th>
                    <th class="px-6 py-4 font-extrabold text-center">Joined Date</th>
                    <th class="px-6 py-4 font-extrabold text-right">Management</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100 text-sm">
                @forelse($users as $user)
                    <tr id="row-{{ $user->id }}" class="hover:bg-slate-50 transition-colors duration-200">
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-full bg-slate-100 flex items-center justify-center font-bold text-slate-500 text-sm">
                                    <span id="initial-{{ $user->id }}">{{ substr($user->name, 0, 1) }}</span>
                                </div>
                                <div>
                                    <p id="name-{{ $user->id }}" class="font-bold text-slate-800">{{ $user->name }}</p>
                                    <p id="email-{{ $user->id }}" class="text-xs text-slate-500">{{ $user->email }}</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <span id="role-{{ $user->id }}" class="px-3 py-1.5 rounded-lg text-[10px] font-extrabold uppercase tracking-widest border 
                                {{ $user->role === 'student' ? 'bg-blue-50 text-blue-700 border-blue-200/60' : 'bg-emerald-50 text-emerald-700 border-emerald-200/60' }}">
                                {{ str_replace('_', ' ', $user->role) }}
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            <p id="dept-{{ $user->id }}" class="text-slate-700 font-bold text-sm">{{ $user->department ?? 'N/A' }}</p>
                            <p id="school-{{ $user->id }}" class="text-xs font-semibold text-slate-400">{{ $user->school ?? 'N/A' }}</p>
                        </td>
                        <td class="px-6 py-4 text-center text-xs font-bold text-slate-500">
                            {{ $user->created_at->format('M d, Y') }}
                        </td>
                        <td class="px-6 py-4 text-right">
                            <button onclick="openEditModal({{ $user->id }}, '{{ addslashes($user->name) }}', '{{ addslashes($user->email) }}', '{{ $user->role }}', '{{ addslashes($user->department ?? '') }}', '{{ addslashes($user->school ?? '') }}')" 
                                    class="px-4 py-2 bg-slate-100 hover:bg-emerald-50 text-slate-600 hover:text-emerald-700 text-xs font-bold rounded-lg border border-slate-200 hover:border-emerald-200 transition-colors focus:outline-none">
                                Edit Profile
                            </button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-6 py-12 text-center text-slate-500">
                            No records found in this directory.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    
    <div class="p-6 bg-slate-50 border-t border-slate-100 local-ajax-pagination">
        {{ $users->appends(['tab' => $tab])->links() }}
    </div>
</div>