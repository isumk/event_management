<x-app-layout>

<div class="container">
    <h1>Task Details</h1>

    <div class="mb-3">
        <strong>Description:</strong> {{ $task->description }}
    </div>

    <div class="mb-3">
        <strong>Event:</strong> {{ $task->event->title }}
    </div>

    <div class="mb-3">
        <strong>Assigned To:</strong> {{ $task->assignedUser->name }}
    </div>

    <div class="mb-3">
        <strong>Status:</strong> {{ ucfirst($task->status) }}
    </div>

    <div class="mb-3">
        <strong>Start Date:</strong> {{ $task->start_date ? $task->start_date->format('F d, Y') : '-' }}
    </div>

    <div class="mb-3">
        <strong>Due Date:</strong> {{ $task->due_date ? $task->due_date->format('F d, Y') : '-' }}
    </div>

    <a href="{{ route('tasks.index') }}" class="btn btn-secondary">Back to Tasks</a>
</div>
</x-app-layout>

