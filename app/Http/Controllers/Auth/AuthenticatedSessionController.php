<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use App\Models\time_frequnecy;
use Illuminate\Support\Carbon;


class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        $user = Auth::user();

        // Create a new TimeFrequencyDetail record with the current login time
        date_default_timezone_set('Asia/Kolkata');
        $currentTime = Carbon::now()->toTimeString();

        // time_frequnecy::updateOrCreate(
        //     ['user_id' => $user->id],
        //     [
        //         'frequent_login_time' => $currentTime,
        //         'frequent_logout_time' => $currentTime,
        //     ]);

            time_frequnecy::where('user_id',$user->id)->updateorcreate(['frequent_login_time' => $currentTime,'email'=>$user->email ]);

        return redirect()->intended(RouteServiceProvider::HOME);
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $user = Auth::user();
        
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        
        
        date_default_timezone_set('Asia/Kolkata');
        $currentTime = Carbon::now()->toTimeString();

        

        time_frequnecy::where('email', $user->email)
        ->latest('created_at')
        ->first()
        ->update([ 'frequent_logout_time' => $currentTime,'email'=>$user->email  ]);

        // if ($lastRow !== null) {
        //     // Update the attributes of the last row
        //     $lastRow->frequent_logout_time = $currentTime;
        //     $lastRow->save();
        // }
        
        return redirect('/');
    }
}
