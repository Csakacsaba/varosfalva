<?php

namespace App\Http\Controllers;

use _PHPStan_71ced81c9\Nette\Schema\ValidationException;
use Illuminate\Http\Request;

class SessionsController extends Controller
{

    public function create()
    {
        return view('register.login');
    }


    public function store()
    {
        $attributes = request()->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);


        if (auth()->attempt($attributes)) {
            return redirect('contact')->with('success',  __('flash.success_login'));
        }
        return back()
            ->withInput()
            ->withErrors(['email'=>'Your provided credentials could not be verified']);
    }

    public function destroy()
    {
        auth()->logout();
        return redirect()->route('contact')->with('message',  __('flash.success_logout'));
    }
}
