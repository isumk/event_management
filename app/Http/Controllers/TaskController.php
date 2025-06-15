<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\Event;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Notifications\TaskAssignedNotification;

class TaskController extends Controller
{
    public function index()
    {
        $user = Auth::user();

     if (in_array($user->role->name, ['Admin', 'Event Manager'])) {
        $tasks = Task::with('event', 'assignedUser')->get();
     } elseif ($user->role->name === 'Collaborator') {
        $tasks = $user->assignedTasks()->with('event')->get();
     } else {
        abort(403, 'Unauthorized');
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
         $user = $request->user();

     // Validation rules
     $rules = [
        'description' => 'sometimes|required|string',
        'event_id' => 'sometimes|required|exists:events,id',
        'assigned_to' => 'sometimes|required|exists:users,id',
        'status' => 'sometimes|required|string|in:pending,in_progress,completed',
        'start_date' => 'sometimes|nullable|date',
        'due_date' => 'sometimes|nullable|date|after_or_equal:start_date',
      ];

      $validated = $request->validate($rules);

       // Check if user is collaborator and only allow status update
      if ($user->role->name === 'Collaborator') {
        // Collaborator can only update status and only for tasks assigned to them
        if ($task->assigned_to !== $user->id) {
            abort(403, 'Unauthorized');
        }

        if (isset($validated['status'])) {
            $task->status = $validated['status'];
            $task->save();

            return redirect()->route('tasks.index')->with('success', 'Task status updated.');
        }

         abort(400, 'Invalid request');
       }

        // For Admin and Event Manager: full update allowed
        $task->update($validated);

      return redirect()->route('tasks.index')->with('success', 'Task updated successfully.');
    }

    public function destroy(Task $task)
    {
        $task->delete();

        return redirect()->route('tasks.index')->with('success', 'Task deleted successfully.');
    }


}
