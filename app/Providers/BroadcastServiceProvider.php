<?php

namespace App\Providers;

use Illuminate\Broadcasting\BroadcastServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Broadcast;

class BroadcastServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Broadcast::routes();

        /*
         * Here you may register any custom channel authorization callbacks.
         *
         * Broadcast::channel('channel-name', function ($user, $id) {
         *     return (int) $user->id === (int) $id;
         * });
         */
    }
}
