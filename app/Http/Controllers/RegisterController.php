<?php

namespace App\Http\Controllers;

use http\Client\Curl\User;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function create() {
        return view('register.register');
    }

    public  function store() {
        $attributes = request()->validate([
            'name' => "required",
            'password' => 'required|max:255|min:5|confirmed',
            'email' => 'required|email'
        ]);
        session()->flash('success',  __('flash.success_register'));

        $user = \App\Models\User::create($attributes);

        auth()->login($user);

        return redirect('/contact');

    }
}
