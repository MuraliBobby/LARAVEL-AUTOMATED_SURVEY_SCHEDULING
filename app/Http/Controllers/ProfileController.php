<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Models\availability;
use App\Models\preference;
use App\Models\User;
class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        $user = $request->user();
        $availabilityDetails = availability::where('user_id', $user->id);
        // $preferencesDetails = preference::where('user_id',$user->id);

        // $preferences = $user->preferences;
        // $preferencesArray = explode(',', $preferencesDetails);
        
        return view('profile.edit', [
            'user' => $request->user(),
            'availabilities'=> $availabilityDetails,
            // 'preferences'=> $preferencesDetails,
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {

        $user = $request->user();

        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

               
        $from_time = $request->input('from_time');
        $to_time = $request->input('to_time');
 

        availability::where('user_id', $user->id)->update(['from_time' => $from_time]);
        availability::where('user_id', $user->id)->update(['to_time' => $to_time]);
        
        

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();
        
        availability::where('user_id', $user->id)->delete();
        preference::where('user_id', $user->id)->delete();
        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
