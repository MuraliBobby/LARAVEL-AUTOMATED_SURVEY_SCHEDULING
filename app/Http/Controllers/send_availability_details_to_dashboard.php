<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\availability;
class send_availability_details_to_dashboard extends Controller
{
    //
    public function sendDetails(){
        $user = Auth::user();
        $availabilities = availability::where('user_id',$user->id);

        return view('dashboard',[
            'availability' => $availabilities,
        ]);


    }
}
