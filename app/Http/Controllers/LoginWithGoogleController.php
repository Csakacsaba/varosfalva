<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Exception;

class LoginWithGoogleController extends Controller
{
//    a google-s bejelentkezesert felelos kontroller
    public function redirectToGoogle()
    {
        // inditja a Google OAuth hitelesitesi folyamatot
        // a socialite csomag 'google' driveret hasznalja
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {

        try {
            // megprobaljuk a Google-tol beszerezni a felhasznaloi informaciokat
            $user = Socialite::driver('google')->stateless()->user();

            // ellenorizzuk, hogy a felhasznalo mar letezik-e az adatbazisban a Google azonosito alapjan
            $finduser = User::where('google_id', $user->id)->first();
            if($finduser){
//                ha a felhasznalo letezik akkor bejelentkeztetjuk
                Auth::login($finduser);
//              atiranyitjuk a felhasznalot a 'contact' oldalre egy sikeres bejelentkezes uzenettel
                return redirect()->intended('contact')->with('success', __('flash.success_login'));

            }else{

                $newUser = User::create([
                    'name' => $user->name,
                    'email' => $user->email,
                    'google_id'=> $user->id,
                    'admin' => 0,
                    'password' => '123456dummy'
                ]);
//                bejelentkeztetjuk az uj felhasznalot
                Auth::login($newUser);
//              atiranyitjuk a felhasznalot a 'contact' oldalre egy sikeres bejelentkezes uzenettel
                return redirect()->intended('contact')->with('success', __('flash.success_register'));
            }

        }catch (Exception $e) {
//            ha hiba van akkor ujra lekerdezzuk a felhasznlaot az email cim alapjan
            $user = User::where('email', $user->email)->first();
            if ($user) {
//                ha a felhasznalo letezik akkor bejelentkeztetjuk
                Auth::login($user);
                return redirect()->intended('contact')->with('success',  __('flash.success_login'));
            } else {
//                ha nem talaljuk a felhasznalot akkor atiranyitjuk a 'contact oldalra', egy hiba uzenettel bejelentkeztetes nelkul
                return redirect()->intended('contact')->with('message',  __('flash.error'));
            }
    }
    }
}
