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

Auth::routes();

Route::prefix('backend')->group(function () {
    Route::get('/user/create', ['as' => 'backendUserCreate', 'uses' => 'Backend\UsersController@create']);
    Route::post('/user/create', ['as' => 'backendUserCreate', 'uses' => 'Backend\UsersController@create']);
    Route::delete('/user/delete/{id}', ['as' => 'backendUserDelete', 'uses' => 'Backend\UsersController@delete']);
    Route::get('/user/update', ['as' => 'backendUserUpdate', 'uses' => 'Backend\UsersController@update']);
    Route::put('/user/update', ['as' => 'backendUserUpdate', 'uses' => 'Backend\UsersController@update']);
    Route::get('/users', ['as' => 'backendUsers', 'uses' => 'Backend\UsersController@index']);
});
// Route::get('/backend', 'Backend\HomeController@index');

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/login/{social}', 'Auth\LoginController@socialLogin')->where('social', 'facebook|github|google');
Route::get('/login/{social}/callback', 'Auth\LoginController@handleProviderCallback')->where('social', 'facebook|github|google');
Route::get('/', function () {
    return view('welcome');
});
