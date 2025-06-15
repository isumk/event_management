<x-app-layout>
    <div class="container mx-auto p-4 max-w-4xl">
        <h1 class="text-3xl font-bold mb-6">Your Events</h1>

        @if($events->isEmpty())
            <p>You have no assigned events.</p>
        @else
            <ul class="divide-y divide-gray-300">
                @foreach($events as $event)
                    <li class="py-4 flex justify-between items-center">
                        <div>
                            <a href="{{ route('events.show', $event) }}" class="text-indigo-600 hover:underline font-semibold">
                                {{ $event->title }}
                            </a>
                            <div class="text-gray-600 text-sm">
                                Status: {{ ucfirst($event->status) }} |
                                Start: {{ $event->start_date->format('Y-m-d') }} |
                                End: {{ $event->end_date->format('Y-m-d') }}
                            </div>
                        </div>
                        <a href="{{ route('events.chat', $event) }}" class="btn btn-sm btn-primary">Chat</a>
                    </li>
                @endforeach
            </ul>
        @endif
    </div>
</x-app-layout>
