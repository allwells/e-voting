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

// AUTHENTICATED USER ROUTE
Route::group(['middleware' => 'auth'], function() {
    // DASHBOARD ROUTE
    Route::get('/dashboard', 'App\Http\Controllers\DashboardController@index')->name('dashboard');

    // RESULTS ROUTE
    Route::get('/results', 'App\Http\Controllers\ResultController@index')->name('results');

    // LOGOUT ROUTE
    Route::post('/logout', 'App\Http\Controllers\Auth\LogoutController@index')->name('logout');

    // redirects to dashboard route
    Route::get('/', function() { return redirect()->route('dashboard'); });
    Route::get('/home', function() { return redirect()->route('dashboard'); });
});

// ADMINS ROUTE
Route::group(['middleware' => 'admin'], function() {});

// USERS ROUTE
Route::group(['middleware' => 'user'], function() {
    // INFORMATION ROUTE
    Route::get('/information', 'App\Http\Controllers\User\InformationController@index')->name('information');

    // VOTER REGISTRATION ROUTE
    Route::get('/registration', 'App\Http\Controllers\User\VoterRegistrationController@index')->name('voter.registration');

    // VOTING ROUTE
    Route::get('/voting', 'App\Http\Controllers\User\VotingAreaController@index')->name('voting');
});

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
