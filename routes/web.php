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
    Route::group(['middleware' => ['permission:backend media']], function () {
        Route::resource('backend/media', 'Backend\MediaController', ['as' => 'backend']);
        Route::get('backend/media/{id}/delete', ['as' => 'backend.media.delete', 'uses' => 'Backend\MediaController@delete']);
        Route::get('backend/media/{id}/trash', ['as' => 'backend.media.trash', 'uses' => 'Backend\MediaController@trash']);
        Route::post('backend/media/upload', ['as' => 'backend.media.upload', 'uses' => 'Backend\MediaController@upload']);
    });
    Route::group(['middleware' => ['permission:backend options']], function () {
        Route::resource('backend/options', 'Backend\OptionsController', ['as' => 'backend']);
        Route::get('backend/options/{id}/delete', ['as' => 'backend.options.delete', 'uses' => 'Backend\OptionsController@delete']);
    });
});

// Auth::routes();
Route::get('login/{social}', 'Auth\LoginController@socialLogin')->where('social', 'facebook|github|google');
Route::get('login/{social}/callback', 'Auth\LoginController@handleProviderCallback')->where('social', 'facebook|github|google');
Route::resource('posts', 'Frontend\PostsController', ['as' => 'frontend']);
Route::get('posts/{name}', ['as' => 'frontend.posts.show', 'uses' => 'Frontend\PostsController@show']);
Route::get('users/{email}', ['as' => 'frontend.users.index', 'uses' => 'Frontend\UsersController@index']);
Route::get('', ['as' => 'frontend', 'uses' => 'Frontend\HomeController@index']);
