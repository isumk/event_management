<x-app-layout>
    <div class="container">
        <h1 class="page-title">{{ $event->title }}</h1>

        <a href="{{ route('events.gantt', $event) }}" class="btn-primary gantt-link" title="View Gantt Chart">
            <!-- Gantt chart icon -->
            <svg xmlns="http://www.w3.org/2000/svg" class="icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <rect x="3" y="4" width="18" height="4" rx="1" ry="1"></rect>
                <rect x="3" y="10" width="18" height="4" rx="1" ry="1"></rect>
                <rect x="3" y="16" width="10" height="4" rx="1" ry="1"></rect>
            </svg>
            View Gantt Chart
        </a>

        <div class="section">
            <strong>Description:</strong>
            <p class="description">{{ $event->description }}</p>
        </div>

        <div class="grid-two-cols section">
            <div>
                <strong><svg class="icon-small" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="12" cy="12" r="10"></circle>
                    <polyline points="12 6 12 12 16 14"></polyline>
                </svg> Start Date:</strong>
                <p>{{ $event->start_date->format('F d, Y') }}</p>
            </div>
            <div>
                <strong><svg class="icon-small" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="12" cy="12" r="10"></circle>
                    <polyline points="12 8 12 12 16 14"></polyline>
                </svg> End Date:</strong>
                <p>{{ $event->end_date->format('F d, Y') }}</p>
            </div>
        </div>

        <div class="section">
            <strong><svg class="icon-small" viewBox="0 0 24 24" fill="none" stroke="#4a5568" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <circle cx="12" cy="12" r="10"></circle>
                <line x1="12" y1="16" x2="12" y2="12"></line>
                <line x1="12" y1="8" x2="12" y2="8"></line>
            </svg> Status:</strong>
            <p>{{ ucfirst($event->status) }}</p>
        </div>

        <div class="section">
            <h2>Progress</h2>
            <div class="progress-bar">
                <div class="progress-fill" style="width: {{ $event->progress() }}%;"></div>
            </div>
            <p class="progress-text">{{ $event->progress() }}% of tasks completed</p>
        </div>

        <div class="section">
            <h2>Collaborators</h2>
            <ul class="collaborators-list">
                @foreach ($event->tasks()->with('assignedUser')->get()->pluck('assignedUser')->unique() as $user)
                    @if($user)
                        <li>
                            <svg class="icon-small" viewBox="0 0 24 24" fill="none" stroke="#4a5568" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M20 21v-2a4 4 0 0 0-3-3.87"></path>
                                <path d="M4 21v-2a4 4 0 0 1 3-3.87"></path>
                                <circle cx="12" cy="7" r="4"></circle>
                            </svg>
                            {{ $user->name }}
                        </li>
                    @endif
                @endforeach
            </ul>
        </div>

        @php
            $userId = auth()->id();
            $progress = $event->progressForCollaborator($userId);
        @endphp

        <div class="section">
            <h2>Your Progress</h2>
            <div class="progress-bar">
                <div class="progress-fill" style="width: {{ $progress }}%;"></div>
            </div>
            <p>{{ $progress }}% of your assigned tasks completed</p>
        </div>

        <a href="{{ route('events.index') }}" class="btn-primary btn-back" title="Back to Events">Back to Events</a>
    </div>

    <style>
        /* Container */
        .container {
            max-width: 720px;
            margin: 2rem auto;
            padding: 1rem 2rem;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: #2d3748;
            background: #fff;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            border-radius: 12px;
        }

        /* Page title */
        .page-title {
            font-size: 2.8rem;
            font-weight: 700;
            margin-bottom: 1.5rem;
            color: #1a202c;
            letter-spacing: -0.02em;
        }

        /* Buttons */
        .btn-primary {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            background-color: #3182ce;
            color: #fff;
            padding: 0.65rem 1.4rem;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 600;
            font-size: 1.05rem;
            transition: background-color 0.3s ease;
            box-shadow: 0 4px 8px rgba(49,130,206,0.3);
            user-select: none;
        }
        .btn-primary:hover,
        .btn-primary:focus {
            background-color: #2c5282;
            box-shadow: 0 6px 12px rgba(44,82,130,0.5);
        }
        .btn-back {
            margin-top: 2rem;
            padding-left: 2rem;
            padding-right: 2rem;
        }

        /* Section spacing */
        .section {
            margin-bottom: 2rem;
        }

        /* Strong labels */
        strong {
            font-weight: 700;
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
            font-size: 1.1rem;
            color: #4a5568;
            margin-bottom: 0.4rem;
        }

        /* Description paragraph */
        .description {
            white-space: pre-line;
            font-size: 1.05rem;
            line-height: 1.5;
            color: #4a5568;
            margin-top: 0.3rem;
        }

        /* Grid for dates */
        .grid-two-cols {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 1.5rem;
        }

        /* Text paragraphs under labels */
        p {
            margin: 0.3rem 0 0 0;
            font-size: 1.05rem;
            color: #2d3748;
        }

        /* Icons */
        .icon {
            width: 20px;
            height: 20px;
        }
        .icon-small {
            width: 16px;
            height: 16px;
        }

        /* Progress bar */
        .progress-bar {
            width: 100%;
            background-color: #e2e8f0;
            border-radius: 12px;
            overflow: hidden;
            height: 24px;
            box-shadow: inset 0 1px 3px rgba(0,0,0,0.1);
        }
        .progress-fill {
            height: 100%;
            background-color: #48bb78;
            border-radius: 12px 0 0 12px;
            transition: width 0.5s ease-in-out;
        }
        .progress-text {
            margin-top: 0.5rem;
            font-size: 0.9rem;
            color: #718096;
            font-style: italic;
        }

        /* Collaborators list */
        .collaborators-list {
            list-style: none;
            padding-left: 0;
            color: #2d3748;
        }
        .collaborators-list li {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 1.05rem;
            margin-bottom: 0.35rem;
        }
    </style>
</x-app-layout>
