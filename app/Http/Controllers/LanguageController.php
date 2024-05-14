<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;


class LanguageController extends Controller
{
    public function changeLanguage($locale)
    {
        if (in_array($locale, ['en', 'vi'])) {
            session()->put('locale', $locale);
        }
        $locale = Session::get('locale', 'vi');

        return back();
    }
}

