@extends('layouts.admin')

@section('title', 'Grievance Directory - Admin Console')
@section('header_title', 'Grievance Directory')
@section('header_subtitle', 'Global administrative view and management of all submissions.')

@section('content')
    @if(session('success'))
        <div id="success-alert" class="bg-emerald-50/80 backdrop-blur-sm border border-emerald-200 text-emerald-700 px-5 py-4 rounded-xl mb-8 flex items-center justify-between transition-all duration-500">
            <span class="font-medium text-sm">{{ session('success') }}</span>
            <button onclick="this.parentElement.remove()" class="text-emerald-500 hover:text-emerald-700">&times;</button>
        </div>
    @endif

    <div id="grievance-ajax-container" class="transition-all duration-300">
        @include('admin.partials.grievances-list')
    </div>

    <script>
        // Universal Modal Toggler
        function toggleModal(modalId, action) {
            const modal = document.getElementById(modalId);
            if (!modal) return;
            
            const content = modal.firstElementChild;
            
            if (action === 'open') {
                modal.classList.remove('hidden');
                modal.classList.add('flex');
                requestAnimationFrame(() => {
                    modal.classList.replace('opacity-0', 'opacity-100');
                    if (content.classList.contains('scale-95')) {
                        content.classList.replace('scale-95', 'scale-100');
                    }
                });
                document.body.classList.add('overflow-hidden');
            } else if (action === 'close') {
                modal.classList.replace('opacity-100', 'opacity-0');
                if (content.classList.contains('scale-100')) {
                    content.classList.replace('scale-100', 'scale-95');
                }
                setTimeout(() => {
                    modal.classList.remove('flex');
                    modal.classList.add('hidden');
                    
                    // Smart Scroll Check: Only restore scrolling if NO modals are currently active
                    const activeModals = document.querySelectorAll('[id^="modal-"].flex, [id^="evidence-modal-"].flex');
                    if (activeModals.length === 0) {
                        document.body.classList.remove('overflow-hidden');
                    }
                }, 300);
            }
        }

        document.addEventListener('DOMContentLoaded', function() {
            const ajaxContainer = document.getElementById('grievance-ajax-container');

            document.addEventListener('click', async function(e) {
                const targetEl = e.target.closest('.ajax-filter-link') || e.target.closest('.local-ajax-pagination a');
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