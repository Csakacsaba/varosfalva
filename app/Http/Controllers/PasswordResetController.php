<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
// jelszo visszaallitasaert felelos kontroller
class PasswordResetController extends Controller
{
//        jelszo visszaallitasi email kuldese
    public function password_reset_email(Request $request)
    {
//      a keres validalasa, hogy irtak e be emailt
        $request->validate(['email' => 'required|email']);
//      a jelszo visszaallitasi link kuldese
        $status = Password::sendResetLink(
            $request->only('email')
        );
//        atiranyitja a felhasznalot a bejelentkezesi oldalra statusz uzenettel
        return redirect(route('login'))->with(['status' => __($status)]);
    }
//  jelszo visszaallitasi kerelem nezetenek megjelenitese
    public function password_request_blade()
    {
        return view('password_reset/password_request');
    }
//  jelszo visszaallitasanak megerositese
    public function password_reset_confirmation(Request $request)
    {
//      validacio
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:6|confirmed',
        ]);
//      jelszo visszaallitasa
        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function (User $user, string $password) {
//                felhasznalo jelszavanak beallitasa
                $user->forceFill([
                    'password' =>$password
                ])->setRememberToken(Str::random(60));
//              mentes
                $user->save();
                event(new PasswordReset($user));
            }
        );
//        ha sikeres a jelszo visszaallitas akkor atiranyitja a felhasznalot a bejelentkezesi feluletre
//        kulonben hibauzenet jelenik meg
        return $status === Password::PASSWORD_RESET
            ? redirect()->route('login')->with('status', __($status))
            : back()->withErrors(['email' => [__($status)]]);
    }
}
