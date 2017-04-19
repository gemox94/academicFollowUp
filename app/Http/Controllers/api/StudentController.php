<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Role;
use App\Subject;
use App\Evaluation;
use App\Advertisement;
use App\Period;

class StudentController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /*
     * Get advertisements for this student
     * Filtered by Subject
     */
    public function getAdvertisements($student_id, Request $request){
        try{
            $status_code  = 200;
            $student      = User::with('teacher_subjects.advertisements')->find($student_id);

            $response     = $student->teacher_subjects;

        }catch(\Throwable $e){
            $status_code = 500;
            $response['error_message'] = $e->getMessage();
            $response['error_type'] = 'unhandled_exception';
            $response['error_type'] = 500;
        }

        return response()->json($response, $status_code);
    }

    public function getSubjects($student_id){
        $status_code = 200;
        $response = [];

        try {
            $student = User::find($student_id);
            $period = Period::where('status', 'active')->first();
            $active_subjects = [];
            $subjects = $student->teacher_subjects;

            foreach ($subjects as $subject) {
                if($subject->period->status === 'active' && $subject->status !== 'disabled'){
                    array_push($active_subjects, $subject);
                }
            }    

            $response['status_code'] = $status_code;
            $response['subjects'] = $active_subjects;
        } catch (\Exception $e) {
            $status_code = 500;
            $response['status_code'] = $status_code;
        }

        return response()->json($response);
    }

    public function getTeachers(){
        $status_code = 200;
        $response = [];

        try {

            $teacher_rol = Role::where('name', 'teacher')->first();
            $teachers = User::where('role_id', $teacher_rol->id)->get();

            $response['status_code'] = $status_code;
            $response['teachers'] = $teachers;
            
        } catch (\Exception $e) {
            $status_code = 500;
            $response['status_code'] = $status_code;
            $response['error'] = $e;
        }

        return response()->json($response);
    }

    public function getGrades($student_id, $subject_id){
        $status_code = 200;
        $response = [];

        try{

            $response['status_code'] = $status_code;
            $response['evaluations'] = User::find($student_id)->evaluations();


        }catch (\Exception $e){
            $status_code = 500;
            $response['status_code'] = $status_code;
            $response['error'] = $e;
        }

        return response()->json($response);
    }

}
