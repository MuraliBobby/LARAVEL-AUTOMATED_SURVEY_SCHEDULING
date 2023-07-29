<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Login;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Models\time_frequnecy;
use Illuminate\Support\Carbon;


class LogUserLogin
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(Login $event): void
    {
        //

        $user = $event->user;

        // Create a new TimeFrequencyDetail record with the current login time
        info('User logged in: ' . $user->id);
        $currentTime = date('H:i:s');

        time_frequnecy::create([
            'user_id' => $user->id,
            'frequent_login_time' => $currentTime,
            'frequent_logout_time' => $currentTime,
        ]);
    }
}
