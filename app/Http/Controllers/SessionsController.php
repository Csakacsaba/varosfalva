<?php

namespace App\Http\Controllers;

use _PHPStan_71ced81c9\Nette\Schema\ValidationException;
use Illuminate\Http\Request;

class SessionsController extends Controller
{
//  megjeleniti a bejelentkezesi urlapot
    public function create()
    {
        return view('register.login');
    }
//    kezeli a bejelentkezesi urlap bekuldeset
    public function store()
    {
//        validacio
        $attributes = request()->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);
//      ellenorzi a felhasznaloi hitelesito adatokat
        if (auth()->attempt($attributes)) {
//            ha sikeres a bejelentkezes akkor atiranyitja a felhasznalot a 'contact' oldalra egy sikeres bejelentkezes uzenettel
            return redirect('contact')->with('success',  __('flash.success_login'));
        }
//        ha a hitelesites sikertelene akkor visszairanyitja a felhasznalot a bejelentkezesi oldalra
        return back()
            ->withInput()
            ->withErrors(['email'=>'Your provided credentials could not be verified']);
    }
//    kezeli a kijelentkzest
    public function destroy()
    {
//        kijelentkezsteti a felhasznalot es visszairanyitja a contact oldalra
        auth()->logout();
        return redirect()->route('contact')->with('message',  __('flash.success_logout'));
    }
}
