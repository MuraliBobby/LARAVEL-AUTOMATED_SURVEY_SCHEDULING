<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Auth;
use App\Models\availability;
use Illuminate\Support\Carbon;

class IncrementTime extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'time:increment';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Increment from_time and to_time of users';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        //
        $user = Auth::user();

        $userAvailabilities = availability::all();

     
        foreach ($userAvailabilities as $availability) {
        
            $availability = availability::where('user_id', 21)->first();

            $fromTime = Carbon::createFromTimestamp($availability->from_time);
            $toTime = Carbon::createFromTimestamp($availability->to_time);

            // Increment the times by one minute
            $fromTime->addMinute();
            $toTime->addMinute();

            // Convert the Carbon instances back to Unix timestamps and update the database
            $availability->from_time = $fromTime->timestamp;
            $availability->to_time = $toTime->timestamp;

            availability::where('user_id', 21)->update(['from_time' => $fromTime]);
            availability::where('user_id', 21)->update(['to_time' => $toTime]);
        }

    }
}
