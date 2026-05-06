<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Authority Dashboard</title>

    @vite('resources/css/app.css')
</head>

<body class="bg-gray-100 antialiased font-sans text-gray-900">

<!-- Navbar -->
<nav class="bg-slate-800 text-white p-4 shadow-md flex justify-between items-center">
    <h1 class="text-xl font-bold">MZU Grievance Portal - Authority</h1>
    <div class="flex items-center gap-4">
        <a href="{{ route('authority.dashboard') }}" class="text-slate-300 hover:text-white">Dashboard</a>
        <span>|</span>

        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="text-red-400 hover:text-red-300 font-semibold">
                Logout
            </button>
        </form>
    </div>
</nav>

<!-- Container -->
<div class="max-w-5xl mx-auto mt-10 p-6 bg-white rounded-lg shadow-md border border-gray-200">

    <h2 class="text-2xl font-bold text-gray-800 mb-6">All Grievances</h2>

    <div class="overflow-x-auto">
        <table class="w-full border-collapse">

            <thead>
                <tr class="bg-gray-200 text-left">
                    <th class="p-3">ID</th>
                    <th class="p-3">Category</th>
                    <th class="p-3">Subject</th>
                    <th class="p-3">Status</th>
                    <th class="p-3">Emergency</th>
                    <th class="p-3">Action</th>
                </tr>
            </thead>

            <tbody>

                @forelse($grievances as $g)
                <tr class="border-b hover:bg-gray-50">

                    <td class="p-3">{{ $g->id }}</td>
                    <td class="p-3">{{ $g->category }}</td>
                    <td class="p-3">{{ $g->subject }}</td>

                    <!-- Status -->
                    <td class="p-3">
                        <span class="px-2 py-1 rounded
                            {{ $g->status == 'Pending' ? 'bg-yellow-200 text-yellow-800' : '' }}
                            {{ $g->status == 'Resolved' ? 'bg-green-200 text-green-800' : '' }}">
                            {{ $g->status }}
                        </span>
                    </td>

                    <!-- Emergency -->
                    <td class="p-3">
                        @if($g->is_emergency)
                            <span class="text-red-600 font-bold">URGENT</span>
                        @else
                            <span class="text-gray-500">Normal</span>
                        @endif
                    </td>

                    <!-- Actions -->
                    <td class="p-3 flex gap-2">

                        <!-- View -->
                        <a href="{{ route('grievance.show', $g->id) }}"
                           class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded">
                            View
                        </a>

                        <!-- Resolve -->
                        @if($g->status != 'Resolved')
                        <form action="{{ route('grievance.resolve', $g->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <button class="bg-green-500 hover:bg-green-600 text-white px-3 py-1 rounded">
                                Resolve
                            </button>
                        </form>
                        @else
                        <button class="bg-gray-400 text-white px-3 py-1 rounded cursor-not-allowed">
                            Done
                        </button>
                        @endif

                    </td>

                </tr>

                @empty
                <tr>
                    <td colspan="6" class="text-center p-5 text-gray-500">
                        No grievances found.
                    </td>
                </tr>
                @endforelse

            </tbody>

        </table>
    </div>

</div>

</body>
</html>