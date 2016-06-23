<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use Socialite;
use Session;
use App\SocialAccountService;
class SocialAuthController extends Controller
{
    public function redirect()
    {
        return Socialite::driver('google')->redirect();   
    }   

    public function callback(SocialAccountService $service)
    {
        $user = $service->createOrGetUser(Socialite::driver('google')->user());

		if ($user != NULL) {
			auth()->login($user);
			
			return redirect()->to('/Landing');
		}
		else {
			Session::flash('xdomain', 'Please use @up.edu.ph.');
			return redirect("/Landing");
		}
    }
}
