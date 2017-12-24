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

Route::group(['middleware' => ['auth']], function () {
    Route::get('backend', ['as' => 'backend', 'uses' => 'Backend\UsersController@index']);

    Route::group(['middleware' => ['permission:backend categories']], function () {
        Route::resource('backend/categories', 'Backend\CategoriesController', ['as' => 'backend']);
        Route::get('backend/categories/{id}/delete', ['as' => 'backend.categories.delete', 'uses' => 'Backend\CategoriesController@delete']);
    });
    Route::group(['middleware' => ['permission:backend media']], function () {
        Route::resource('backend/media', 'Backend\MediaController', ['as' => 'backend']);
        Route::get('backend/media/{id}/delete', ['as' => 'backend.media.delete', 'uses' => 'Backend\MediaController@delete']);
    });
    Route::group(['middleware' => ['permission:backend options']], function () {
        Route::resource('backend/options', 'Backend\OptionsController', ['as' => 'backend']);
        Route::get('backend/options/{id}/delete', ['as' => 'backend.options.delete', 'uses' => 'Backend\OptionsController@delete']);
    });
    Route::group(['middleware' => ['permission:backend permissions']], function () {
        Route::get('backend/permission/create', ['as' => 'backendPermissionCreate', 'uses' => 'Backend\PermissionsController@create']);
        Route::post('backend/permission/create', ['as' => 'backendPermissionCreate', 'uses' => 'Backend\PermissionsController@create']);
        Route::get('backend/permission/delete/{id}', ['as' => 'backendPermissionDelete', 'uses' => 'Backend\PermissionsController@delete']);
        Route::get('backend/permission/update', ['as' => 'backendPermissionUpdate', 'uses' => 'Backend\PermissionsController@update']);
        Route::put('backend/permission/update', ['as' => 'backendPermissionUpdate', 'uses' => 'Backend\PermissionsController@update']);
        Route::get('backend/permissions', ['as' => 'backendPermissions', 'uses' => 'Backend\PermissionsController@index']);
    });
    Route::group(['middleware' => ['permission:backend roles']], function () {
        Route::get('backend/role/create', ['as' => 'backendRoleCreate', 'uses' => 'Backend\RolesController@create']);
        Route::post('backend/role/create', ['as' => 'backendRoleCreate', 'uses' => 'Backend\RolesController@create']);
        Route::get('backend/role/delete/{id}', ['as' => 'backendRoleDelete', 'uses' => 'Backend\RolesController@delete']);
        Route::get('backend/role/update', ['as' => 'backendRoleUpdate', 'uses' => 'Backend\RolesController@update']);
        Route::put('backend/role/update', ['as' => 'backendRoleUpdate', 'uses' => 'Backend\RolesController@update']);
        Route::get('backend/roles', ['as' => 'backendRoles', 'uses' => 'Backend\RolesController@index']);
    });
    Route::group(['middleware' => ['permission:backend users']], function () {
        Route::get('backend/user/create', ['as' => 'backendUserCreate', 'uses' => 'Backend\UsersController@create']);
        Route::post('backend/user/create', ['as' => 'backendUserCreate', 'uses' => 'Backend\UsersController@create']);
        Route::get('backend/user/delete/{id}', ['as' => 'backendUserDelete', 'uses' => 'Backend\UsersController@delete']);
        Route::get('backend/user/update', ['as' => 'backendUserUpdate', 'uses' => 'Backend\UsersController@update']);
        Route::put('backend/user/update', ['as' => 'backendUserUpdate', 'uses' => 'Backend\UsersController@update']);
        Route::get('backend/users', ['as' => 'backendUsers', 'uses' => 'Backend\UsersController@index']);
    });
});
// Route::get('/backend', 'Backend\HomeController@index');

Route::get('/home', 'HomeController@index')->name('home');
Route::get('locale/{locale?}', ['as' => 'locale.setlocale', 'uses' => 'Frontend\LocaleController@setLocale']);
Route::get('/login/{social}', 'Auth\LoginController@socialLogin')->where('social', 'facebook|github|google');
Route::get('/login/{social}/callback', 'Auth\LoginController@handleProviderCallback')->where('social', 'facebook|github|google');
Route::get('/', function () {
    return view('welcome');
});
