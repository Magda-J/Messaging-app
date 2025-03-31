<?php

namespace App\Http\Controllers;

use App\Events\MessageSent;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    public function sendMessage(Request $request)
    {
        $request->validate([
            'receiver_id' => 'required|exists:users,id',
            'content' => 'required|string'
        ]);

        $message = Message::create([
            'sender_id' => Auth::id(),
            'receiver_id' => $request->receiver_id,
            'content' => $request->content,
            'status' => 'pending'
        ]);

        broadcast(new MessageSent($message))->toOthers();

        return response()->json(['message' => 'Message sent successfully']);
    }

    public function completeMessage($id)
    {
        $message = Message::findOrFail($id);
        $message->update(['status' => 'completed']);

        broadcast(new MessageSent($message))->toOthers();

        return response()->json(['message' => 'Message completed']);
    }
}
