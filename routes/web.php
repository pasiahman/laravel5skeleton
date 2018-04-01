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
    Route::group(['middleware' => ['permission:backend custom links']], function () {
        Route::resource('backend/custom-links', 'Backend\CustomLinksController', ['as' => 'backend']);
        Route::get('backend/custom-links/{id}/delete', ['as' => 'backend.custom-links.delete', 'uses' => 'Backend\CustomLinksController@delete']);
        Route::get('backend/custom-links/{id}/trash', ['as' => 'backend.custom-links.trash', 'uses' => 'Backend\CustomLinksController@trash']);
    });
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
    Route::group(['middleware' => ['permission:backend pages']], function () {
        Route::resource('backend/pages', 'Backend\PagesController', ['as' => 'backend']);
        Route::get('backend/pages/{id}/delete', ['as' => 'backend.pages.delete', 'uses' => 'Backend\PagesController@delete']);
        Route::get('backend/pages/{id}/trash', ['as' => 'backend.pages.trash', 'uses' => 'Backend\PagesController@trash']);
    });
    Route::group(['middleware' => ['permission:backend posts']], function () {
        Route::resource('backend/posts', 'Backend\PostsController', ['as' => 'backend']);
        Route::get('backend/posts/{id}/delete', ['as' => 'backend.posts.delete', 'uses' => 'Backend\PostsController@delete']);
        Route::get('backend/posts/{id}/trash', ['as' => 'backend.posts.trash', 'uses' => 'Backend\PostsController@trash']);
    });
});

// Auth::routes();
Route::get('login/{social}', 'Auth\LoginController@socialLogin')->where('social', 'facebook|github|google');
Route::get('login/{social}/callback', 'Auth\LoginController@handleProviderCallback')->where('social', 'facebook|github|google');
Route::resource('posts', 'Frontend\PostsController', ['as' => 'frontend']);
Route::get('posts/{name}', ['as' => 'frontend.posts.show', 'uses' => 'Frontend\PostsController@show']);
Route::get('users/{email}', ['as' => 'frontend.users.index', 'uses' => 'Frontend\UsersController@index']);
Route::get('', ['as' => 'frontend', 'uses' => 'Frontend\HomeController@index']);
