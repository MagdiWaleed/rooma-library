<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::resource('accounts', \App\Http\Controllers\AccountsController::class);
