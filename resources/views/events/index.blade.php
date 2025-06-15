<x-app-layout>
    <div class="container">
        <h1 class="page-title">Events</h1>

        <a href="{{ route('events.create') }}" class="btn-create">Create Event</a>

        @if(session('success'))
            <div class="alert-success">{{ session('success') }}</div>
        @endif

        <table class="table-styled">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Status</th>
                    <th>Progress</th>
                    <th>Collaborators</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($events as $event)
                    <tr class="table-row">
                        <td>{{ $event->title }}</td>
                        <td>{{ $event->start_date }}</td>
                        <td>{{ $event->end_date }}</td>
                        <td>{{ ucfirst($event->status) }}</td>

                        <td>
                            <div class="progress-bar-container">
                                <div class="progress-bar" style="width: {{ $event->progress() }}%;"></div>
                            </div>
                            <small>{{ $event->progress() }}% Complete</small>
                        </td>

                        <td>
                            {{ $event->tasks()->with('assignedUser')->get()->pluck('assignedUser.name')->unique()->filter()->count() }}
                        </td>

                        <td class="action-buttons">
                            <a href="{{ route('events.show', $event) }}" class="btn-view">View</a>
                            <a href="{{ route('events.edit', $event) }}" class="btn-edit">Edit</a>
                            <form action="{{ route('events.destroy', $event) }}" method="POST" class="inline" onsubmit="return confirm('Delete event?');">
                                @csrf
                                @method('DELETE')
                                <button class="btn-delete">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7">No events found.</td>
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

        .progress-bar-container {
            width: 100%;
            background-color: #e2e8f0;
            border-radius: 0.375rem;
            height: 10px;
            margin-bottom: 0.25rem;
        }

        .progress-bar {
            background-color: #48bb78;
            height: 10px;
            border-radius: 0.375rem;
        }

        /* Updated action buttons styling for alignment */
        .action-buttons {
            display: flex;
            gap: 0.5rem;
            align-items: center;
        }

        .action-buttons a,
        .action-buttons form {
            margin: 0;
        }

        .action-buttons form {
            display: inline-block;
        }

        .action-buttons a {
            padding: 0.5rem 1rem;
            border-radius: 0.375rem;
            font-size: 0.875rem;
            text-decoration: none;
            color: white;
            white-space: nowrap; /* prevent wrapping */
        }

        .btn-view {
            background-color: #3182ce;
        }

        .btn-view:hover {
            background-color: #2b6cb0;
        }

        .btn-edit {
            background-color: #ecc94b;
        }

        .btn-edit:hover {
            background-color: #d69e2e;
        }

        .btn-delete {
            background-color: #e53e3e;
            padding: 0.5rem 1rem;
            border-radius: 0.375rem;
            font-size: 0.875rem;
            border: none;
            cursor: pointer;
            color: white;
        }

        .btn-delete:hover {
            background-color: #c53030;
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
