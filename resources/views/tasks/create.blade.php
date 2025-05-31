<x-app-layout>

<div class="container">
    <h1>Create Task</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('tasks.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="event_id" class="form-label">Event*</label>
            <select name="event_id" id="event_id" class="form-select" required>
                <option value="">Select Event</option>
                @foreach($events as $event)
                    <option value="{{ $event->id }}" {{ old('event_id') == $event->id ? 'selected' : '' }}>{{ $event->title }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="assigned_to" class="form-label">Assign To*</label>
            <select name="assigned_to" id="assigned_to" class="form-select" required>
                <option value="">Select User</option>
                @foreach($users as $user)
                    <option value="{{ $user->id }}" {{ old('assigned_to') == $user->id ? 'selected' : '' }}>{{ $user->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Description*</label>
            <textarea name="description" id="description" class="form-control" required>{{ old('description') }}</textarea>
        </div>

        <div class="mb-3">
            <label for="status" class="form-label">Status*</label>
            <select name="status" id="status" class="form-select" required>
                <option value="pending" {{ old('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="in_progress" {{ old('status') == 'in_progress' ? 'selected' : '' }}>In Progress</option>
                <option value="completed" {{ old('status') == 'completed' ? 'selected' : '' }}>Completed</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="start_date" class="form-label">Start Date</label>
            <input type="date" name="start_date" id="start_date" class="form-control" value="{{ old('start_date') }}">
        </div>

        <div class="mb-3">
            <label for="due_date" class="form-label">Due Date</label>
            <input type="date" name="due_date" id="due_date" class="form-control" value="{{ old('due_date') }}">
        </div>

        <button type="submit" class="btn btn-primary">Create Task</button>
        <a href="{{ route('tasks.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
</x-app-layout>

