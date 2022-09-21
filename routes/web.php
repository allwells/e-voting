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
Route::middleware(['auth'])->group(function() {
    // HOME ROUTE
    Route::get('/explore', 'App\Http\Controllers\FeedsController@index')->name('explore');

    // NOTIFICATIONS ROUTE
    Route::get('/notifications', 'App\Http\Controllers\NotificationController@index')->name('notifications');
    Route::get('/event/{id}', 'App\Http\Controllers\NotificationController@show')->name('notifications.show');
    Route::post('/notifications/{id}', 'App\Http\Controllers\NotificationController@mark')->name('notifications.mark');
    Route::post('/notifications', 'App\Http\Controllers\NotificationController@markAll')->name('notifications.mark-all');
    Route::delete('/event/{id}', 'App\Http\Controllers\NotificationController@destroy')->name('notifications.destroy');

    // PROFILE ROUTE
    Route::get('/profile', 'App\Http\Controllers\ProfileController@index')->name('profile');
    Route::post('/profile', 'App\Http\Controllers\ProfileController@store');

    // ELECTIONS ROUTE
    Route::get('/elections', 'App\Http\Controllers\Superuser\ElectionController@index')->name('elections.view');
    Route::get('/elections/{election:id}', 'App\Http\Controllers\Superuser\ElectionController@show')->name('elections.show');
    Route::post('/election/{election:id}/{candidate:id}', 'App\Http\Controllers\Superuser\ElectionController@addVote')->name('elections.vote.add');
    Route::delete('/election/{election:id}/{candidate:id}', 'App\Http\Controllers\Superuser\ElectionController@removeVote')->name('elections.vote.remove');
    Route::post('/elections/verify', 'App\Http\Controllers\Superuser\ElectionController@codeVerification')->name('elections.verify');

    // POLLS ROUTE
    Route::get('/polls', 'App\Http\Controllers\PollController@index')->name('polls.view');
    Route::post('/polls/{poll:id}', 'App\Http\Controllers\PollController@store')->name('polls.respond');

    // APIs
    Route::get('/api/responses', 'App\Http\Controllers\ResponseController@getResponse');
    Route::get('/api/polls', 'App\Http\Controllers\PollController@getPolls');
    Route::get('/api/options', 'App\Http\Controllers\OptionController@getOptions');

    // RESULTS ROUTE
    Route::get('/results', 'App\Http\Controllers\ResultController@index')->name('results');
    Route::get('/results/{election:id}', 'App\Http\Controllers\ResultController@show')->name('results.view');
    Route::get('/results/{election:id}/chart', 'App\Http\Controllers\ResultController@result_chart')->name('results.chart');

    // SETTINGS ROUTE
    Route::get('/settings', 'App\Http\Controllers\SettingController@index')->name('settings');
    // Route::get('/settings/profile', 'App\Http\Controllers\SettingController@profileSetting')->name('settings.profile');
    Route::get('/settings/email', 'App\Http\Controllers\SettingController@emailSetting')->name('settings.email');
    Route::get('/settings/password', 'App\Http\Controllers\SettingController@passwordSetting')->name('settings.password');
    Route::get('/settings/notification', 'App\Http\Controllers\SettingController@notificationSetting')->name('settings.notification');

    // Route::post('/settings/profile', 'App\Http\Controllers\SettingController@editProfile');
    Route::post('/settings/email', 'App\Http\Controllers\SettingController@changeEmail');
    Route::post('/settings/password', 'App\Http\Controllers\SettingController@changePassword');
    Route::post('/settings/notification', 'App\Http\Controllers\SettingController@setNotification');

    // LOGOUT ROUTE
    Route::post('/logout', 'App\Http\Controllers\Auth\LogoutController@index')->name('logout');

    // DASHBOARD ROUTE
    Route::get('/dashboard', 'App\Http\Controllers\DashboardController@index')->name('dashboard');

    Route::get('/', function() { return auth()->user()->privilege != 'superuser' ? redirect()->route('explore') : redirect()->route('dashboard'); });
    Route::get('/home', function() { return auth()->user()->privilege != 'superuser' ? redirect()->route('explore') : redirect()->route('dashboard'); });
});

