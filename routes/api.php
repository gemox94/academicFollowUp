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
Route::post('student/{id}/updateStudentEvaluations', 'api\SubjectController@updateStudentEvaluations');
