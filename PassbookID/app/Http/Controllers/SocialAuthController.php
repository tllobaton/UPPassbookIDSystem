<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use Socialite;
use Session;
use App\SocialAccountService;
use DB;
class SocialAuthController extends Controller
{
    public function redirect()
    {
        return Socialite::driver('google')->redirect();   
    }   

    public function callback(SocialAccountService $service)
    {
        $user = $service->createOrGetUser(Socialite::driver('google')->user());	// Get user from google database

		if ($user != NULL) {													// If user exists and has correct domain, log-in and redirect to landing							
			if($user == "no"){
				Session::flash('xdomain', 'Your account has been deactivated.');
				return redirect("/login");
			}
			else{
				auth()->login($user);
				return redirect('/Landing');
			}
		}
		else {
			Session::flash('xdomain', 'Please use @up.edu.ph.');				// Otherwise, return to login page with error message
			return redirect("/login");
		}
    }
}
