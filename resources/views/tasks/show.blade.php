<x-app-layout>
    <div class="container mx-auto px-6 py-8 max-w-3xl">
        <h1 class="text-3xl font-extrabold text-gray-900 mb-8">Task Details</h1>

        <div class="mb-6">
            <strong class="block font-semibold text-gray-700">Description:</strong>
            <p class="text-lg text-gray-800">{{ $task->description }}</p>
        </div>

        <div class="mb-6">
            <strong class="block font-semibold text-gray-700">Event:</strong>
            <p class="text-lg text-gray-800">{{ $task->event->title }}</p>
        </div>

        <div class="mb-6">
            <strong class="block font-semibold text-gray-700">Assigned To:</strong>
            <p class="text-lg text-gray-800">{{ $task->assignedUser->name }}</p>
        </div>

        <div class="mb-6">
            <strong class="block font-semibold text-gray-700">Status:</strong>
            <p class="text-lg text-gray-800">{{ ucfirst($task->status) }}</p>
        </div>

        <div class="mb-6">
            <strong class="block font-semibold text-gray-700">Start Date:</strong>
            <p class="text-lg text-gray-800">{{ $task->start_date ? $task->start_date->format('F d, Y') : '-' }}</p>
        </div>

        <div class="mb-6">
            <strong class="block font-semibold text-gray-700">Due Date:</strong>
            <p class="text-lg text-gray-800">{{ $task->due_date ? $task->due_date->format('F d, Y') : '-' }}</p>
        </div>

        <a href="{{ route('tasks.index') }}" class="inline-block mt-6 px-6 py-3 bg-blue-600 text-black rounded-lg hover:bg-blue-700 transition duration-300">
            Back to Tasks
        </a>
    </div>

    <!-- Internal CSS -->
    <style>
        .container {
            padding: 2rem;
            max-width: 800px;
            margin: 0 auto;
        }

        .text-lg {
            font-size: 1.125rem;
        }

        .page-title {
            font-size: 2.5rem;
            font-weight: bold;
            color: #2d3748;
            margin-bottom: 1.5rem;
        }

        .form-label {
            font-size: 1rem;
            font-weight: 600;
            color: #2d3748;
            margin-bottom: 0.5rem;
            display: block;
        }

        .btn-submit {
            background-color: #3182ce;
            color: rgba(18, 8, 215, 0.611)55, 255, 255);
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
            background-color: #117aea;
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
