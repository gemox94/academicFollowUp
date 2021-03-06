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
Route::get('/', function () {
    if(Auth::check()){
        return redirect('dashboard');
    }

    return view('welcome');
});

Route::get('/login', function () {
    return redirect('/');
});


Route::post('/login', 'Auth\\LoginController@login');
Route::get('/logout', 'Auth\\LoginController@logout');
Route::post('/auth/emailExists', 'Auth\\EmailController@emailExists');

Route::get('/register/view', 'Auth\RegisterController@registerView');
Route::post('/register', 'Auth\RegisterController@create');

/*
 * Vista de inicio
 */
Route::get('/dashboard', 'HomeController@index');
Route::get('/coordinator_register', 'HomeController@coordinatorRegisterView');

/*
 * Teacher's Students
 */
Route::post('/student/subjects', 'TeacherStudentsController@studentSubjects');

Route::post('/teacher_students/find', 'TeacherStudentsController@find');
Route::post('/teacher_students/register_student', 'TeacherStudentsController@registerStudentSubject');
Route::get('/teacher_students/down_page', 'TeacherStudentsController@downPage');
Route::post('/teacher_students/down', 'TeacherStudentsController@downStudent');
Route::get('/teacher_students/{key}/create', 'TeacherStudentsController@create');
Route::resource('/teacher_students', 'TeacherStudentsController');

/*
 * Subjects' Routes
 */
Route::get('/subjects', 'HomeController@SubjectsView');
Route::get('/subjects/create', 'HomeController@newSubjectView');
Route::get('/subjects/{id}', 'HomeController@showSubjectView');

/*
 * Advertisements views
 */
Route::get('/student/advertisements', 'HomeController@studentAdvertisementsView');
Route::get('/teacher/advertisements', 'HomeController@teacherAdvertisementsView');
Route::get('/coordinator/advertisements', 'HomeController@coordinatorAdvertisementsView');


/*
 * Students' Routes (cardex)
 */
Route::get('/students/{id}/cardex', 'CardexController@index');
Route::get('/subjects/{id}/evaluateStudents', 'HomeController@evaluateStudents');
Route::get('/student/teachers', 'HomeController@studentTeachers');
Route::get('/student/subjects', 'HomeController@studentSubjects');
Route::get('/student/info', 'HomeController@studentInfo');

/*
 * Statistics' Routes
 */

Route::get('/statistics', 'HomeController@indexStatistics');
Route::get('/statistics/section', 'HomeController@sectionStatistics');
Route::get('/statistics/subject', 'HomeController@subjectStatistics');

/*
 * Cordinator's Routes
 */
Route::get('/coordinator/periods', 'HomeController@periodsView');
Route::get('/coordinator/academicProgrmmation', 'HomeController@academicProgrmmationView');
