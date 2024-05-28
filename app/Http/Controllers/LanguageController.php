<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Mockery\Matcher\Closure;


class LanguageController extends Controller
{
//    az oldal nyelvezetenek beallitasaert felelos kontroller
    public function change_language(string $locale)
    {
//        ellenorzi, hogy a beerkezett nyelvkod helyes e
        if (! in_array($locale, ['hu', 'ro'])) {
//            ha nem ervenyes akkor 400 as hibakodot ad vissza
            abort(400);
        }
//        beallitja az alkamlazas nyelvet a beerkezett nyelvkodra, 'hu' vagy 'ro'
        app()->setLocale($locale);
//        a megadott nyelvkodot elmenti a felhasznalo munkamenetebe
        session()->put('locale', $locale);
//        a felhasznalo visszairanyitasa
        return back();
    }
}
