<x-app-layout>

<div class="container">
    <h1>Events</h1>

    <a href="{{ route('events.create') }}" class="btn btn-primary mb-3">Create Event</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Title</th>
                <th>Start Date</th>
                <th>End Date</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($events as $event)
                <tr>
                    <td>{{ $event->title }}</td>
                    <td>{{ $event->start_date }}</td>
                    <td>{{ $event->end_date }}</td>
                    <td>{{ ucfirst($event->status) }}</td>
                    <td>
                        <a href="{{ route('events.show', $event) }}" class="btn btn-info btn-sm">View</a>
                        <a href="{{ route('events.edit', $event) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('events.destroy', $event) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm" onclick="return confirm('Delete event?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5">No events found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
</x-app-layout>

