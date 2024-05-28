<?php

namespace App\Http\Controllers;

use http\Client\Curl\User;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
//    megjeleniti a regisztracios urlapot
    public function create() {
        return view('register.register');
    }
//  regisztracios urlap kezelese
    public  function store() {
//        validalja a kapott adatokat
        $attributes = request()->validate([
            'name' => "required",
            'password' => 'required|max:255|min:5|confirmed',
            'email' => 'required|email'
        ]);
//        ellenorzi, hogy letezik-e mar felhasznalo az adott email cimmel
        $existingUser = \App\Models\User::where('email', $attributes['email'])->first();
        if ($existingUser) {
//            ha mar letezik ilyen email cim akkor visszairanyitja a felhasznalot a regisztracios urlapra a hibak megjelenitesevel
            return redirect()->back()->withErrors(['email' => 'Ez az email cím már foglalt. Kérlek, adj meg egy másikat.'])->withInput();
        }
//        sikeres regisztracio eseten az uzenet tarolasa a sessionben
        session()->flash('success',  __('flash.success_register'));
//      uj felhasznalo letrehozasa az adatbazisban
        $user = \App\Models\User::create($attributes);
//      bejelentkezteti a felhasznalot
        auth()->login($user);
//      atiranyitas a contact oldalra
        return redirect('/contact');
    }
}
