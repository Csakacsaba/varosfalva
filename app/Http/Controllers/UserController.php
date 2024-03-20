<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class UserController extends Controller
{
    public function index()
    {
        return view('contents.user_edit',[
            'user' => auth()->user(),
        ]);
    }

    public function change_email(Request $request)
    {
        $request->validate([
            'email' => 'required|max:255|min:8|unique:users,email',
        ]);
        $new_email = $request->input('email');
        $user = auth()->user();
        $user->email = $new_email;
        $user->google_id = 0;
        $user->save();
        Auth::logout();
        return redirect('contact')->with('success', 'Sikeres email változtatás, kérjük jelentkezzen be újra');
    }
    public function change_name(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255|min:5|string',
        ]);
        $new_name = $request->input('name');
        $user = auth()->user();
        $user->name = $new_name;
        $user->save();
        return redirect()->back()->with('success', 'Sikeres név változtatás');
    }

    public function change_password(Request $request)
    {
        $request->validate([
            'password' => 'required|max:255|min:5|confirmed',
        ]);

        $new_password = $request->input('password');

        $user = auth()->user();
        $user->password = $new_password;
        $user->save();
        Auth::logout();
        return redirect('contact')->with('success', 'Sikeres jelszó változtatás');
    }

    public function delete_user()
    {
        $user = Auth::user();
        Auth::logout();
        $user->delete();
        return redirect('contact');
    }
}
