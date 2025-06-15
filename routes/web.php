<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ChatController;

Route::middleware('auth')->get('/events/{event}/gantt', [EventController::class, 'showGantt'])->name('events.gantt');
Route::get('/events/{event}/chat', [ChatController::class, 'show'])->name('events.chat')->middleware('auth');


Route::get('/', function () {
    return redirect()->route('login');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Admin and Event Manager routes
Route::middleware(['auth', 'role:Admin,Event Manager'])->group(function () {
    Route::resource('events', EventController::class);
    Route::resource('tasks', TaskController::class)->except(['index']);
});

// Collaborator routes (read-only tasks)
// Allow all authenticated users (Admin, Event Manager, Collaborator) access to tasks index
Route::middleware(['auth'])->group(function () {
    Route::get('tasks', [TaskController::class, 'index'])->name('tasks.index');
});
// Authenticated users (including collaborators) can update tasks (for toggling status)
Route::middleware(['auth'])->group(function () {
    Route::put('tasks/{task}', [TaskController::class, 'update'])->name('tasks.update');
});


Route::middleware(['auth'])->group(function () {
    Route::get('/events/{event}/chat', [ChatController::class, 'show'])->name('events.chat');
});
use App\Http\Controllers\UserController;

Route::middleware(['auth', 'role:Admin'])->group(function () {
    Route::resource('users', UserController::class);
});

Route::middleware(['auth', 'role:Collaborator'])->group(function () {
    Route::get('collaborator/events', [EventController::class, 'collaboratorEvents'])->name('collaborator.events');
});



require __DIR__.'/auth.php';
require __DIR__.'/api.php';  // This should load routes/api.php

