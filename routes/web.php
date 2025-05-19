<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\App;
/*
 * Old route:
    Route::get('/', function () {
        return view('FormPage');
    });
*/

$supportedLocales = ['en', 'ar'];
$defaultLocale = 'en';

Route::get('/{locale?}', function ($requestedLocale = null) use ($supportedLocales, $defaultLocale) {

    $localeToSet = $defaultLocale;

    if ($requestedLocale && in_array($requestedLocale, $supportedLocales)) {
        $localeToSet = $requestedLocale;
    }

    App::setLocale($localeToSet);

    return view('FormPage');
})
->where('locale', '[a-z]{2}') // This regex constrains the 'locale' parameter to be two lowercase letters if present
->name('home.page'); // It's good practice to name your routes