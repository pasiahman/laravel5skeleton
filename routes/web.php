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

Route::group(['middleware' => ['auth']], function () {
    Route::get('backend', ['as' => 'backend', 'uses' => '\Modules\Users\Http\Controllers\Backend\UsersController@index']);
    Route::get('backend/dashboard', ['as' => 'backend.dashboard', 'uses' => '\Modules\Users\Http\Controllers\Backend\UsersController@index']);
    Route::group(['middleware' => ['permission:backend options']], function () {
        Route::resource('backend/options', 'Backend\OptionsController', ['as' => 'backend']);
        Route::get('backend/options/{id}/delete', ['as' => 'backend.options.delete', 'uses' => 'Backend\OptionsController@delete']);
    });
});

// Auth::routes();
Route::get('', ['as' => 'frontend', 'uses' => 'FrontendController@index']);
