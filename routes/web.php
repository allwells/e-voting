<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// GUEST ROUTE
Route::group(['middleware' => 'guest'], function() {
    // HOME ROUTE
    Route::get('/', function () { return view('home'); })->name("home");

    // LOGIN ROUTE
    Route::get('/login', 'App\Http\Controllers\Auth\LoginController@index')->name('login');
    Route::post('/login', 'App\Http\Controllers\Auth\LoginController@store');

    // REGISTER ROUTE
    Route::get('/register', 'App\Http\Controllers\Auth\RegisterController@index')->name('register');
    Route::post('/register', 'App\Http\Controllers\Auth\RegisterController@store');
});
