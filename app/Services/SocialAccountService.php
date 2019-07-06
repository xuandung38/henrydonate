<?php
namespace App\Services;

use App\User;
use App\Models\SocialAccount;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Contracts\User as ProviderUser;

class SocialAccountService
{
    public static function createOrGetUser(ProviderUser $providerUser, $social)
    {
        $account = SocialAccount::whereProvider($social)
            ->whereProviderUserId($providerUser->getId())
            ->first();

        if ($account) {
            return $account->user;
        } else {
            $user = FALSE;
            $email = $providerUser->getEmail();  
            $username = $providerUser->getNickname();          
            $account = new SocialAccount([
                'provider_user_id' => $providerUser->getId(),
                'provider' => $social
            ]);
            if($email != NULL)
            {
                $user = User::whereEmail($email)->first();              
                if (!$user) {
                    return $user = User::create([
                    'email' => $email,
                    'name' => $providerUser->getName(),
                    'password' => Hash::make($providerUser->getId()),
                 ]);     
                }
            }
            else
            {
                $user = User::whereUsername($username)->first();
                if (!$user) {
                    return $user = User::create([
                    'username' => $username,
                    'name' => $providerUser->getName(),
                    'password' => Hash::make($providerUser->getId()),
                 ]);     
                }
            }              
           
            $account->user()->associate($user);
            $account->save();

            return $user;
        }
    }

    public function createUser($colume,$nickoremail,$name,$password)
    {
        return $user = User::create([
                    ''.$colume.'' => $nickoremail,
                    'name' => $name,
                    'password' => Hash::make($password),
                ]);        
    }
}