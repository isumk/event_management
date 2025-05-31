<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\DashboardController;

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
    Route::resource('tasks', TaskController::class);
});

// Collaborator routes (read-only tasks)
Route::middleware(['auth', 'role:Collaborator'])->group(function () {
    Route::get('tasks', [TaskController::class, 'index'])->name('tasks.index');
});

require __DIR__.'/auth.php';
