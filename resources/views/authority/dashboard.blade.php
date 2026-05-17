<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Authority Dashboard - MZU Portal</title>
    <link rel="preload" as="image" href="{{ asset('images/MZU-LOGO-2001-new.png') }}">
    <link rel="icon" type="image/png" href="{{ asset('images/MZU-LOGO-2001-new.png') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-slate-50 antialiased font-sans text-slate-900 selection:bg-emerald-100 selection:text-emerald-900 flex flex-col min-h-screen">

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

    <main class="max-w-6xl mx-auto mt-10 p-6 w-full flex-grow">
        <div class="mb-10">
            <h2 class="text-3xl font-black text-slate-900 tracking-tight">Department Action Queue</h2>
            <p class="text-slate-500 mt-1.5 text-sm">Review and manage student grievances assigned to your department.</p>
        </div>

        @if(session('success'))
            <div id="success-alert" class="bg-emerald-50/80 backdrop-blur-sm border border-emerald-200 text-emerald-700 px-5 py-4 rounded-xl mb-8 shadow-sm flex items-center justify-between animate-[fadeIn_0.5s_ease-out] transition-all duration-500">
                <div class="flex items-center gap-3">
                    <svg class="w-5 h-5 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    <span class="font-medium text-sm">{{ session('success') }}</span>
                </div>
                <button onclick="document.getElementById('success-alert').remove()" class="text-emerald-400 hover:text-emerald-600 transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
            </div>
        @endif

        <div id="authority-ajax-container">
            @include('authority.partials.dashboard-content')
        </div>

    </main>

    <footer class="bg-white border-t border-slate-100 text-center text-slate-400 p-6 text-xs mt-auto">
        &copy; 2026 Mizoram University
    </footer>

    <script>
        function toggleModal(id, action) {
            const modal = document.getElementById('modal-' + id);
            if (!modal) return;
            const content = modal.querySelector('.max-w-2xl');
            
            if (action === 'open') {
                modal.classList.remove('hidden');
                modal.classList.add('flex');
                requestAnimationFrame(() => {
                    modal.classList.add('opacity-100');
                    content.classList.add('scale-100');
                });
                document.body.classList.add('overflow-hidden');
            } else {
                modal.classList.remove('opacity-100');
                content.classList.remove('scale-100');
                setTimeout(() => {
                    modal.classList.add('hidden');
                    modal.classList.remove('flex');
                    document.body.classList.remove('overflow-hidden');

                    const viewer = document.getElementById('viewer-' + id);
                    if (viewer && !viewer.classList.contains('hidden')) toggleAttachment(id);
                }, 300);
            }
        }

        window.onclick = e => {
            if (e.target.id.startsWith('modal-')) toggleModal(e.target.id.replace('modal-', ''), 'close');
        };

        function toggleAttachment(id) {
            const viewer = document.getElementById('viewer-' + id);
            const btnSpan = document.querySelector('#btn-attach-' + id + ' span');
            viewer.classList.toggle('hidden');
            btnSpan.innerText = viewer.classList.contains('hidden') ? 'Show Attached Evidence' : 'Hide Attached Evidence';
        }
    </script>

    <script type="module">
        const typingTimers = {};
        window.activeEchoChannels = window.activeEchoChannels || [];

        window.initializeAuthorityChatForms = function() {
            const currentUserId = {{ Auth::id() }};
            const isStudentView = {{ Auth::user()->role === 'student' ? 'true' : 'false' }};
            const myName = "{{ Auth::user()->role === 'student' ? (Auth::user()->is_anonymous ? 'Student' : Auth::user()->name) : 'Authority Staff' }}";

            document.querySelectorAll('.chat-ajax-form').forEach(form => {
                if (form.dataset.initialized) return;
                form.dataset.initialized = 'true';

                const grievanceId = form.dataset.grievanceId;
                const textarea = form.querySelector('textarea[name="body"]');
                const chatContainer = document.getElementById(`chat-container-${grievanceId}`);
                const typingIndicator = document.getElementById(`typing-indicator-${grievanceId}`);

                if (!window.activeEchoChannels.includes(grievanceId)) {
                    window.Echo.private(`grievance.${grievanceId}`)
                        .listen('.App\\Events\\CommentPosted', (event) => {
                            if (typingIndicator) {
                                typingIndicator.classList.replace('opacity-100', 'opacity-0');
                                clearTimeout(typingTimers[grievanceId]);
                            }

                            if (event.comment.user_id !== currentUserId && chatContainer) {
                                const emptyState = chatContainer.querySelector('.text-center');
                                if (emptyState) emptyState.remove();

                                const senderName = event.comment.user.name || 'Student';
                                const initial = senderName.charAt(0);
                                
                                const messageHTML = `
                                    <div class="flex justify-start gap-3 mb-2 animate-[fadeIn_0.3s_ease-out]">
                                        <div class="w-8 h-8 rounded-full ${isStudentView ? 'bg-emerald-100 text-emerald-700' : 'bg-slate-200 text-slate-500'} flex-shrink-0 flex items-center justify-center font-bold text-xs shadow-inner">
                                            ${isStudentView ? 'A' : initial}
                                        </div>
                                        <div class="bg-white border ${isStudentView ? 'border-emerald-100' : 'border-slate-200/60'} text-slate-700 p-3.5 rounded-2xl rounded-tl-sm max-w-[85%] shadow-sm">
                                            <p class="text-[10px] font-black text-emerald-800 uppercase tracking-widest mb-1">
                                                ${isStudentView ? 'Authority Staff' : senderName} <span class="text-emerald-500 ml-1">(New Reply)</span>
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

                textarea.addEventListener('keydown', e => {
                    if (e.key === 'Enter' && !e.shiftKey) {
                        e.preventDefault(); 
                        if (textarea.value.trim() !== '') form.dispatchEvent(new Event('submit', { cancelable: true })); 
                    }
                });

                textarea.addEventListener('input', () => {
                    window.Echo.private(`grievance.${grievanceId}`).whisper('typing', { name: myName });
                });

                form.addEventListener('submit', async e => {
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
                                    <div class="flex justify-end mb-2 animate-[fadeIn_0.3s_ease-out]">
                                        <div class="bg-emerald-700 text-white p-3.5 rounded-2xl rounded-tr-sm max-w-[85%] shadow-sm">
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

        document.addEventListener('DOMContentLoaded', window.initializeAuthorityChatForms);
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const alert = document.getElementById('success-alert');
            if (alert) {
                setTimeout(() => {
                    alert.style.opacity = '0';
                    alert.style.transform = 'translateY(-10px)';
                    setTimeout(() => alert.remove(), 500);
                }, 5000);
            }
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const ajaxContainer = document.getElementById('authority-ajax-container');
            if (!ajaxContainer) return;

            document.addEventListener('click', async e => {
                const filterLink = e.target.closest('.ajax-filter-link');
                if (!filterLink) return;

                e.preventDefault(); 
                const url = filterLink.href;
                ajaxContainer.style.opacity = '0.5';

                try {
                    const response = await fetch(url, { headers: { 'X-Requested-With': 'XMLHttpRequest' } });
                    if (response.ok) {
                        ajaxContainer.innerHTML = await response.text();
                        history.pushState(null, '', url);
                        if (typeof window.initializeAuthorityChatForms === 'function') window.initializeAuthorityChatForms();
                    }
                } catch (error) {
                    console.error('AJAX Error:', error);
                } finally {
                    ajaxContainer.style.opacity = '1';
                }
            });
        });
    </script>
</body>
</html>