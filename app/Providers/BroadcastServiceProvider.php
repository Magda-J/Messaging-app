<?php

namespace App\Providers;

use Illuminate\Support\Facades\Broadcast;
use Illuminate\Support\ServiceProvider;

class BroadcastServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Broadcast::routes();

        Broadcast::channel('messages.{receiverId}', function ($user, $receiverId) {
            return (int) $user->id === (int) $receiverId;
        });

        require base_path('routes/channels.php');
    }
}
