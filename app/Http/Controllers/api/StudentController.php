<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Role;
use App\Subject;
use App\Evaluation;
use App\Advertisement;

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
            $response['status_code'] = $status_code;
            $response['subjects'] = $student->teacher_subjects;
        } catch (\Exception $e) {
            $status_code = 500;
            $response['status_code'] = $status_code;
        }

        return response()->json($response);
    }
}
