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
        $role = $user->role->name;

        $activeEventsCount = Event::where('status', 'active')->count();
        $pendingTasksCount = Task::where('status', 'pending')->count();
        $collaboratorsCount = User::whereHas('role', fn($q) => $q->where('name', 'Collaborator'))->count();
        $usersCount = User::count();

        if ($role === 'Admin' || $role === 'Event Manager') {
            $recentEvents = Event::latest()->take(5)->get();
            $recentTasks = Task::latest()->take(5)->get();

            return view('dashboard.index', compact(
                'role',
                'activeEventsCount',
                'pendingTasksCount',
                'collaboratorsCount',
                'usersCount',
                'recentEvents',
                'recentTasks'
            ));
        }

        // For Collaborator role
        $userEventsCount = $user->assignedTasks()->with('event')->get()->pluck('event')->unique('id')->count();
        $userTasksCount = $user->assignedTasks()->count();
        $userRecentEvents = Event::whereIn('id', $user->assignedTasks()->pluck('event_id'))->latest()->take(5)->get();
        $userRecentTasks = $user->assignedTasks()->latest()->take(5)->get();

        return view('dashboard.index', compact(
            'role',
            'userEventsCount',
            'userTasksCount',
            'userRecentEvents',
            'userRecentTasks'
        ));
    }
}
