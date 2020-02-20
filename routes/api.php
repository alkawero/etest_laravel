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
Route::get('user/student/', 'UserController@getUserStudent');
Route::get('user/{id}', 'UserController@getById');
Route::post('loginx', 'UserController@login');

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
Route::post('audios/up', 'UploadController@uploadAudio');

//-----------------------------------------------------------------------------------
Route::post('soal', 'SoalController@create');
Route::get('soal', 'SoalController@getByParams');
Route::delete('soal', 'SoalController@delete');
Route::patch('soal/toggle', 'SoalController@toggle');
Route::put('soal', 'SoalController@update');
Route::get('soal/{id}', 'SoalController@getById')->where('id', '[0-9]+');
Route::post('option/image', 'SoalController@saveImageOption');
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
Route::patch('rancangan/status', 'RancanganController@changeStatus');
Route::patch('rancangan/revise', 'RancanganController@changeToRevision');
Route::patch('rancangan/reject', 'RancanganController@changeToReject');
Route::patch('rancangan/approve', 'RancanganController@changeToApprove');
Route::put('rancangan', 'RancanganController@update');
Route::get('rancangan/{id}', 'RancanganController@getById')->where('id', '[0-9]+');
Route::post('rancangan/review', 'RancanganController@sendToReviewer');

//-----------------------------------------------------------------------------------
Route::get('exam', 'ExamController@getByParams');
Route::post('exam', 'ExamController@create');
Route::post('exam/answer', 'ExamController@saveAnswer');
Route::post('exam/finish', 'ExamController@finish');
Route::delete('exam', 'ExamController@delete');
Route::put('exam', 'ExamController@update');
Route::patch('exam/toggle', 'ExamController@toggle');
Route::patch('exam/activity', 'ExamController@updateActivity');
Route::get('exam/{id}', 'ExamController@getById')->where('id', '[0-9]+');
Route::get('exam/detail/{id}', 'ExamController@getDetailById')->where('id', '[0-9]+');
Route::get('exam/users', 'ExamController@getUserParticipants');
Route::put('exam/users', 'ExamController@updateUserParticipants');
Route::get('exam/activity/status', 'ExamController@getActivityStatus');
Route::get('exam/users/print', 'ExamController@printSnappyPdfExamCard');

//-----------------------------------------------------------------------------------
Route::get('note', 'NoteController@getByParams');
Route::post('note', 'NoteController@create');

//-----------------------------------------------------------------------------------
Route::get('subject/reviewer', 'SubjectReviewerController@getByParams');
Route::post('subject/reviewer', 'SubjectReviewerController@create');
Route::put('subject/reviewer', 'SubjectReviewerController@update');
Route::delete('subject/reviewer', 'SubjectReviewerController@delete');

//-----------------------------------------------------------------------------------
Route::get('kelas', 'KelasController@getKelas');
Route::get('kelas/student', 'KelasController@getStudents');
Route::get('kelas/many/student', 'KelasController@getStudentsFromArrayClass');

//-----------------------------------------------------------------------------------
Route::get('math', 'UtilityController@getMathFormula');
Route::put('math', 'UtilityController@updateMathFormula');
Route::post('math', 'UtilityController@createMathFormula');

//-----------------------------------------------------------------------------------
Route::get('result/nis', 'ResultController@getResultOfNis');
Route::get('result/kelas', 'ResultController@getResultOfKelas');

//-----------------------------------------------------------------------------------
Route::get('log', 'LogController@getByParams');
