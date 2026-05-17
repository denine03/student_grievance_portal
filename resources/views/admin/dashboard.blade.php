@extends('layouts.admin')

@section('title', 'Overview - Admin Console')
@section('header_title', 'System Overview')
@section('header_subtitle', 'High-level metrics and global system activity.')

@section('content')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <div id="admin-ajax-container" class="transition-all duration-300">
        @include('admin.partials.dashboard-content')
    </div>

    <script>
        window.adminChartInstances = [];

        window.initializeAdminCharts = function(grievanceData, studentData, authData) {
            if (window.adminChartInstances.length > 0) {
                window.adminChartInstances.forEach(chart => chart.destroy());
                window.adminChartInstances = [];
            }

            const commonOptions = {
                responsive: true,
                maintainAspectRatio: false,
                cutout: '70%',
                devicePixelRatio: window.devicePixelRatio > 1 ? window.devicePixelRatio : 2,
                plugins: {
                    legend: { position: 'bottom', labels: { font: { size: 11, family: 'system-ui, sans-serif', weight: 'bold' }, usePointStyle: true, boxWidth: 6 } },
                    tooltip: { backgroundColor: 'rgba(15, 23, 42, 0.9)', padding: 10, cornerRadius: 8 }
                }
            };

            const gChart = new Chart(document.getElementById('grievanceChart'), {
                type: 'doughnut',
                data: {
                    labels: ['Pending', 'In Progress', 'Resolved', 'Closed'],
                    datasets: [{
                        data: grievanceData,
                        backgroundColor: ['#f59e0b', '#14b8a6', '#10b981', '#64748b'],
                        borderWidth: 0, hoverOffset: 4
                    }]
                }, options: commonOptions
            });

            const sChart = new Chart(document.getElementById('studentChart'), {
                type: 'doughnut',
                data: {
                    labels: ['Logged In', 'Offline'],
                    datasets: [{
                        data: studentData,
                        backgroundColor: ['#3b82f6', '#e2e8f0'],
                        borderWidth: 0, hoverOffset: 4
                    }]
                }, options: commonOptions
            });

            const aChart = new Chart(document.getElementById('authChart'), {
                type: 'doughnut',
                data: {
                    labels: ['Logged In', 'Offline'],
                    datasets: [{
                        data: authData,
                        backgroundColor: ['#8b5cf6', '#e2e8f0'],
                        borderWidth: 0, hoverOffset: 4
                    }]
                }, options: commonOptions
            });

            window.adminChartInstances.push(gChart, sChart, aChart);
        };

        function triggerCharts() {
            const payload = document.getElementById('chart-data-payload');
            if (payload && typeof window.initializeAdminCharts === 'function') {
                window.initializeAdminCharts(
                    [payload.dataset.gPending, payload.dataset.gProgress, payload.dataset.gResolved, payload.dataset.gClosed],
                    [payload.dataset.sOnline, payload.dataset.sOffline],
                    [payload.dataset.aOnline, payload.dataset.aOffline]
                );
            }
        }

        document.addEventListener('DOMContentLoaded', function() {
            triggerCharts();

            const ajaxContainer = document.getElementById('admin-ajax-container');
            if (!ajaxContainer) return;

            document.addEventListener('click', async function(e) {
                const filterLink = e.target.closest('.ajax-filter-link');
                if (!filterLink) return;

                e.preventDefault(); 
                const url = filterLink.href;
                
                ajaxContainer.style.opacity = '0.5';

                try {
                    const response = await fetch(url, {
                        headers: { 'X-Requested-With': 'XMLHttpRequest' }
                    });

                    if (response.ok) {
                        ajaxContainer.innerHTML = await response.text();
                        history.pushState(null, '', url);
                        triggerCharts();
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