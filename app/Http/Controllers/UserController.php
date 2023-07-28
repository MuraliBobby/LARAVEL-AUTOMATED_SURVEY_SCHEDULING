<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\availability;
use App\Models\preference;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;

class UserController extends Controller
{
    //

    public function display(){
        return view('UserDetails');
    }
    
    public function storeDetails(Request $request){

        $user = Auth::user();
        $data = $request->validate([
            'from_time'=> 'required|date_format:H:i',
            'to_time'=> 'required|date_format:H:i|after:from_time',
            'preferences'=> 'required|nullable',
            'preferences.*'=> 'string|distinct'
        ]);

        availability::create([
            'user_id' => $user->id,
            'from_time' => $data['from_time'],
            'to_time' => $data['to_time']
        ]);

        
        // if ($data['preferences']) {
        //     foreach ($data['preferences'] as $category) {
        //         preference::create([
        //             'user_id' => $user->id,
        //             'preferences' => $category 
        //         ]);
        //     }
        // }

        $preferencesString = implode(',', $data['preferences']);
        preference::create([
            'user_id' => $user->id,
            'preferences' => $preferencesString,
        ]);
        
        // if ($data['preferences']) {
        //     // Save all selected preferences for the user
        //     $preferencesToSave = [];
        //     foreach ($data['preferences'] as $preference) {
        //         $preferencesToSave[] = [
        //             'user_id' => $user->id,
        //             'preferences' => $preference,
        //         ];
        //     }
        //     preference::insert($preferencesToSave);
        // }
        
        // Auth::login($user);
        return redirect()->route('dashboard');
    
    }

    

}
