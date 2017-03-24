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
Route::post('subjects/create', 'api\SubjectController@createSubject');
