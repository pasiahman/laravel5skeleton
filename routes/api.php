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

Route::post('authentication/login', ['as' => 'api.authentication.login', 'uses' => '\Modules\Authentication\Http\Controllers\Api\AuthenticationController@login']);
Route::post('authentication/password/forgot', ['as' => 'api.authentication.passwordForgot', 'uses' => '\Modules\Authentication\Http\Controllers\Api\AuthenticationController@passwordForgot']);
Route::post('authentication/password/reset', ['as' => 'api.authentication.passwordReset', 'uses' => '\Modules\Authentication\Http\Controllers\Api\AuthenticationController@passwordReset']);
Route::post('authentication/register', ['as' => 'api.authentication.register', 'uses' => '\Modules\Authentication\Http\Controllers\Api\AuthenticationController@register']);
Route::post('authentication/verified', ['as' => 'api.authentication.verified', 'uses' => '\Modules\Authentication\Http\Controllers\Api\AuthenticationController@verified']);
Route::post('authentication/verify', ['as' => 'api.authentication.verify', 'uses' => '\Modules\Authentication\Http\Controllers\Api\AuthenticationController@verify']);
Route::group(['middleware' => ['authApi', 'userVerified']], function () {
    Route::get('users/profile', ['as' => 'api.users.profileShow', 'uses' => 'API\UsersController@profileShow']);
    Route::put('users/profile', ['as' => 'api.users.profileUpdate', 'uses' => 'API\UsersController@profileUpdate']);
});
Route::group(['middleware' => ['authApi']], function () {
    Route::get('users/verification-code/refresh', ['as' => 'api.users.verificationCodeRefresh', 'uses' => 'API\UsersController@verificationCodeRefresh']);
});
