<x-app-layout>
    <div class="container">
        <h1 class="page-title">Create New Event</h1>

        @if ($errors->any())
            <div class="alert-error">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('events.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="title" class="form-label">Title*</label>
                <input type="text" name="title" id="title" class="form-input" value="{{ old('title') }}" required>
            </div>

            <div class="form-group">
                <label for="description" class="form-label">Description</label>
                <textarea name="description" id="description" class="form-input">{{ old('description') }}</textarea>
            </div>

            <div class="form-group">
                <label for="start_date" class="form-label">Start Date*</label>
                <input type="date" name="start_date" id="start_date" class="form-input" value="{{ old('start_date') }}" required>
            </div>

            <div class="form-group">
                <label for="end_date" class="form-label">End Date*</label>
                <input type="date" name="end_date" id="end_date" class="form-input" value="{{ old('end_date') }}" required>
            </div>

            <div class="form-group">
                <label for="status" class="form-label">Status*</label>
                <select name="status" id="status" class="form-select" required>
                    <option value="pending" {{ old('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Active</option>
                    <option value="completed" {{ old('status') == 'completed' ? 'selected' : '' }}>Completed</option>
                </select>
            </div>

            <div class="form-group">
                <label for="collaborators" class="form-label">Assign Collaborators</label>
                <select name="collaborators[]" id="collaborators" class="form-select" multiple>
                    @foreach($collaborators as $collaborator)
                        <option value="{{ $collaborator->id }}" {{ (collect(old('collaborators'))->contains($collaborator->id)) ? 'selected' : '' }}>
                            {{ $collaborator->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="btn-submit">Create Event</button>
            <a href="{{ route('events.index') }}" class="btn-cancel">Cancel</a>
        </form>
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

        .form-input, .form-select {
            width: 100%;
            padding: 0.75rem;
            border: 1px solid #e2e8f0;
            border-radius: 0.375rem;
            font-size: 1rem;
            color: #2d3748;
            transition: border-color 0.3s;
        }

        .form-input:focus, .form-select:focus {
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
