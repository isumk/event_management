<?php

namespace App\Http\Controllers;

use App\Events\MessageSent;
use App\Models\Event;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    // Fetch messages for a specific event
    public function fetchMessages(Event $event)
    {
        $messages = Message::with('user')
            ->where('event_id', $event->id)
            ->orderBy('created_at', 'asc')
            ->get();

        return response()->json($messages);
    }

    // Send a new message and broadcast it
    public function sendMessage(Request $request, Event $event)
    {
        $request->validate([
            'message' => 'required|string',
        ]);

        $message = Message::create([
            'user_id' => Auth::id(),
            'event_id' => $event->id,
            'message' => $request->message,
        ]);

        // Load user relationship for broadcasting
        $message->load('user');

        // Broadcast the message event
        broadcast(new MessageSent($message))->toOthers();

        return response()->json($message);
    }
}
