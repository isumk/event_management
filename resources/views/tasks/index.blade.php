<x-app-layout>

<div class="container">
    <h1>Tasks</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @canany(['Admin', 'Event Manager'])
    <a href="{{ route('tasks.create') }}" class="btn btn-primary mb-3">Create Task</a>
    @endcanany

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Description</th>
                <th>Event</th>
                <th>Assigned To</th>
                <th>Status</th>
                <th>Start Date</th>
                <th>Due Date</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($tasks as $task)
                <tr>
                    <td>{{ $task->description }}</td>
                    <td>{{ $task->event->title }}</td>
                    <td>{{ $task->assignedUser->name }}</td>
                    <td>{{ ucfirst($task->status) }}</td>
                    <td>{{ $task->start_date ? $task->start_date->format('Y-m-d') : '-' }}</td>
                    <td>{{ $task->due_date ? $task->due_date->format('Y-m-d') : '-' }}</td>
                    <td>
                        <a href="{{ route('tasks.show', $task) }}" class="btn btn-info btn-sm">View</a>
                        @canany(['Admin', 'Event Manager'])
                        <a href="{{ route('tasks.edit', $task) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('tasks.destroy', $task) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button onclick="return confirm('Delete this task?')" class="btn btn-danger btn-sm">Delete</button>
                        </form>
                        @endcanany
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7">No tasks found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
</x-app-layout>

