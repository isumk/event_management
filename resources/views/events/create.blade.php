<x-app-layout>

<div class="container">
    <h1>Create New Event</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('events.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="title" class="form-label">Title*</label>
            <input type="text" name="title" id="title" class="form-control" value="{{ old('title') }}" required>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea name="description" id="description" class="form-control">{{ old('description') }}</textarea>
        </div>

        <div class="mb-3">
            <label for="start_date" class="form-label">Start Date*</label>
            <input type="date" name="start_date" id="start_date" class="form-control" value="{{ old('start_date') }}" required>
        </div>

        <div class="mb-3">
            <label for="end_date" class="form-label">End Date*</label>
            <input type="date" name="end_date" id="end_date" class="form-control" value="{{ old('end_date') }}" required>
        </div>

        <div class="mb-3">
            <label for="status" class="form-label">Status*</label>
            <select name="status" id="status" class="form-select" required>
                <option value="pending" {{ old('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Active</option>
                <option value="completed" {{ old('status') == 'completed' ? 'selected' : '' }}>Completed</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Create Event</button>
        <a href="{{ route('events.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
</x-app-layout>
