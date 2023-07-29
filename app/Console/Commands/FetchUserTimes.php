<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\time_frequnecy;
use App\Models\availability;
use Illuminate\Support\Carbon;

class FetchUserTimes extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fetch:user-times';

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
        $emailAddress = 'muku@gmail.com'; // Replace this with the email address you want to query
        $user_id = 23;
        // Retrieve all records for the specified email address
        $records = time_frequnecy::where('email', $emailAddress)
                        ->get(['frequent_login_time', 'frequent_logout_time']);

        // $preference = availability::where('user_id',$user_id)->get(['from_time','to_time']); 
        // $preferenceArray = $preference->pluck('from_time', 'to_time')->toArray(); 
        $preferenceArray[] = array('12:30:00', '13:40:00');
        // Convert the records to a 2D array of DateTime objects
        $dateTimeArray = [];
        foreach ($records as $record) {
            $loginTime = new Carbon($record->frequent_login_time);
            $logoutTime = new Carbon($record->frequent_logout_time);
            $dateTimeArray[] = [$loginTime, $logoutTime];
        }

        // Display the output in the console
        $this->info('User Times:');
        $this->table(['Frequent Login Time', 'Frequent Logout Time'], $dateTimeArray);

        $optimalTime = $this->calculateOptimalTime( $dateTimeArray, $preferenceArray);
        $this->info("Optimal Time in seconds: " . $optimalTime); 
        $this->info("Optimal Time in date format: ". date('Y-m-d H:i:s',$optimalTime));
    }

    function calculateOptimalTime(array $frequentSessionTime, array $preferredSessionTime) {
        if (count($frequentSessionTime) === 1) {
            return $preferredSessionTime[0]->format('H:i:s');
        }
        $preferredRange = [];
    
        $preferredLoginTime = \DateTime::createFromFormat('H:i:s', '12:30:00');
        $preferredLogoutTime = \DateTime::createFromFormat('H:i:s', '13:40:00');
    
        foreach ($frequentSessionTime as $sessionTime) {
            $currentSessionLoginTime = $sessionTime[0];
            $currentSessionLogoutTime = $sessionTime[1];
    
            if ($preferredLoginTime->format('H:i:s') < $currentSessionLoginTime->format('H:i:s')
                    && $preferredLogoutTime->format('H:i:s') > $currentSessionLogoutTime->format('H:i:s')) {
                $preferredRange[] = $sessionTime;
            }
        }
        return $this->findOptimalTimeFromPreferredRange($preferredRange);
    }
    
    function findOptimalTimeFromPreferredRange(array $preferredRange) {
        $optimalStartTime = null;
        $optimalEndTime = null;
    
        foreach ($preferredRange as $sessionTime) {
            $loginTime = $sessionTime[0];
            $logoutTime = $sessionTime[1];
    
            if ($optimalStartTime === null || $loginTime < $optimalStartTime && $loginTime!=null) {
                $optimalStartTime = $loginTime;
            }
    
            if ($optimalEndTime === null || $logoutTime > $optimalEndTime && $logoutTime!=null ) {
                $optimalEndTime = $logoutTime;
            }
        }
    
        $optimalTimeInSeconds = ($optimalStartTime->getTimestamp() + $optimalEndTime->getTimestamp()) / 2;
        $optimalTime = new \DateTime();
        $optimalTime->setTimestamp($optimalTimeInSeconds);
        return $optimalTimeInSeconds;
    }  
    
}
