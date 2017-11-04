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

    Route::group(['middleware' => ['permission:backend options']], function () {
        Route::get('backend/option/create', ['as' => 'backendOptionCreate', 'uses' => 'Backend\OptionsController@create']);
        Route::post('backend/option/create', ['as' => 'backendOptionCreate', 'uses' => 'Backend\OptionsController@create']);
        Route::get('backend/option/delete/{id}', ['as' => 'backendOptionDelete', 'uses' => 'Backend\OptionsController@delete']);
        Route::get('backend/option/update', ['as' => 'backendOptionUpdate', 'uses' => 'Backend\OptionsController@update']);
        Route::put('backend/option/update', ['as' => 'backendOptionUpdate', 'uses' => 'Backend\OptionsController@update']);
        Route::get('backend/options', ['as' => 'backendOptions', 'uses' => 'Backend\OptionsController@index']);
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
Route::get('/login/{social}', 'Auth\LoginController@socialLogin')->where('social', 'facebook|github|google');
Route::get('/login/{social}/callback', 'Auth\LoginController@handleProviderCallback')->where('social', 'facebook|github|google');
Route::get('/', function () {
    return view('welcome');
});
