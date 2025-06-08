<?php
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AccountsController;
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
->name('home.page');
Route::resource('accounts', AccountsController::class)->only(['index', 'store']);
