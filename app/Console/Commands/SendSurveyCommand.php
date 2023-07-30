<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\availability;
use App\Models\survey;
use Illuminate\Support\Carbon;
class SendSurveyCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send:survey';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Schedule Survey to user';

    /**
     * Execute the console command.
     */
    

    
     public function handle()
{
    $currentTime = Carbon::now();
    $currentTimeFormatted = Carbon::now();
    // Format to 'HH:mm:ss'

    // Get the end time (current time + 30 minutes)
    $endTime = $currentTime->copy()->addMinutes(30);
    $endTimeFormatted = $currentTime = Carbon::now();


    // Retrieve the availability records for users whose from_time or to_time is within the next 30 minutes
    // $availabilities = Availability::where(function ($query) use ($currentTimeFormatted, $endTimeFormatted) {
    //     $query->whereBetween('from_time', [$currentTimeFormatted, $endTimeFormatted])
    //         ->orWhereBetween('to_time', [$currentTimeFormatted, $endTimeFormatted]);
    // })->get();

    $currentTime = Carbon::now();
    $currentTime = $currentTime->setTimezone('Asia/Kolkata'); ;
    $availabilities = availability::where(function ($query) use ($currentTime) {
        $query->where('from_time', '<=', $currentTime)
              ->where('to_time', '>=', $currentTime);
             
    })->get();

    // $availabilities = availability::where('from_time', '<=', $currentTime)
    // ->where('to_time', '>=', $currentTime)
    // ->with('user_id') // Eager load the associated user to avoid N+1 queries
    // ->get()
    // ->pluck('user_id'); // Get only the 'user' relationship from the Availability model

    // // foreach ($availabilities as $availability) {
    // //     echo "User ID: " . $availability->user_id . PHP_EOL;
    // //     echo "From Time: " . $availability->from_time . PHP_EOL;
    // //     echo "To Time: " . $availability->to_time . PHP_EOL;
    // //     echo "Survey Link: " . $availability->survey . PHP_EOL;
    // //     echo "Survey Link: " . $availability->email . PHP_EOL;
    // //     echo PHP_EOL;
    // // }

    //     echo "Cueernt: " . $currentTime . PHP_EOL;
    // Iterate through the availability records and update the survey link for available users

    foreach ($availabilities as $availability) {
        // Generate the survey link (replace this with your logic to generate the link)
        $surveyLink = 'https://example.com/survey';
    
        // Update the survey column for the availability record
        availability::where('user_id',$availability->user_id)->update(['survey_link' => $surveyLink]);
    }
    // foreach ($availabilities as $availability) {
    //     // Convert the string times to Carbon instances
    //     $fromTime = Carbon::parse($availability->from_time);
    //     $toTime = Carbon::parse($availability->to_time);

    //     // Check if the user is available at any point in the next 30 minutes
    //     if ($currentTime->between($fromTime, $toTime) || $endTime->between($fromTime, $toTime)) {
    //         // Generate the survey link (replace this with your logic to generate the link)
    //         $surveyLink = 'https://example.com/survey';

    //         // Update the survey_link column for the availability record
    //         $availability->update(['survey_link' => $surveyLink]);

    //         // If you also want to add the survey link to the survey table, you can do it here
    //         survey::updateOrCreate(['user_id' => $availability->user_id], ['survey_link' => $surveyLink]);
    //     }
    // }
}
}
