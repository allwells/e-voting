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

Route::group(['middleware' => ['auth', 'admin']], function() {
    // ELECTION ROUTE
    Route::post('/elections', 'App\Http\Controllers\ElectionController@store');
    Route::post('/elections/{election:id}/close', 'App\Http\Controllers\ElectionController@close_election')->name('elections.close');
    Route::delete('/elections/{election:id}', 'App\Http\Controllers\ElectionController@destroy')->name('elections.destroy');
    Route::post('/elections/{election:id}', 'App\Http\Controllers\ElectionController@add_candidate')->name('elections.candidate');
});


Route::group(['middleware' => ['auth', 'superuser']], function() {
    // USERS ROUTE
    Route::get('/users', 'App\Http\Controllers\UserController@index')->name('users');
});


Route::group(['middleware' => 'auth'], function() {
    // DASHBOARD ROUTE
    Route::get('/dashboard', 'App\Http\Controllers\DashboardController@index')->name('dashboard');

    // PROFILE ROUTE
    Route::get('/profile', 'App\Http\Controllers\ProfileController@index')->name('profile');
    Route::post('/profile', 'App\Http\Controllers\ProfileController@store');

    // ELECTION ROUTE
    Route::get('/elections', 'App\Http\Controllers\ElectionController@index')->name('elections');

    // SETTINGS ROUTE
    Route::get('/settings', 'App\Http\Controllers\SettingsController@index')->name('settings');
    Route::post('/settings', 'App\Http\Controllers\SettingsController@store_theme')->name('settings.theme');

    // LOGOUT ROUTE
    Route::get('/logout', 'App\Http\Controllers\Auth\LogoutController@index')->name('logout');

    // redirects to dashboard route
    Route::get('/', function() { return redirect()->route('dashboard'); });
    Route::get('/home', function() { return redirect()->route('dashboard'); });
});


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