// ADMINS ROUTE
Route::middleware(['admin'])->group(function() {
    // ELECTIONS ROUTE
    Route::get('/event/election/create', 'App\Http\Controllers\Superuser\ElectionController@showCreate')->name('elections.create');
    Route::post('/event/election/create', 'App\Http\Controllers\Superuser\ElectionController@create');
    Route::post('/event/election/{election:id}/close', 'App\Http\Controllers\Superuser\ElectionController@close')->name('elections.close');
    Route::get('/event/election/{election:id}/edit', 'App\Http\Controllers\Superuser\ElectionController@showEdit')->name('elections.edit');
    Route::post('/event/election/{election:id}/edit', 'App\Http\Controllers\Superuser\ElectionController@edit');
    Route::delete('/event/election/{election:id}/delete', 'App\Http\Controllers\Superuser\ElectionController@destroy')->name('elections.delete');
    Route::post('/event/election/{election:id}/activation', 'App\Http\Controllers\Superuser\ElectionController@codeActivation')->name('activation');

    // POLLS ROUTE
    Route::get('/event/poll/create', 'App\Http\Controllers\PollController@show')->name('polls.create');
    Route::post('/event/poll/create', 'App\Http\Controllers\PollController@create');
    Route::delete('/polls/{poll}', 'App\Http\Controllers\PollController@destroy')->name('polls.destroy');

    // PARTICIPANT ROUTE
    Route::delete('/elections/{election}/kickout/{participant}', 'App\Http\Controllers\ParticipantController@destroy')->name('participant.destroy');

    // CSV AND EXCEL SPREADSHEET ROUTES
    Route::post('/event/election/{election:id}/invite', 'App\Http\Controllers\Superuser\ElectionController@sendInviteManually')->name('invite');
    Route::post('/event/election/{election:id}/import', 'App\Http\Controllers\Superuser\ElectionController@fileImport')->name('import.file');
});

// SUPERUSER ROUTE
Route::middleware(['superuser'])->group(function() {
    // USERS ROUTE
    Route::get('/users', 'App\Http\Controllers\Superuser\UserController@index')->name('users');
    Route::get('/users/manage/add', 'App\Http\Controllers\Superuser\UserController@getAddUser')->name('users.add');
    Route::post('/users/manage/add', 'App\Http\Controllers\Superuser\UserController@addUser');
    Route::post('/users/manage/import', 'App\Http\Controllers\Superuser\UserController@fileImport')->name('users.file-import');
    Route::delete('/users/{user:id}', 'App\Http\Controllers\Superuser\UserController@destroy')->name('users.destroy');
    Route::post('/users/{user:id}', 'App\Http\Controllers\Superuser\UserController@privilege')->name('users.privilege');

    // SEARCH ROUTES
    Route::get('/search/users', 'App\Http\Controllers\Superuser\UserController@search');
    Route::get('/search/elections', 'App\Http\Controllers\Superuser\ElectionController@search');
    Route::get('/search/polls', 'App\Http\Controllers\PollController@search');
    Route::get('/search/results', 'App\Http\Controllers\ResultController@search');

     // POLLS ROUTE
    Route::get('/polls/{poll}', 'App\Http\Controllers\PollController@view')->name('polls.show');

    // redirects to dashboard route
    // Route::get('/', function() { return redirect()->route('dashboard'); });
    // Route::get('/home', function() { return redirect()->route('dashboard'); });
});

// GUEST ROUTE
Route::middleware(['guest'])->group(function() {
    // HOME ROUTE
    Route::get('/', function () { return view('home'); })->name("home");

    // LOGIN ROUTE
    Route::get('/login', 'App\Http\Controllers\Auth\LoginController@index')->name('login');
    Route::post('/login', 'App\Http\Controllers\Auth\LoginController@store');

    // REGISTER ROUTE
    Route::get('/register', 'App\Http\Controllers\Auth\RegisterController@index')->name('register');
    Route::post('/register', 'App\Http\Controllers\Auth\RegisterController@store');

    // PASSWORD-RESET ROUTE
    Route::get('/password/forgot', 'App\Http\Controllers\Auth\PasswordReset@index')->name('password.reset.link');
    Route::post('/password/forgot', 'App\Http\Controllers\Auth\PasswordReset@requestResetLink');
    Route::get('/password/reset/{token}', 'App\Http\Controllers\Auth\PasswordReset@passwordResetForm')->name('password.reset');
    Route::post('/password/reset/{token}', 'App\Http\Controllers\Auth\PasswordReset@resetPassword');
});