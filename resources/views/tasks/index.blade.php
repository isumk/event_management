<x-app-layout>
    <div class="container">
        <h1 class="page-title">Tasks</h1>

        @if(session('success'))
            <div class="alert-success">{{ session('success') }}</div>
        @endif

        @if(in_array(auth()->user()->role->name, ['Admin', 'Event Manager']))
            <a href="{{ route('tasks.create') }}" class="btn-create">Create Task</a>
        @endif

        <table class="table-styled">
            <thead>
                <tr>
                    <th>Description</th>
                    <th>Event</th>
                    <th>Assigned To</th>
                    <th>Status</th>
                    <th>Start Date</th>
                    <th>Due Date</th>
                    @if(in_array(auth()->user()->role->name, ['Admin', 'Event Manager']))
                        <th>Actions</th>
                    @elseif(auth()->user()->role->name === 'Collaborator')
                        <th>Mark Completed</th>
                    @endif
                </tr>
            </thead>
            <tbody>
                @forelse($tasks as $task)
                    <tr class="table-row">
                        <td>{{ $task->description }}</td>
                        <td>{{ $task->event->title }}</td>
                        <td>{{ $task->assignedUser->name }}</td>
                        <td>{{ ucfirst($task->status) }}</td>
                        <td>{{ $task->start_date ? $task->start_date->format('Y-m-d') : '-' }}</td>
                        <td>{{ $task->due_date ? $task->due_date->format('Y-m-d') : '-' }}</td>

                        @if(in_array(auth()->user()->role->name, ['Admin', 'Event Manager']))
                            <td>
                                <a href="{{ route('tasks.show', $task) }}" class="btn-view">View</a>
                                <a href="{{ route('tasks.edit', $task) }}" class="btn-edit">Edit</a>
                                <form action="{{ route('tasks.destroy', $task) }}" method="POST" class="inline" onsubmit="return confirm('Delete this task?');">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn-delete">Delete</button>
                                </form>
                            </td>
                        @elseif(auth()->user()->role->name === 'Collaborator')
                            <td>
                                <form action="{{ route('tasks.update', $task) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="status" value="{{ $task->status === 'completed' ? 'pending' : 'completed' }}">
                                    <button type="submit" class="btn-sm {{ $task->status === 'completed' ? 'btn-success' : 'btn-outline-secondary' }}">
                                        {{ $task->status === 'completed' ? 'Completed' : 'Mark Completed' }}
                                    </button>
                                </form>
                            </td>
                        @endif
                    </tr>
                @empty
                    <tr>
                        <td colspan="7">No tasks found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
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

        .btn-create {
            display: inline-block;
            padding: 0.75rem 1.5rem;
            background-color: #3182ce;
            color: white;
            border-radius: 0.375rem;
            text-decoration: none;
            margin-bottom: 1.5rem;
        }

        .btn-create:hover {
            background-color: #2b6cb0;
        }

        .alert-success {
            background-color: #c6f6d5;
            color: #38a169;
            padding: 1rem;
            border-radius: 0.375rem;
            margin-bottom: 1.5rem;
        }

        .table-styled {
            width: 100%;
            border-collapse: collapse;
            border-radius: 0.375rem;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        .table-styled th, .table-styled td {
            padding: 1rem;
            text-align: left;
            border: 1px solid #e2e8f0;
        }

        .table-styled th {
            background-color: #3182ce;
            color: white;
            font-size: 1rem;
        }

        .table-row:hover {
            background-color: #edf2f7;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .action-buttons a {
            padding: 0.5rem 1rem;
            margin-right: 0.5rem;
            border-radius: 0.375rem;
            font-size: 0.875rem;
            text-decoration: none;
        }

        .btn-view {
            background-color: #3182ce;
            color: white;
        }

        .btn-view:hover {
            background-color: #2b6cb0;
        }

        .btn-edit {
            background-color: #ecc94b;
            color: white;
        }

        .btn-edit:hover {
            background-color: #d69e2e;
        }

        .btn-delete {
            background-color: #e53e3e;
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 0.375rem;
            font-size: 0.875rem;
            border: none;
            cursor: pointer;
        }

        .btn-delete:hover {
            background-color: #c53030;
        }

        .btn-sm {
            padding: 0.5rem 1rem;
            font-size: 0.875rem;
            cursor: pointer;
            border-radius: 0.375rem;
            transition: background-color 0.3s ease-in-out;
        }

        .btn-sm:hover {
            background-color: #3182ce;
            color: white;
        }

        .btn-outline-secondary {
            border: 1px solid #e2e8f0;
            background-color: white;
            color: #3182ce;
        }

        .btn-outline-secondary:hover {
            background-color: #e2e8f0;
        }

        /* Floating Effect for the table rows */
        .table-row {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .table-row:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.15);
        }
    </style>
</x-app-layout>
