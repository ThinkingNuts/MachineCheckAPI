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
Route::group([
    'prefix' => 'v1',
    'middleware' => 'cors',
], function() {
    //Auth
    Route::post('user/login', 'AuthController@login')->name('user.login'); //登录认证
    Route::get('user/logout', 'AuthController@logout')->name('user.logout'); //退出

});

/*
|--------------------------------------------------------------------------
| 后台API
|--------------------------------------------------------------------------
*/
Route::group([
    'prefix' => 'v1',
    'middleware' => ['cors', 'jwt.auth', 'check.permission']
], function() {
    Route::get('menu', 'MenusController@getSidebarTree')->name('users.menu');
    Route::get('group_permissions', 'PermissionsController@groupPermissions');
    Route::resource('roles', 'RolesController'); // 资源路由自动命名
    Route::resource('users', 'UsersController');
    Route::resource('menus', 'MenusController');
    Route::resource('permissions', 'PermissionsController');
});