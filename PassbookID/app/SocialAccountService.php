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
		
	return NULL;
    }
}
