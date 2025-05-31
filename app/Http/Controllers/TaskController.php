<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\Event;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if (in_array($user->role->name, ['Admin', 'Event Manager'])) {
            $tasks = Task::with('event', 'assignedUser')->get();
        } else {
            $tasks = $user->assignedTasks()->with('event')->get();
        }

        return view('tasks.index', compact('tasks'));
    }

    public function create()
    {
        $events = Event::all();
        $users = User::all();

        return view('tasks.create', compact('events', 'users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'event_id' => 'required|exists:events,id',
            'assigned_to' => 'required|exists:users,id',
            'description' => 'required|string',
            'status' => 'required|string',
            'start_date' => 'nullable|date',
            'due_date' => 'nullable|date|after_or_equal:start_date',
        ]);

        Task::create($request->all());

        return redirect()->route('tasks.index')->with('success', 'Task created successfully.');
    }

    public function show(Task $task)
    {
        return view('tasks.show', compact('task'));
    }

    public function edit(Task $task)
    {
        $events = Event::all();
        $users = User::all();

        return view('tasks.edit', compact('task', 'events', 'users'));
    }

    public function update(Request $request, Task $task)
    {
        $request->validate([
            'event_id' => 'required|exists:events,id',
            'assigned_to' => 'required|exists:users,id',
            'description' => 'required|string',
            'status' => 'required|string',
            'start_date' => 'nullable|date',
            'due_date' => 'nullable|date|after_or_equal:start_date',
        ]);

        $task->update($request->all());

        return redirect()->route('tasks.index')->with('success', 'Task updated successfully.');
    }

    public function destroy(Task $task)
    {
        $task->delete();

        return redirect()->route('tasks.index')->with('success', 'Task deleted successfully.');
    }
}
