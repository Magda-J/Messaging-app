<?php


namespace App\Http\Controllers;

use App\Events\MessageApproved;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminDashboardController extends Controller
{
    public function index()
    {
     
        if (!Auth::user() || !Auth::user()->is_admin) {
            return redirect('/')->with('error', 'Unauthorized');
        }


        $messages = Message::where('status', 'pending')->get();

        return view('admin.dashboard', compact('messages'));
    }

    public function approveMessage($id)
    {
        $message = Message::findOrFail($id);

        if (!Auth::user() || !Auth::user()->is_admin) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $message->update(['status' => 'completed']);


        broadcast(new MessageApproved($message))->toOthers();

        return back()->with('success', 'Message approved successfully!');
    }
}


