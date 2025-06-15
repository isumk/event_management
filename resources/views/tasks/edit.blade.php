<x-app-layout>
    <div class="container">
        <h1 class="page-title">Edit Task</h1>

        @if ($errors->any())
            <div class="alert-error mb-6">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('tasks.update', $task) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="event_id" class="form-label">Event*</label>
                <select name="event_id" id="event_id" class="form-select" required>
                    @foreach($events as $event)
                        <option value="{{ $event->id }}" {{ old('event_id', $task->event_id) == $event->id ? 'selected' : '' }}>{{ $event->title }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="assigned_to" class="form-label">Assign To*</label>
                <select name="assigned_to" id="assigned_to" class="form-select" required>
                    @foreach($users as $user)
                        <option value="{{ $user->id }}" {{ old('assigned_to', $task->assigned_to) == $user->id ? 'selected' : '' }}>{{ $user->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="description" class="form-label">Description*</label>
                <textarea name="description" id="description" class="form-input" required>{{ old('description', $task->description) }}</textarea>
            </div>

            <div class="form-group">
                <label for="status" class="form-label">Status*</label>
                <select name="status" id="status" class="form-select" required>
                    <option value="pending" {{ old('status', $task->status) == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="in_progress" {{ old('status', $task->status) == 'in_progress' ? 'selected' : '' }}>In Progress</option>
                    <option value="completed" {{ old('status', $task->status) == 'completed' ? 'selected' : '' }}>Completed</option>
                </select>
            </div>

            <div class="form-group">
                <label for="start_date" class="form-label">Start Date</label>
                <input type="date" name="start_date" id="start_date" class="form-input" value="{{ old('start_date', optional($task->start_date)->format('Y-m-d')) }}">
            </div>

            <div class="form-group">
                <label for="due_date" class="form-label">Due Date</label>
                <input type="date" name="due_date" id="due_date" class="form-input" value="{{ old('due_date', optional($task->due_date)->format('Y-m-d')) }}">
            </div>

            <div class="mt-6">
                <button type="submit" class="btn-submit">Update Task</button>
                <a href="{{ route('tasks.index') }}" class="btn-cancel">Cancel</a>
            </div>
        </form>
    </div>

    <!-- Internal CSS -->
    <style>
        .container {
            padding: 2rem;
            max-width: 800px;
            margin: 0 auto;
        }

        .page-title {
            font-size: 2.5rem;
            font-weight: bold;
            color: #2d3748;
            margin-bottom: 1.5rem;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-label {
            font-size: 1rem;
            font-weight: 600;
            color: #2d3748;
            margin-bottom: 0.5rem;
            display: block;
        }

        .form-select, .form-input {
            width: 100%;
            padding: 0.75rem;
            border: 1px solid #e2e8f0;
            border-radius: 0.375rem;
            font-size: 1rem;
            color: #2d3748;
            transition: border-color 0.3s ease;
        }

        .form-select:focus, .form-input:focus {
            border-color: #3182ce;
            outline: none;
        }

        .btn-submit {
            background-color: #3182ce;
            color: white;
            padding: 0.75rem 1.5rem;
            border-radius: 0.375rem;
            text-decoration: none;
            display: inline-block;
            font-size: 1rem;
            transition: background-color 0.3s;
        }

        .btn-submit:hover {
            background-color: #2b6cb0;
        }

        .btn-cancel {
            background-color: #e2e8f0;
            color: #2d3748;
            padding: 0.75rem 1.5rem;
            border-radius: 0.375rem;
            text-decoration: none;
            display: inline-block;
            font-size: 1rem;
            margin-left: 1rem;
            transition: background-color 0.3s;
        }

        .btn-cancel:hover {
            background-color: #cbd5e0;
        }

        .alert-error {
            background-color: #fbd5d5;
            color: #e53e3e;
            padding: 1rem;
            border-radius: 0.375rem;
            margin-bottom: 1.5rem;
        }
    </style>
</x-app-layout>
