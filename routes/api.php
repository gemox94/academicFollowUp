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

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});

/*
 * Create a coordinator
 */
Route::post('coordinator/new', 'api\CoordinatorController@create');


/*
 * Routes for subjects
 */
Route::get('subjects/{teacher_id}/teacher', 'api\SubjectController@teacherSubjects');
Route::get('subjects/names', 'api\SubjectController@names');
Route::get('subjects/{id}', 'api\SubjectController@getSubject');
Route::post('subjects/create', 'api\SubjectController@createSubject');
Route::post('subjects/update', 'api\SubjectController@updateSubject');
Route::post('subjects/{id}/delete', 'api\SubjectController@deleteSubject');
Route::post('subjects/{id}/saveEvaluations', 'api\SubjectController@saveEvaluations');
Route::post('subjects/{id}/createAdvertisement', 'api\SubjectController@createAdvertisement');
Route::post('subjects/{id}/editAdvertisement', 'api\SubjectController@editAdvertisement');
Route::delete('subjects/{id}/deleteAdvertisement/{advertisement_id}', 'api\SubjectController@deleteAdvertisement');
Route::post('student/{id}/updateStudentEvaluations', 'api\SubjectController@updateStudentEvaluations');

/*
 * Routes for advertisements on coordinator
 */
Route::post('coordinator/{id}/createAdvertisement', 'api\CoordinatorController@createAdvertisement');
Route::post('coordinator/{id}/editAdvertisement', 'api\CoordinatorController@editAdvertisement');
Route::delete('coordinator/{id}/deleteAdvertisement/{advertisement_id}', 'api\CoordinatorController@deleteAdvertisement');
Route::get('coordinator/{id}/getAdvertisements', 'api\CoordinatorController@getAdvertisements');

/**
 * Routes for periods on coordinator
 */
Route::get('coordinator/periods', 'api\CoordinatorController@getPeriods');
Route::post('coordinator/periods', 'api\CoordinatorController@createPeriod');
Route::get('coordinator/subjects', 'api\CoordinatorController@getSubjects');

/**
 * Routes for statistics
 */
Route::post('/statistics', 'api\StatisticController@index');
Route::get('/statistics/section', 'api\StatisticController@section');
Route::get('/statistics/subject', 'api\StatisticController@subject');


/*
 * Routes for students
 */
Route::get('student/{id}/getAdvertisements', 'api\StudentController@getAdvertisements');
Route::get('student/{id}/subjects', 'api\StudentController@getSubjects');
Route::get('student/teachers', 'api\StudentController@getTeachers');


/*
 * Routes specific for profesor
 */
Route::get('teacher/{id}/getAdvertisements', 'api\TeacherController@getAdvertisements');
