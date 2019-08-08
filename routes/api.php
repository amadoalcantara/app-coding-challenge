<?php

use Illuminate\Http\Request;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('events', 'EventsController@index');
Route::get('event/{id}', 'EventsController@show');
Route::post('event', 'EventsController@store');
Route::put('event/{eventname}', 'EventsController@update');
Route::delete('event/{id}', 'EventsController@destroy');