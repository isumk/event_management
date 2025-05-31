
<x-app-layout>

<div class="container">
    <h1>Dashboard</h1>

    <div class="row mb-4">
        <div class="col-md-4">
            <div class="card text-center p-3">
                <h2>{{ $activeEventsCount }}</h2>
                <p>Active Events</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-center p-3">
                <h2>{{ $pendingTasksCount }}</h2>
                <p>Pending Tasks</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-center p-3">
                <h2>{{ $collaboratorsCount }}</h2>
                <p>Collaborators</p>
            </div>
        </div>
    </div>

    <h3>Recent Events</h3>
    <ul class="list-group mb-4">
        @forelse($recentEvents as $event)
            <li class="list-group-item">
                <a href="{{ route('events.show', $event) }}">{{ $event->title }}</a> ({{ ucfirst($event->status) }})
            </li>
        @empty
            <li class="list-group-item">No recent events.</li>
        @endforelse
    </ul>

    <h3>Recent Tasks</h3>
    <ul class="list-group">
        @forelse($recentTasks as $task)
            <li class="list-group-item">
                {{ $task->description }} —
                <strong>{{ $task->assignedUser->name ?? 'Unassigned' }}</strong>
                ({{ ucfirst($task->status) }})
            </li>
        @empty
            <li class="list-group-item">No recent tasks.</li>
        @endforelse
    </ul>
</div>
</x-app-layout>

