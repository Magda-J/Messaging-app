<?php

use Illuminate\Support\Facades\Broadcast;
use Illuminate\Support\Facades\Auth;

Broadcast::channel('private-messages.{receiverId}', function ($user, $receiverId) {
    return (int) $user->id === (int) $receiverId;
});


Broadcast::channel('messages.{receiverId}', function ($user, $receiverId) {
    return (int) $user->id === (int) $receiverId;
});
