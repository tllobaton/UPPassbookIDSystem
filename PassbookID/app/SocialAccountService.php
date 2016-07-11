<?php

namespace App;

use Session;
use Laravel\Socialite\Contracts\User as ProviderUser;

class SocialAccountService
{
    public function createOrGetUser(ProviderUser $providerUser)
    {
		
        $account = User::whereEmail($providerUser->getEmail())			// Check if email exists in local database
            ->first();	
		
        if ($account) {													// If email is in database already, return the user
			$status = $account->active;
			if ($status == "yes")
				return $account;
			else{
				return $status;
			}
        }	
		
		else {															// If email does not exist,
			if (isset($providerUser->user['domain'])) {					// Check if email has a different domain other than @gmail.com
				if ($providerUser->user['domain'] == "up.edu.ph") {		// Check if email's domain is up.edu.ph
					$user = new User();									// Create user and add to database
					$user->name = $providerUser->getName();
					$user->email = $providerUser->getEmail();
					$user->save();
					return $user;
				}
			}
			return NULL;												// Return null if no domain
        }

    }
}