<?php
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('FormPage');
});
Route::resource('accounts', App\Http\Controllers\AccountsController::class)->only(['index', 'store']);
