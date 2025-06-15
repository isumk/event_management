<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EventController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if (in_array($user->role->name, ['Admin', 'Event Manager'])) {
            $events = Event::all();
        } else {
            $events = Event::where('created_by', $user->id)->get();
        }

        return view('events.index', compact('events'));
    }

    public function create()
    {
        // Load collaborators (users with Collaborator role) for the multi-select
        $collaborators = User::whereHas('role', fn($q) => $q->where('name', 'Collaborator'))->get();

        return view('events.create', compact('collaborators'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'status' => 'required|string',
            'collaborators' => 'nullable|array',
            'collaborators.*' => 'exists:users,id',
        ]);

        $event = Event::create([
            'title' => $request->title,
            'description' => $request->description,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'status' => $request->status,
            'created_by' => Auth::id(),
        ]);

        // Sync collaborators
        $event->collaborators()->sync($request->input('collaborators', []));

        return redirect()->route('events.index')->with('success', 'Event created successfully.');
    }

    public function show(Event $event)
    {
        return view('events.show', compact('event'));
    }

    public function edit(Event $event)
    {
        // Load collaborators and selected collaborators for the event
        $collaborators = User::whereHas('role', fn($q) => $q->where('name', 'Collaborator'))->get();
        $selectedCollaborators = $event->collaborators()->pluck('user_id')->toArray();

        return view('events.edit', compact('event', 'collaborators', 'selectedCollaborators'));
    }

    public function update(Request $request, Event $event)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'status' => 'required|string',
            'collaborators' => 'nullable|array',
            'collaborators.*' => 'exists:users,id',
        ]);

        $event->update($request->only([
            'title', 'description', 'start_date', 'end_date', 'status',
        ]));

        // Sync collaborators
        $event->collaborators()->sync($request->input('collaborators', []));

        return redirect()->route('events.index')->with('success', 'Event updated successfully.');
    }

    public function destroy(Event $event)
    {
        $event->delete();

        return redirect()->route('events.index')->with('success', 'Event deleted successfully.');
    }
    public function collaboratorEvents()
    {
      $user = Auth::user();

       // Get events that have tasks assigned to this collaborator
       $eventIds = $user->assignedTasks()->pluck('event_id')->unique();

      $events = Event::whereIn('id', $eventIds)->get();

     return view('events.collaborator_index', compact('events'));
    }

    public function showGantt(\App\Models\Event $event)
{
    $tasks = $event->tasks()->get();

    $ganttTasks = $tasks->map(function ($task) {
        return [
            'id' => (string) $task->id,
            'name' => $task->description,
            'start' => $task->start_date ? $task->start_date->format('Y-m-d') : $task->created_at->format('Y-m-d'),
            'end' => $task->due_date ? $task->due_date->format('Y-m-d') : ($task->start_date ? $task->start_date->format('Y-m-d') : $task->created_at->format('Y-m-d')),
            'progress' => $task->status === 'completed' ? 100 : ($task->status === 'in_progress' ? 50 : 0),
            'dependencies' => '',
        ];
    });

    return view('events.gantt', [
        'event' => $event,
        'tasksJson' => $ganttTasks->toJson(),
    ]);
}




}
