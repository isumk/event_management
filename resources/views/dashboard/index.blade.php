<x-app-layout>
    <div class="container mx-auto px-6 py-8">
        <h1 class="text-4xl font-extrabold mb-8 text-gray-800 dark:text-gray-100">Welcome back, {{ auth()->user()->name }}!</h1>

        @php
            $role = auth()->user()->role->name;
        @endphp

        @if($role === 'Admin')
            {{-- Admin View --}}
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-10">
                <x-dashboard-card title="Active Events" count="{{ $activeEventsCount }}" link="{{ route('events.index') }}" />
                <x-dashboard-card title="Pending Tasks" count="{{ $pendingTasksCount }}" link="{{ route('tasks.index') }}" />
                <x-dashboard-card title="Collaborators" count="{{ $collaboratorsCount }}" link="#" />
                <x-dashboard-card title="User Management" count="{{ $usersCount ?? 0 }}" link="{{ route('users.index') }}" />
            </div>
            <x-dashboard-recent :events="$recentEvents" :tasks="$recentTasks" />

        @elseif($role === 'Event Manager')
            {{-- Event Manager View --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">
                <x-dashboard-card title="Active Events" count="{{ $activeEventsCount }}" link="{{ route('events.index') }}" />
                <x-dashboard-card title="Pending Tasks" count="{{ $pendingTasksCount }}" link="{{ route('tasks.index') }}" />
                <x-dashboard-card title="Collaborators" count="{{ $collaboratorsCount }}" link="#" />
            </div>
            <x-dashboard-recent :events="$recentEvents" :tasks="$recentTasks" />

        @elseif($role === 'Collaborator')
            {{-- Collaborator View --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-10">
                <x-dashboard-card title="Your Events" count="{{ $userEventsCount ?? 0 }}" link="{{ route('collaborator.events') }}" />
                <x-dashboard-card title="Your Tasks" count="{{ $userTasksCount ?? 0 }}" link="{{ route('tasks.index') }}" />
            </div>
            <x-dashboard-recent :events="$userRecentEvents" :tasks="$userRecentTasks" />
        @endif
    </div>

    <!-- Internal CSS -->
    <style>
        .container {
            padding: 2rem;
            max-width: 1200px;
            margin: 0 auto;
        }

        .page-title {
            font-size: 2.5rem;
            font-weight: bold;
            color: #2d3748;
            margin-bottom: 1.5rem;
        }

        .form-label {
            font-size: 1rem;
            font-weight: 600;
            color: #2d3748;
            margin-bottom: 0.5rem;
            display: block;
        }

        .btn-submit {
            background-color: #3182ce;
            color: white;
            padding: 0.75rem 1.5rem;
            border-radius: 0.375rem;
            text-decoration: none;
            display: inline-block;
            font-size: 1rem;
            transition: background-color 0.3s;
        }

        .btn-submit:hover {
            background-color: #2b6cb0;
        }

        .btn-cancel {
            background-color: #e2e8f0;
            color: #2d3748;
            padding: 0.75rem 1.5rem;
            border-radius: 0.375rem;
            text-decoration: none;
            display: inline-block;
            font-size: 1rem;
            margin-left: 1rem;
            transition: background-color 0.3s;
        }

        .btn-cancel:hover {
            background-color: #cbd5e0;
        }

        .alert-error {
            background-color: #fbd5d5;
            color: #e53e3e;
            padding: 1rem;
            border-radius: 0.375rem;
            margin-bottom: 1.5rem;
        }
    </style>
</x-app-layout>
