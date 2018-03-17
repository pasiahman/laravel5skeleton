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

Route::post('authentication/login', ['as' => 'api.authentication.login', 'uses' => 'API\AuthenticationController@login']);
Route::post('authentication/register', ['as' => 'api.authentication.register', 'uses' => 'API\AuthenticationController@register']);
Route::post('authentication/verified', ['as' => 'api.authentication.verified', 'uses' => 'API\AuthenticationController@verified']);
Route::post('authentication/verify', ['as' => 'api.authentication.verify', 'uses' => 'API\AuthenticationController@verify']);
