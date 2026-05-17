@extends('layouts.admin')

@section('title', 'User Management - Admin Console')
@section('header_title', 'Staff & Student Directory')
@section('header_subtitle', 'Manage access and details for all university members.')

@section('content')
    <div id="toast-container" class="fixed top-5 right-5 z-[100] flex flex-col gap-3 pointer-events-none"></div>

    <div id="users-ajax-container" class="transition-all duration-300">
        @include('admin.partials.users-table')
    </div>

    <div id="edit-user-modal" class="hidden fixed inset-0 z-[100] items-center justify-center p-4 sm:p-6 transition-all duration-300 opacity-0" style="background-color: rgba(15, 23, 42, 0.6); backdrop-filter: blur(4px);">
        <div class="bg-white rounded-3xl shadow-2xl w-full max-w-2xl overflow-hidden flex flex-col max-h-[90vh] transform scale-95 transition-transform duration-300 border border-slate-200/60">
            
            <div class="px-8 py-6 border-b border-slate-100 flex justify-between items-center bg-slate-50 shrink-0">
                <div>
                    <h3 class="font-bold text-slate-800 text-xl tracking-tight">Edit Profile & Access</h3>
                    <p class="text-sm text-slate-500 font-medium mt-1">Updating records for User ID <span id="display-user-id" class="font-bold text-slate-700"></span></p>
                </div>
                <button onclick="closeEditModal()" class="w-10 h-10 rounded-full bg-slate-200 text-slate-500 hover:text-red-500 flex justify-center items-center transition-colors focus:outline-none">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
            </div>
            
            <form id="edit-user-form" class="px-8 py-6 overflow-y-auto no-scrollbar">
                @csrf
                @method('PATCH')
                
                <div class="space-y-6">
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-[11px] font-extrabold uppercase tracking-widest text-slate-400 mb-2">Full Name</label>
                            <input type="text" id="modal-name" name="name" required class="w-full px-5 py-3.5 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-emerald-500 text-sm font-semibold outline-none transition-all">
                        </div>
                        <div>
                            <label class="block text-[11px] font-extrabold uppercase tracking-widest text-slate-400 mb-2">Email Address</label>
                            <input type="email" id="modal-email" name="email" required class="w-full px-5 py-3.5 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-emerald-500 text-sm font-semibold outline-none transition-all">
                        </div>
                    </div>

                    <div class="pt-4 border-t border-slate-100">
                        <label class="block text-[11px] font-extrabold uppercase tracking-widest text-slate-400 mb-2">System Role</label>
                        <select id="modal-role" name="role" required class="w-full px-5 py-3.5 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-emerald-500 text-sm font-semibold outline-none transition-all cursor-pointer">
                            <option value="student">Student</option>
                            <option value="hod">Head of Department (HOD)</option>
                            <option value="dean">Dean</option>
                            <option value="dsw_head">DSW Head</option>
                            <option value="admin">System Admin</option>
                        </select>
                    </div>

                    <div class="grid grid-cols-1 gap-6 pt-4 border-t border-slate-100">
                        <div>
                            <label class="block text-[11px] font-extrabold uppercase tracking-widest text-slate-400 mb-2">School <span class="normal-case tracking-normal font-medium text-slate-400">(Optional)</span></label>
                            <select id="modal-school" name="school" class="w-full px-5 py-3.5 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-emerald-500 text-sm font-semibold outline-none transition-all cursor-pointer">
                                <option value="">-- None / N/A --</option>
                                <option value="Earth Sciences & Natural Resources Management">School of Earth Sciences & Natural Resources Management</option>
                                <option value="Economics, Management & Information Sciences">School of Economics, Management & SEMIS</option>
                                <option value="Humanities and Languages">School of Humanities and Languages</option>
                                <option value="Engineering & Technology">School of Engineering & Technology</option>
                                <option value="Life Sciences">School of Life Sciences</option>
                                <option value="Physical Sciences">School of Physical Sciences</option>
                                <option value="Social Sciences">School of Social Sciences</option>
                                <option value="Fine Arts, Architecture & Fashion Technology">School of Fine Arts & Architecture</option>
                                <option value="Medical & Paramedical Sciences">School of Medical & Paramedical Sciences</option>
                                <option value="Education">School of Education</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-[11px] font-extrabold uppercase tracking-widest text-slate-400 mb-2">Department <span class="normal-case tracking-normal font-medium text-slate-400">(Optional)</span></label>
                            <select id="modal-department" name="department" class="w-full px-5 py-3.5 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-emerald-500 text-sm font-semibold outline-none transition-all cursor-pointer">
                                <option value="">-- Select School First --</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="flex justify-end gap-4 mt-8 pt-6 border-t border-slate-100">
                    <button type="button" onclick="closeEditModal()" class="px-6 py-3.5 text-sm font-bold text-slate-500 hover:text-slate-800 hover:bg-slate-100 rounded-xl transition-colors">Cancel</button>
                    <button type="submit" id="save-btn" class="bg-emerald-800 hover:bg-emerald-700 text-white px-8 py-3.5 rounded-xl text-sm font-bold shadow-sm transition-all flex items-center gap-2">
                        Save Changes
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        const schoolStructure = {
            'Earth Sciences & Natural Resources Management': ['Environmental Sciences', 'Extension Education & Rural Development', 'Forestry', 'Geography & Resource Management', 'Geology', 'Horticulture, Aromatic & Medicinal Plants (HAMP)', 'Petroleum Exploration', 'Centre for Disaster Management', 'Biodiversity Research Centre'],
            'Economics, Management & Information Sciences': ['Commerce', 'Economics', 'Library & Information Sciences', 'Management', 'Mass Communication', 'Tourism & Hospitality Management'],
            'Humanities and Languages': ['English and Culture Studies', 'Hindi', 'Mizo'],
            'Engineering & Technology': ['Computer Engineering', 'Electrical Engineering', 'Electronic & Communication Engineering', 'Information Technology', 'Civil Engineering', 'Food Technology'],
            'Life Sciences': ['Biotechnology', 'Botany', 'Zoology'],
            'Physical Sciences': ['Physics', 'Mathematics & Computer Science', 'Chemistry', 'Industrial Chemistry'],
            'Social Sciences': ['History & Ethnography', 'Political Science', 'Psychology', 'Public Administration', 'Social Work', 'Sociology'],
            'Fine Arts, Architecture & Fashion Technology': ['Planning & Architecture'],
            'Medical & Paramedical Sciences': ['Clinical Psychology'],
            'Education': ['Education']
        };

        function populateModalDepartments(selectedSchool, selectedDeptToKeep = '') {
            const departmentSelect = document.getElementById('modal-department');
            departmentSelect.innerHTML = '<option value="">-- None / N/A --</option>';
            
            if (schoolStructure[selectedSchool]) {
                schoolStructure[selectedSchool].forEach(function(dept) {
                    const option = document.createElement('option');
                    option.value = dept;
                    option.textContent = dept;
                    if (dept === selectedDeptToKeep) option.selected = true;
                    departmentSelect.appendChild(option);
                });
            }

            if (selectedDeptToKeep && !Array.from(departmentSelect.options).some(opt => opt.value === selectedDeptToKeep)) {
                departmentSelect.add(new Option(`${selectedDeptToKeep} (Legacy)`, selectedDeptToKeep, true, true));
            }
        }

        document.getElementById('modal-school').addEventListener('change', function() {
            populateModalDepartments(this.value);
        });

        function openEditModal(id, name, email, role, department, school) {
            const form = document.getElementById('edit-user-form');
            form.action = `/admin/users/${id}`;
            form.dataset.userId = id;
            
            document.getElementById('display-user-id').innerText = `#${id.toString().padStart(4, '0')}`;
            document.getElementById('modal-name').value = name;
            document.getElementById('modal-email').value = email;
            document.getElementById('modal-role').value = role;

            const schoolSelect = document.getElementById('modal-school');
            let schoolVal = (school && school !== 'null') ? school : '';
            if (schoolVal && !Array.from(schoolSelect.options).some(opt => opt.value === schoolVal)) {
                schoolSelect.add(new Option(`${schoolVal} (Legacy)`, schoolVal));
            }
            schoolSelect.value = schoolVal;

            let deptVal = (department && department !== 'null') ? department : '';
            populateModalDepartments(schoolVal, deptVal);

            const modal = document.getElementById('edit-user-modal');
            const content = modal.firstElementChild;
            modal.classList.remove('hidden');
            modal.classList.add('flex');
            requestAnimationFrame(() => {
                modal.classList.replace('opacity-0', 'opacity-100');
                content.classList.replace('scale-95', 'scale-100');
            });
            document.body.classList.add('overflow-hidden');
        }

        function closeEditModal() {
            const modal = document.getElementById('edit-user-modal');
            const content = modal.firstElementChild;
            modal.classList.replace('opacity-100', 'opacity-0');
            content.classList.replace('scale-100', 'scale-95');
            setTimeout(() => {
                modal.classList.remove('flex');
                modal.classList.add('hidden');
                document.body.classList.remove('overflow-hidden');
            }, 300);
        }

        function showToast(message) {
            const container = document.getElementById('toast-container');
            const toast = document.createElement('div');
            toast.className = 'pointer-events-auto bg-white/95 backdrop-blur-md border-l-4 border-emerald-500 shadow-xl rounded-r-xl p-4 w-80 transform transition-all duration-300 translate-x-full opacity-0 flex items-start gap-3';
            toast.innerHTML = `
                <div class="text-emerald-500 mt-0.5 shrink-0"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg></div>
                <div class="flex-1">
                    <h4 class="text-sm font-bold text-slate-800">Update Successful</h4>
                    <p class="text-xs text-slate-500 mt-1 leading-relaxed">${message}</p>
                </div>
            `;
            container.appendChild(toast);
            requestAnimationFrame(() => setTimeout(() => toast.classList.remove('translate-x-full', 'opacity-0'), 10));
            setTimeout(() => {
                toast.classList.add('translate-x-full', 'opacity-0');
                setTimeout(() => toast.remove(), 300);
            }, 4000);
        }

        document.getElementById('edit-user-form').addEventListener('submit', async function(e) {
            e.preventDefault();
            const btn = document.getElementById('save-btn');
            const originalText = btn.innerHTML;
            btn.innerHTML = 'Saving...';
            btn.disabled = true;

            try {
                const formData = new FormData(this);

                const response = await fetch(this.action, {
                    method: 'POST', 
                    headers: {
                        'Accept': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest',
                        'X-CSRF-TOKEN': formData.get('_token')
                    },
                    body: formData
                });

                if (response.ok) {
                    const data = await response.json();
                    const user = data.user;
                    
                    document.getElementById(`name-${user.id}`).innerText = user.name;
                    document.getElementById(`email-${user.id}`).innerText = user.email;
                    document.getElementById(`initial-${user.id}`).innerText = user.name.substring(0, 1);
                    document.getElementById(`dept-${user.id}`).innerText = user.department || 'N/A';
                    document.getElementById(`school-${user.id}`).innerText = user.school || 'N/A';
                    
                    const roleBadge = document.getElementById(`role-${user.id}`);
                    roleBadge.innerText = user.role.replace('_', ' ');
                    if (user.role === 'student') {
                        roleBadge.className = 'px-3 py-1.5 rounded-lg text-[10px] font-extrabold uppercase tracking-widest border bg-blue-50 text-blue-700 border-blue-200/60';
                    } else {
                        roleBadge.className = 'px-3 py-1.5 rounded-lg text-[10px] font-extrabold uppercase tracking-widest border bg-emerald-50 text-emerald-700 border-emerald-200/60';
                    }

                    const editBtn = document.querySelector(`#row-${user.id} button`);
                    editBtn.setAttribute('onclick', `openEditModal(${user.id}, '${user.name.replace(/'/g, "\\'")}', '${user.email.replace(/'/g, "\\'")}', '${user.role}', '${(user.department || '').replace(/'/g, "\\'")}', '${(user.school || '').replace(/'/g, "\\'")}')`);

                    closeEditModal();
                    showToast(data.message);
                } else {
                    const errorData = await response.json();
                    alert('Error: ' + (errorData.message || 'Validation failed. Check your inputs.'));
                }
            } catch (error) {
                console.error('Update Error:', error);
                alert('An error occurred while communicating with the server.');
            } finally {
                btn.innerHTML = originalText;
                btn.disabled = false;
            }
        });

        document.addEventListener('DOMContentLoaded', function() {
            const ajaxContainer = document.getElementById('users-ajax-container');

            document.addEventListener('click', async function(e) {
                const targetEl = e.target.closest('.ajax-tab-link') || e.target.closest('.local-ajax-pagination a');
                if (!targetEl) return;

                e.preventDefault(); 
                const url = targetEl.href;
                ajaxContainer.style.opacity = '0.5';

                try {
                    const response = await fetch(url, { headers: { 'X-Requested-With': 'XMLHttpRequest' } });
                    if (response.ok) {
                        ajaxContainer.innerHTML = await response.text();
                        history.pushState(null, '', url);
                    }
                } catch (error) {
                    console.error('AJAX Error:', error);
                } finally {
                    ajaxContainer.style.opacity = '1';
                }
            });
        });
    </script>
@endsection