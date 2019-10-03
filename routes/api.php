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

Route::middleware('auth:api')->get('/userx', function (Request $request) {
    return $request->user();
});

Route::get('user', 'UserController@getByParams');
Route::get('user/{id}', 'UserController@getById');

//-----------------------------------------------------------------------------------
Route::post('param', 'ParamController@create');
Route::get('param', 'ParamController@getByParams');
Route::get('param/groups', 'ParamController@getGroups');
Route::get('param/{id}', 'ParamController@getById')->where('id', '[0-9]+');
Route::delete('param', 'ParamController@delete');
Route::put('param', 'ParamController@update');
Route::patch('param/toggle', 'ParamController@toggle');
//-----------------------------------------------------------------------------------
Route::get('page', 'PageController@getByParams');
Route::get('page/{id}', 'PageController@getById')->where('id', '[0-9]+');
Route::post('page', 'PageController@create');
Route::put('page', 'PageController@update');
Route::patch('page/toggle', 'PageController@toggle');
Route::delete('page', 'PageController@delete');
//-----------------------------------------------------------------------------------
Route::get('role', 'RoleController@all');
Route::get('role/{id}', 'RoleController@getById')->where('id', '[0-9]+');
Route::get('role/{roleId}/pages', 'RoleController@getPages');
Route::get('role/{roleId}/available', 'RoleController@getAvailablePage');
Route::get('role/{roleId}/users', 'RoleController@getUsers');
Route::post('role/user', 'RoleController@addUserToRole');
Route::delete('role/user', 'RoleController@deleteUserRole');
Route::post('role/page/access', 'RoleController@addPageAccess');
Route::delete('role/page/access', 'RoleController@deletePageAccess');
Route::post('role', 'RoleController@create');
Route::put('role', 'RoleController@update');
Route::patch('role/toggle', 'RoleController@toggle');
Route::delete('role', 'RoleController@delete');

//-----------------------------------------------------------------------------------
Route::post('images/up', 'UploadController@uploadImg');

//-----------------------------------------------------------------------------------
Route::post('soal', 'SoalController@create');
Route::get('soal', 'SoalController@getByParams');
Route::delete('soal', 'SoalController@delete');
Route::patch('soal/toggle', 'SoalController@toggle');
Route::put('soal', 'SoalController@update');
Route::get('soal/{id}', 'SoalController@getById')->where('id', '[0-9]+');

//-----------------------------------------------------------------------------------
Route::get('mapel', 'MapelController@getMapel');

//-----------------------------------------------------------------------------------
Route::get('kd', 'KdController@getKd');
Route::get('kd/ranah', 'KdController@getRanahByKd');
Route::get('kd/indicator', 'KdController@getIndicator');

//-----------------------------------------------------------------------------------
Route::get('ranah', 'RanahController@getByParams');

//-----------------------------------------------------------------------------------
Route::get('rancangan', 'RancanganController@getByParams');
Route::post('rancangan', 'RancanganController@create');
Route::delete('rancangan', 'RancanganController@delete');
Route::patch('rancangan/toggle', 'RancanganController@toggle');
Route::put('rancangan', 'RancanganController@update');
Route::get('rancangan/{id}', 'RancanganController@getById')->where('id', '[0-9]+');

//-----------------------------------------------------------------------------------
Route::get('exam', 'ExamController@getByParams');

