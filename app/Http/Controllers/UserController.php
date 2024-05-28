<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class UserController extends Controller
{
//    megjeleniti a felhasznlo adatainak szerkesztesi feluletet
    public function index()
    {
        return view('contents.user_edit',[
            'user' => auth()->user(),
        ]);
    }
// a felhasznalo email cimenek megvaltoztatasa
    public function change_email(Request $request)
    {
//        validavio, hogy megfelelo-e az email cim vagy hogy mar letezik-e
        $request->validate([
            'email' => 'required|max:255|min:8|unique:users,email',
        ]);

        $new_email = $request->input('email');
        $user = auth()->user();
        $user->email = $new_email;  // az uj email cim beallitasa
        $user->google_id = 0;  // a google Id nullazasa, ez nagyon fontos
        $user->save();
//        felhasznalonak az adatai mentve lettek
//        a felhasznalo kijelentkeztetese
        Auth::logout();
//        visszaterites a 'contect' oldalra, egy uzenettel
        return redirect('contact')->with('success', 'Sikeres email változtatás,
        kérjük jelentkezzen be újra');
    }
//    hasonlo modom mukorik a nev valtoztatas is
    public function change_name(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255|min:5|string',
        ]);
        $new_name = $request->input('name');
        $user = auth()->user();
        $user->name = $new_name;
        $user->save();
        //        visszaterites a 'contect' oldalra, egy uzenettel
        return redirect()->back()->with('success', 'Sikeres név változtatás');
    }
//  jelszo valtoztatasa
    public function change_password(Request $request)
    {
//        validacio
        $request->validate([
            'password' => 'required|max:255|min:5|confirmed',
        ]);

        $new_password = $request->input('password');

        $user = auth()->user();
        $user->password = $new_password;  // uj jelszo beallitasa
        $user->save(); // felhasznalo kijelentkeztetese
        Auth::logout();
        //        visszaterites a 'contect' oldalra, egy uzenettel
        return redirect('contact')->with('success', 'Sikeres jelszó változtatás');
    }
//  a felhasznalo torlese
    public function delete_user()
    {
//        elobb kijelentkeztetjuk a felhasznlalot, aztan kitoruljuk a felhasznalo adatait az adatbazisbol
        $user = Auth::user();
        Auth::logout();
        $user->delete();
        //        visszaterites a 'contect' oldalra,
        return redirect('contact');
    }
}
