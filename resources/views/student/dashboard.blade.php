<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Dashboard - MZU</title>
    <link rel="preload" as="image" href="{{ asset('images/MZU-LOGO-2001-new.png') }}">
    <link rel="icon" type="image/png" href="{{ asset('images/MZU-LOGO-2001-new.png') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js']) 
</head>
<body class="bg-slate-50 antialiased font-sans text-slate-900 selection:bg-emerald-100 selection:text-emerald-900">

    <nav class="sticky top-0 z-40 w-full bg-emerald-950 border-b-2 border-emerald-500/30 shadow-[0_10px_30px_-10px_rgba(0,0,0,0.4)]">
        <div class="max-w mx-auto px-6 sm:px-10">
            <div class="flex justify-between items-center h-24"> 
                
                <div class="flex items-center gap-6 mr-10">
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

                <div class="flex items-center gap-4">
                    
                    <div class="hidden lg:flex items-center gap-4 bg-white/5 px-5 py-2.5 h-[52px] rounded-xl border border-white/10 backdrop-blur-md shadow-sm">
                        <div class="flex flex-col items-end">
                            <span class="text-3x1 font-bold text-white leading-none tracking-tight">{{ Auth::user()->name }}</span>
                        </div>
                        <div class="w-8 h-8 rounded-lg bg-gradient-to-br from-emerald-400 to-emerald-600 text-emerald-950 flex items-center justify-center text-sm font-black shadow-lg">
                            {{ substr(Auth::user()->name, 0, 1) }}
                        </div>
                    </div>

                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="group flex items-center gap-3 bg-red-500/10 hover:bg-red-600 border border-red-500/20 hover:border-red-500 px-5 py-2.5 h-[52px] rounded-xl transition-all shadow-lg active:scale-95 focus:outline-none">
                            <span class="text-xs font-black text-white capitalize tracking-widest group-hover:text-white">Logout</span>
                            <div class="w-8 h-8 rounded-lg bg-red-500/20 group-hover:bg-white/20 flex items-center justify-center transition-colors">
                                <svg class="w-4 h-4 text-red-500 group-hover:text-white transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                                </svg>
                            </div>
                        </button>
                    </form>
                </div>

            </div>
        </div>
    </nav>

    <main class="max-w-4xl mx-auto mt-10 p-6">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-10 gap-4">
            <div>
                <h2 class="text-3xl font-black text-slate-900 tracking-tight">My Grievances</h2>
                <p class="text-slate-500 mt-1.5 text-sm">Track the real-time status of your submitted issues.</p>
            </div>
            <a href="{{ route('grievance.create') }}" class="group relative inline-flex items-center gap-2 bg-emerald-800 hover:bg-emerald-700 text-white px-5 py-2.5 rounded-xl text-sm font-bold transition-all duration-300 shadow-md hover:shadow-emerald-700/25 hover:-translate-y-0.5 overflow-hidden">
                <span class="relative z-10 flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                    New Grievance
                </span>
            </a>
        </div>

        @if(session('success'))
            <div id="success-alert" class="bg-emerald-50/80 backdrop-blur-sm border border-emerald-200 text-emerald-700 px-5 py-4 rounded-xl mb-8 shadow-sm flex items-center justify-between animate-[fadeIn_0.5s_ease-out] transition-all duration-500">
                <div class="flex items-center gap-3">
                    <svg class="w-5 h-5 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    <span class="font-medium text-sm">{{ session('success') }}</span>
                </div>
                <button onclick="document.getElementById('success-alert').style.opacity='0'; setTimeout(() => document.getElementById('success-alert').remove(), 300)" class="text-emerald-400 hover:text-emerald-600 transition-colors focus:outline-none">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
            </div>
        @endif

        <div class="space-y-5">
            <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-4 mb-8">
                <form id="filter-form" action="{{ route('student.dashboard') }}" method="GET" class="flex flex-col md:flex-row gap-4">
                    <div class="flex-1 relative group">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-4 w-4 text-slate-400 group-focus-within:text-emerald-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                        </div>
                        <input type="text" name="search" value="{{ request('search') }}" placeholder="Search by subject or keyword..." 
                            class="block w-full pl-10 pr-3 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:ring-2 focus:ring-emerald-500 focus:bg-white outline-none transition-all">
                    </div>

                    <div class="w-full md:w-48">
                        <select name="status" id="status-select"
                            class="block w-full px-3 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:ring-2 focus:ring-emerald-500 focus:bg-white outline-none transition-all">
                            <option value="">All Statuses</option>
                            <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="in_progress" {{ request('status') == 'in_progress' ? 'selected' : '' }}>In Progress</option>
                            <option value="resolved" {{ request('status') == 'resolved' ? 'selected' : '' }}>Resolved</option>
                            <option value="closed" {{ request('status') == 'closed' ? 'selected' : '' }}>Closed</option>
                        </select>
                    </div>

                    <div class="flex gap-2">
                        <button type="submit" class="bg-emerald-800 hover:bg-emerald-700 text-white px-5 py-2.5 rounded-xl text-sm font-bold shadow-md transition-all">
                            Apply
                        </button>
                        @if(request()->hasAny(['search', 'status']))
                            <a href="{{ route('student.dashboard') }}" class="bg-slate-100 hover:bg-slate-200 text-slate-600 px-4 py-2.5 rounded-xl text-sm font-bold transition-all flex items-center">
                                Clear
                            </a>
                        @endif
                    </div>
                </form>
            </div>
            
            <div id="grievance-list-container">
                @include('student.partials.grievance-list')
            </div>
        </div>
    </main>

    <div id="evidence-modal" class="hidden fixed inset-0 z-[100] flex items-center justify-center bg-slate-900/70 backdrop-blur-sm transition-opacity duration-300 opacity-0 p-4 sm:p-6">
        <div id="evidence-modal-content" class="bg-white w-full max-w-5xl h-[90vh] sm:h-[85vh] rounded-2xl sm:rounded-3xl shadow-2xl flex flex-col transform scale-95 transition-transform duration-300 overflow-hidden border border-white/20">
            
            <div class="bg-white border-b border-slate-100 px-6 py-4 flex justify-between items-center z-10 shrink-0">
                <div class="flex items-center gap-3">
                    <div class="w-8 h-8 bg-emerald-50 rounded-lg flex items-center justify-center text-emerald-600">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                    </div>
                    <h3 class="font-bold text-slate-800 tracking-tight">Document Viewer</h3>
                </div>
                
                <button onclick="closeEvidenceModal()" class="group flex items-center justify-center w-8 h-8 rounded-full bg-slate-100 hover:bg-red-50 transition-colors focus:outline-none">
                    <svg class="w-4 h-4 text-slate-500 group-hover:text-red-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
            </div>

            <div class="flex-1 bg-slate-50/50 p-3 sm:p-5 overflow-hidden">
                <div class="w-full h-full rounded-xl sm:rounded-2xl overflow-hidden border border-slate-200/60 shadow-sm bg-white">
                    <iframe loading="lazy" id="evidence-frame" src="" class="w-full h-full border-0"></iframe>
                </div>
            </div>
            
        </div>
    </div>

    <div id="toast-container" class="fixed top-5 right-5 z-[120] flex flex-col gap-3 pointer-events-none"></div>

    <script>
        function toggleDetails(id) {
            const detailsDiv = document.getElementById('details-' + id);
            const icon = document.getElementById('icon-' + id);
            
            if (detailsDiv.classList.contains('hidden')) {
                detailsDiv.classList.remove('hidden');
                icon.style.transform = 'rotate(180deg)';
            } else {
                detailsDiv.classList.add('hidden');
                icon.style.transform = 'rotate(0deg)';
            }
        }
    </script>

    <script type="module">
        const userId = {{ Auth::user()->id }};
        const typingTimers = {};
        window.activeEchoChannels = window.activeEchoChannels || [];

        window.Echo.private(`student.${userId}`)
            .listen('GrievanceStatusUpdated', (event) => {
                const badge = document.getElementById(`status-badge-${event.grievance.id}`);
                
                if (badge) {
                    let statusText = event.grievance.status.replace('_', ' ');
                    let formattedText = statusText.charAt(0).toUpperCase() + statusText.slice(1);
                    
                    let innerHTML = '';
                    let baseClasses = 'shrink-0 inline-flex items-center gap-1.5 px-3 py-1 text-xs font-bold rounded-full border transition-colors duration-300 ';
                    
                    switch(event.grievance.status) {
                        case 'pending': 
                            badge.className = baseClasses + 'bg-amber-50 text-amber-700 border-amber-200/60'; 
                            innerHTML = `<span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span> ${formattedText}`;
                            break;
                        case 'in_progress': 
                            badge.className = baseClasses + 'bg-teal-50 text-teal-700 border-teal-200/60'; 
                            innerHTML = `<span class="w-1.5 h-1.5 rounded-full bg-teal-500"></span> ${formattedText}`;
                            break;
                        case 'resolved': 
                            badge.className = baseClasses + 'bg-emerald-50 text-emerald-700 border-emerald-200/60'; 
                            innerHTML = formattedText;
                            break;
                        case 'closed': 
                            badge.className = baseClasses + 'bg-slate-50 text-slate-600 border-slate-200'; 
                            innerHTML = formattedText;
                            break;
                    }
                    badge.innerHTML = innerHTML;

                    let targetLevel = 1;
                    if(event.grievance.status === 'in_progress') targetLevel = 2;
                    else if(event.grievance.status === 'resolved') targetLevel = 3;
                    else if(event.grievance.status === 'closed') targetLevel = 4;

                    const progressLine = document.getElementById(`progress-line-${event.grievance.id}`);
                    if(progressLine) {
                        progressLine.style.width = ((targetLevel - 1) * 33.33) + '%';
                    }

                    for(let i = 1; i <= 4; i++) {
                        const stepIcon = document.getElementById(`step-${i}-${event.grievance.id}`);
                        const stepText = document.getElementById(`step-text-${i}-${event.grievance.id}`);
                        
                        if(stepIcon && stepText) {
                            if(i <= targetLevel) {
                                stepIcon.className = 'w-8 h-8 rounded-full flex items-center justify-center shadow-md z-10 transition-colors duration-500 bg-emerald-600 text-white ring-4 ring-emerald-50';
                                stepText.className = 'absolute top-10 mt-1 text-[11px] uppercase tracking-wide whitespace-nowrap font-bold text-emerald-800 transition-colors duration-500';
                            } else {
                                stepIcon.className = 'w-8 h-8 rounded-full flex items-center justify-center shadow-md z-10 transition-colors duration-500 bg-white border-2 border-slate-200 text-slate-300';
                                stepText.className = 'absolute top-10 mt-1 text-[11px] uppercase tracking-wide whitespace-nowrap font-semibold text-slate-400 transition-colors duration-500';
                            }
                        }
                    }
                    
                    let subjectStr = event.grievance.subject;
                    if (subjectStr.length > 30) subjectStr = subjectStr.substring(0, 30) + '...';
                    showToast('Status Update', `Ticket <strong>#${event.grievance.id}</strong> ("${subjectStr}") is now <strong>${formattedText}</strong>.`);
                }
            });

        window.initializeChatForms = function() {
            document.querySelectorAll('.chat-ajax-form').forEach(form => {
                if (form.dataset.initialized) return;
                form.dataset.initialized = 'true';

                const textarea = form.querySelector('textarea[name="body"]');
                const grievanceId = form.dataset.grievanceId;
                const typingIndicator = document.getElementById(`typing-indicator-${grievanceId}`);
                const chatContainer = document.getElementById(`chat-container-${grievanceId}`);

                if (!window.activeEchoChannels.includes(grievanceId)) {
                    window.Echo.private(`grievance.${grievanceId}`)
                        .listen('.App\\Events\\CommentPosted', (event) => {
                            if (typingIndicator) {
                                typingIndicator.classList.replace('opacity-100', 'opacity-0');
                                clearTimeout(typingTimers[grievanceId]);
                            }

                            if (event.comment.user_id !== userId && chatContainer) {
                                const emptyState = chatContainer.querySelector('.text-center');
                                if (emptyState) emptyState.remove();

                                const senderName = event.comment.user.name || 'Authority';
                                const initial = senderName.charAt(0);
                                
                                const messageHTML = `
                                    <div class="flex justify-start gap-3 mb-4 animate-[fadeIn_0.3s_ease-out]">
                                        <div class="w-8 h-8 rounded-full bg-slate-200 flex-shrink-0 flex items-center justify-center font-bold text-slate-500 text-xs shadow-inner">
                                            ${initial}
                                        </div>
                                        <div class="bg-white border border-slate-200/60 text-slate-700 p-3.5 rounded-2xl rounded-tl-sm max-w-[85%] shadow-sm">
                                            <p class="text-xs font-extrabold text-slate-800 mb-1">
                                                ${senderName} <span class="text-emerald-500 ml-1">(New Reply)</span>
                                            </p>
                                            <p class="text-sm leading-relaxed whitespace-pre-wrap">${event.comment.body}</p>
                                            <span class="text-[10px] text-slate-400 mt-1.5 block font-medium">Just now</span>
                                        </div>
                                    </div>`;
                                chatContainer.insertAdjacentHTML('afterbegin', messageHTML);
                            }
                        })
                        .listenForWhisper('typing', (e) => {
                            if (typingIndicator) {
                                typingIndicator.innerText = `${e.name} is typing...`;
                                typingIndicator.classList.replace('opacity-0', 'opacity-100');
                                clearTimeout(typingTimers[grievanceId]);
                                typingTimers[grievanceId] = setTimeout(() => typingIndicator.classList.replace('opacity-100', 'opacity-0'), 2000); 
                            }
                        });
                    
                    window.activeEchoChannels.push(grievanceId);
                }

                textarea.addEventListener('keydown', function(e) {
                    if (e.key === 'Enter' && !e.shiftKey) {
                        e.preventDefault(); 
                        if (this.value.trim() !== '') form.dispatchEvent(new Event('submit', { cancelable: true })); 
                    }
                });

                textarea.addEventListener('input', function() {
                    window.Echo.private(`grievance.${grievanceId}`).whisper('typing', {
                        name: "{{ Auth::user()->is_anonymous ? 'Student' : Auth::user()->name }}"
                    });
                });

                form.addEventListener('submit', async function(e) {
                    e.preventDefault(); 
                    const body = textarea.value.trim();
                    if (!body) return;

                    textarea.disabled = true; 
                    try {
                        const response = await fetch(form.action, {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'Accept': 'application/json', 
                                'X-Requested-With': 'XMLHttpRequest',
                                'X-CSRF-TOKEN': form.querySelector('input[name="_token"]').value
                            },
                            body: JSON.stringify({ body })
                        });

                        if (response.ok) {
                            const data = await response.json();
                            textarea.value = ''; 
                            if (typingIndicator) typingIndicator.classList.replace('opacity-100', 'opacity-0');

                            if (chatContainer) {
                                const emptyState = chatContainer.querySelector('.text-center');
                                if (emptyState) emptyState.remove();

                                const myMessageHTML = `
                                    <div class="flex justify-end mb-4 animate-[fadeIn_0.3s_ease-out]">
                                        <div class="bg-emerald-600 text-white p-3.5 rounded-2xl rounded-tr-sm max-w-[85%] shadow-sm">
                                            <p class="text-sm leading-relaxed whitespace-pre-wrap">${data.comment.body}</p>
                                            <span class="text-[10px] text-emerald-200 mt-1.5 block text-right font-medium">You • Just now</span>
                                        </div>
                                    </div>`;
                                chatContainer.insertAdjacentHTML('afterbegin', myMessageHTML);
                            }
                        }
                    } catch (error) { console.error('Chat Error:', error); } 
                    finally { textarea.disabled = false; textarea.focus(); }
                });
            });
        };

        document.addEventListener('DOMContentLoaded', window.initializeChatForms);
    </script>

    <script>
        function openEvidenceModal(url) {
            const modal = document.getElementById('evidence-modal');
            const content = document.getElementById('evidence-modal-content');
            const frame = document.getElementById('evidence-frame');

            const scrollbarWidth = window.innerWidth - document.documentElement.clientWidth;
            document.body.style.paddingRight = `${scrollbarWidth}px`;

            frame.src = url;

            modal.classList.remove('hidden');
            void modal.offsetWidth; 
            
            modal.classList.remove('opacity-0');
            modal.classList.add('opacity-100');
            
            content.classList.remove('scale-95');
            content.classList.add('scale-100');

            document.body.classList.add('overflow-hidden');
        }

        function closeEvidenceModal() {
            const modal = document.getElementById('evidence-modal');
            const content = document.getElementById('evidence-modal-content');
            const frame = document.getElementById('evidence-frame');

            modal.classList.remove('opacity-100');
            modal.classList.add('opacity-0');
            
            content.classList.remove('scale-100');
            content.classList.add('scale-95');

            setTimeout(() => {
                modal.classList.add('hidden');
                frame.src = ''; 
                document.body.classList.remove('overflow-hidden');
                document.body.style.paddingRight = '0px';
            }, 300); 
        }
    </script>

    <script>
        function showToast(title, message) {
            const container = document.getElementById('toast-container');

            const toast = document.createElement('div');
            
            toast.className = 'pointer-events-auto bg-white/95 backdrop-blur-md border-l-4 border-emerald-500 shadow-xl rounded-r-xl p-4 w-80 transform transition-all duration-300 translate-x-full opacity-0 flex items-start gap-3';
            
            toast.innerHTML = `
                <div class="text-emerald-500 mt-0.5 shrink-0">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
                <div class="flex-1">
                    <h4 class="text-sm font-bold text-slate-800">${title}</h4>
                    <p class="text-xs text-slate-500 mt-1 leading-relaxed">${message}</p>
                </div>
                <button onclick="closeToast(this.parentElement)" class="shrink-0 text-slate-400 hover:text-slate-600 focus:outline-none transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
            `;

            container.appendChild(toast);

            requestAnimationFrame(() => {
                setTimeout(() => {
                    toast.classList.remove('translate-x-full', 'opacity-0');
                }, 10);
            });

            setTimeout(() => {
                closeToast(toast);
            }, 4500);
        }

        function closeToast(toastElement) {
            toastElement.classList.add('translate-x-full', 'opacity-0');

            setTimeout(() => {
                if (toastElement.parentNode) {
                    toastElement.parentNode.removeChild(toastElement);
                }
            }, 300);
        }
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const filterForm = document.getElementById('filter-form');
            const statusSelect = document.getElementById('status-select');
            const listContainer = document.getElementById('grievance-list-container');

            if (!filterForm || !listContainer) return;

            async function fetchFilteredData() {
                listContainer.style.opacity = '0.5'; 
                
                const formData = new FormData(filterForm);
                const params = new URLSearchParams(formData).toString();
                const url = `${filterForm.action}?${params}`;

                try {
                    const response = await fetch(url, {
                        headers: { 'X-Requested-With': 'XMLHttpRequest' }
                    });
                    
                    if (response.ok) {
                        listContainer.innerHTML = await response.text();

                        history.pushState(null, '', url);

                        if (typeof window.initializeChatForms === 'function') {
                            window.initializeChatForms();
                        }
                    }
                } catch (error) {
                    console.error('Filtering error:', error);
                } finally {
                    listContainer.style.opacity = '1';
                }
            }

            filterForm.addEventListener('submit', function(e) {
                e.preventDefault();
                fetchFilteredData();
            });

            if (statusSelect) {
                statusSelect.addEventListener('change', function() {
                    fetchFilteredData();
                });
            }
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const alert = document.getElementById('success-alert');

            if (alert) {
                setTimeout(() => {
                    alert.style.opacity = '0';
                    alert.style.transform = 'translateY(-10px)';
                    
                    setTimeout(() => {
                        alert.remove();
                    }, 500);
                }, 5000);
            }
        });
    </script>
</body>
</html>