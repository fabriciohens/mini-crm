<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class LocalizationController extends Controller
{
    /**
     * Display the specified resource.
     */
    public function index() {
        return view('localization');
    }

    /**
     * Changes the locale of the app.
     */
    public function changeLocale($locale) {
        Session::put('locale', $locale);
        return redirect('/localization');
    }
}
