<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Auth;
use App\Models\availability;
use Illuminate\Support\Carbon;

class SendSurveyCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:send-survey-command';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        //
        $currentTime = now();
        $users = availability::whereBetween('from_time', [$currentTime, $currentTime->addMinutes(30)])
        ->orWhereBetween('to_time', [$currentTime, $currentTime->addMinutes(30)])
        ->get();

        foreach ($users as $user) {
            // Implement your survey link sending logic here
            // For example, you can save the survey link in a table associated with the user
            // Or send an email or notification to the user with the survey link
        }

        
    }
}
