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

//Route::get('/', function () {
//    return view('welcome');
//});

Route::middleware('guest')->group(function () {
    Route::get('/', 'AuthController@index')->name('login');
    Route::post('/login', 'AuthController@login')->name('auth.login');
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', 'AuthController@logout')->name('auth.logout');

    Route::resource('events', 'EventController')->only(['index', 'store', 'create']);

    Route::middleware('check.event')->group(function () {
        Route::resource('events', 'EventController')->except(['index', 'store', 'create']);
        Route::resource('events/{event}/tickets', 'TicketController');
        Route::resource('events/{event}/channels', 'ChannelController');
        Route::resource('events/{event}/rooms', 'RoomController');
        Route::resource('events/{event}/sessions', 'SessionController');
        Route::get('events/{event}/reports', 'ReportController@index')->name('reports.index');
    });
});
