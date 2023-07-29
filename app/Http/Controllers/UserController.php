<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\availability;
use App\Models\preference;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use App\Models\time_frequnecy;
use Illuminate\Support\Carbon;

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

        
       
        $preferencesString = implode(',', $data['preferences']);
        preference::create([
            'user_id' => $user->id,
            'preferences' => $preferencesString,
        ]);
    
        // Auth::login($user);
        return redirect()->route('dashboard');
    
    }

    

}
