<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Pusher\Pusher;
use Illuminate\Support\Facades\Auth;

class PusherController extends Controller
{
    public function authenticate(Request $request)
    {
        $user = Auth::user();
        
        if (!$user) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        $channelName = $request->channel_name;
        $socketId = $request->socket_id;

        $pusher = new Pusher(
            env('PUSHER_APP_KEY'),
            env('PUSHER_APP_SECRET'),
            env('PUSHER_APP_ID'),
            [
                'cluster' => env('PUSHER_APP_CLUSTER'),
                'useTLS' => true
            ]
        );

        $presenceData = [
            'user_id' => $user->id,
            'user_info' => [
                'name' => $user->name
            ]
        ];

        $auth = $pusher->presence_auth($channelName, $socketId, $user->id, $presenceData);

        return response($auth);
    }
}