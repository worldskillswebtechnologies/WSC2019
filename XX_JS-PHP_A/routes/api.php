<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::prefix('v1')->group(function() {
    Route::get('events', 'Api\EventController@index');
    Route::get('organizers/{organizer}/events/{event}', 'Api\EventController@detail');

    Route::post('login', 'Api\AttendeeController@login');
    Route::post('logout', 'Api\AttendeeController@logout');

    Route::post('organizers/{organizer}/events/{event}/registration', 'Api\RegistrationController@register');
    Route::get('registrations', 'Api\RegistrationController@registrations');
});
