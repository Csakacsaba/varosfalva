<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Mockery\Matcher\Closure;


class LanguageController extends Controller
{
    public function change_language(string $locale)
    {
        if (! in_array($locale, ['hu', 'ro'])) {
            abort(400);
        }
        app()->setLocale($locale);
        session()->put('locale', $locale);

        return back();
    }
}
