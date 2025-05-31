<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Task;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Quick stats counts
        $activeEventsCount = Event::where('status', 'active')->count();
        $pendingTasksCount = Task::where('status', 'pending')->count();
        $collaboratorsCount = User::whereHas('role', function ($q) {
            $q->where('name', 'Collaborator');
        })->count();

        // Recent events and tasks based on role
        if (in_array($user->role->name, ['Admin', 'Event Manager'])) {
            $recentEvents = Event::latest()->take(5)->get();
            $recentTasks = Task::latest()->take(5)->get();
        } else {
            $recentEvents = Event::where('created_by', $user->id)->latest()->take(5)->get();
            $recentTasks = $user->assignedTasks()->latest()->take(5)->get();
        }

        return view('dashboard.index', compact(
            'activeEventsCount',
            'pendingTasksCount',
            'collaboratorsCount',
            'recentEvents',
            'recentTasks'
        ));
    }
}
