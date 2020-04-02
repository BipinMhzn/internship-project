<?php

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

Route::get('/', function () {
    return redirect(route('login'));
});

Auth::routes();

Route::group(['middleware' => 'auth'], function () {
    Route::get('/home', 'HomeController@index')->name('home');

    Route::get('/profile', 'ProfileController@index')->name('profile.index');
    Route::get('/profile/edit', 'ProfileController@edit')->name('profile.edit');
    Route::put('/profile', 'ProfileController@update')->name('profile.update');

    Route::resource('change-password', 'ChangePasswordController')->only(['index', 'store']);

    Route::get('/api/events', 'EventController@get_events');
    Route::get('/api/participants', 'EventController@get_participants');
    Route::resource('event', 'EventController')->only(['index', 'show']);

    Route::get('/api/surveys', 'WomenController@get_survey');
    Route::resource('women', 'WomenController')->only(['index', 'show']);
});

Route::resource('users', 'UserController')->only(['index', 'edit', 'update', 'destroy']);
Route::resource('event', 'EventController')->only(['destroy'])->middleware('superadmin');
Route::resource('women', 'WomenController')->only(['destroy'])->middleware('superadmin');
