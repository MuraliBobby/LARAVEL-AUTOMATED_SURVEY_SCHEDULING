<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\time_frequnecy;
use App\Models\User;
use App\Models\optimalTime;
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
        $users = User::all();


        foreach ($users as $user) {
            $emailAddress = $user->email;
            $userId = $user->id;
    
            // Step 2: Retrieve frequent login and logout times for the user
            $records = time_frequnecy::where('email', $emailAddress)
                ->get(['frequent_login_time', 'frequent_logout_time']);
    
            // Step 3: Retrieve the preference details for the user
            $preference = availability::where('user_id', $userId)->get(['from_time', 'to_time']);
            $preferenceArray = $preference->toArray();
    
            // Convert the records to a 2D array of DateTime objects
            $dateTimeArray = [];
            foreach ($records as $record) {
                $loginTime = new Carbon($record->frequent_login_time);
                $logoutTime = new Carbon($record->frequent_logout_time);
                $dateTimeArray[] = [$loginTime, $logoutTime];
            }
    
            // Step 4: Calculate and save the optimal time for the user
            $optimalTime = $this->calculateOptimalTime($dateTimeArray, $preferenceArray);
    
            // Save the optimal time for the user in a separate database table

            OptimalTime::updateOrCreate(
                ['email' => $user->email], // Update or create based on the 'email' column
                ['optimal_time' => $optimalTime] // Update 'optimal_time' column
            );
            
            // optimalTime::create([
            //     'optimal_time'=>$optimalTime,
            //     'email'=>$user->email,       
            // ]);

            
    
            // Display the optimal time for the user in the console
            $this->info("Optimal Time for User {$user->name} (ID: {$user->email}): " . $optimalTime->format('H:i:s'));
        }
    

    
    }

    function calculateOptimalTime(array $frequentSessionTime, array $preferredSessionTime) {
        if (count($frequentSessionTime) === 1) {
            return $preferredSessionTime[0][0]->format('H:i:s');
        }
        $preferredRange = [];
        
        

        $preferredLoginTime = new \DateTime($preferredSessionTime[0]['from_time']);
        $preferredLogoutTime = new \DateTime($preferredSessionTime[0]['to_time']);

        // $preferredLoginTime = \DateTime::createFromFormat('H:i:s', '12:30:00');
        // $preferredLogoutTime = \DateTime::createFromFormat('H:i:s', '13:40:00');
    
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

        if ($optimalStartTime === null || $optimalEndTime === null) {
            // Return a default time, or handle the case as needed
            return new \DateTime(); // For example, returning the current time as default
        }

    
        $optimalTimeInSeconds = ($optimalStartTime->getTimestamp() + $optimalEndTime->getTimestamp()) / 2;
        $optimalTime = new \DateTime();
        $optimalTime->setTimestamp($optimalTimeInSeconds);
        return $optimalTimeInSeconds;
    }  
    
}
