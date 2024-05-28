<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
//    vissza adja a bejelentkezesi feluletet
    public function create() {
        return view('register/login');
    }
}
