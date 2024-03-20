<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Exception;

class LoginWithGoogleController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {

        try {

            $user = Socialite::driver('google')->stateless()->user();
            $finduser = User::where('google_id', $user->id)->first();
            if($finduser){

                Auth::login($finduser);

                return redirect()->intended('contact')->with('success', __('flash.success_login'));

            }else{

                $newUser = User::create([
                    'name' => $user->name,
                    'email' => $user->email,
                    'google_id'=> $user->id,
                    'admin' => 0,
                    'password' => '123456dummy'
                ]);
                Auth::login($newUser);

                return redirect()->intended('contact')->with('success', __('flash.success_register'));
            }

        }catch (Exception $e) {
            $user = User::where('email', $user->email)->first();
            if ($user) {
                Auth::login($user);
                return redirect()->intended('contact')->with('success',  __('flash.success_login'));
            } else {
                return redirect()->intended('contact')->with('message',  __('flash.error'));
            }
    }
    }
}
