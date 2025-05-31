<x-app-layout>

<div class="container">
    <h1>Event Details</h1>

    <div class="mb-3">
        <strong>Title:</strong> {{ $event->title }}
    </div>

    <div class="mb-3">
        <strong>Description:</strong> {!! nl2br(e($event->description)) !!}
    </div>

    <div class="mb-3">
        <strong>Start Date:</strong> {{ $event->start_date->format('F d, Y') }}
    </div>

    <div class="mb-3">
        <strong>End Date:</strong> {{ $event->end_date->format('F d, Y') }}
    </div>

    <div class="mb-3">
        <strong>Status:</strong> {{ ucfirst($event->status) }}
    </div>

    <a href="{{ route('events.index') }}" class="btn btn-secondary">Back to Events</a>
</div>
</x-app-layout>

