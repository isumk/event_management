<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Message;
use Illuminate\Http\Request;
use App\Events\MessageSent;

class ChatController extends Controller
{
    public function show(Event $event)
    {
        return view('chat', compact('event'));
    }

    // Store new message and broadcast
    public function store(Request $request, $eventId)
    {
        $request->validate([
            'message' => 'required|string|max:255',
         ]);

         $message = Message::create([
            'user_id' => auth()->id(),
            'event_id' => $eventId,
            'message' => $request->message,
            ]);

        broadcast(new MessageSent($message))->toOthers();

        return response()->json($message->load('user'));
    }

    public function index($eventId)
    {
        $messages = Message::with('user')->where('event_id', $eventId)->orderBy('created_at')->get();
        return response()->json($messages);
    }
}
