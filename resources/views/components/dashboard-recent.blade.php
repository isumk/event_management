@props(['events', 'tasks'])

<div class="mb-8">
    <h2 class="text-2xl font-bold mb-4 text-gray-800 dark:text-gray-100">Recent Events</h2>
    <ul class="divide-y divide-gray-200 dark:divide-gray-600 border border-gray-200 dark:border-gray-600 rounded-md bg-white dark:bg-gray-800">
        @forelse ($events as $event)
            <li class="px-6 py-4 hover:bg-gray-50 dark:hover:bg-gray-900">
                <a href="{{ route('events.show', $event) }}" class="font-semibold text-blue-600 dark:text-blue-400 hover:underline">{{ $event->title }}</a>
                <span class="ml-2 text-sm text-gray-500 dark:text-gray-400 uppercase">{{ ucfirst($event->status) }}</span>
            </li>
        @empty
            <li class="px-6 py-4 text-gray-500 dark:text-gray-400">No recent events.</li>
        @endforelse
    </ul>
</div>

<div>
    <h2 class="text-2xl font-bold mb-4 text-gray-800 dark:text-gray-100">Recent Tasks</h2>
    <ul class="divide-y divide-gray-200 dark:divide-gray-600 border border-gray-200 dark:border-gray-600 rounded-md bg-white dark:bg-gray-800">
        @forelse ($tasks as $task)
            <li class="px-6 py-4 hover:bg-gray-50 dark:hover:bg-gray-900 flex justify-between items-center">
                <div>
                    {{ $task->description }}
                    <span class="ml-2 text-sm text-gray-500 dark:text-gray-400">({{ ucfirst($task->status) }})</span><br />
                    <small class="text-gray-400 dark:text-gray-500">Assigned to: {{ $task->assignedUser->name ?? 'Unassigned' }}</small>
                </div>
                <a href="{{ route('tasks.show', $task) }}" class="text-blue-600 dark:text-blue-400 hover:underline ml-4">Details</a>
            </li>
        @empty
            <li class="px-6 py-4 text-gray-500 dark:text-gray-400">No recent tasks.</li>
        @endforelse
    </ul>
</div>
