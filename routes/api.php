<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\EventController;

Route::middleware('auth:sanctum')->group(function () {
    // Gantt chart tasks data API
    Route::get('/events/{eventId}/tasks/gantt', [EventController::class, 'tasksForGantt']);

    // Chat messages API
    Route::get('/events/{eventId}/messages', [ChatController::class, 'index']);
    Route::post('/events/{eventId}/messages', [ChatController::class, 'store']);
});
