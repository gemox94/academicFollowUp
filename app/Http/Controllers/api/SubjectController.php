<?php

namespace App\Http\Controllers\api;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests;
use App\User;
use App\Role;
use App\Subject;

class SubjectController extends Controller
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

    public function create(Request $request){
        try{
            $status_code = 200;
            /*
             * Set this user as coordinator
             * 1) Update password
             * 2) Update role
             */
            $role           = Role::find(1);
            $user           = User::find($request->id);
            $user->password = bcrypt($request->password);
            $user->role()->associate($role);
            $user->save();

            $response = $user;

        }catch(\Throwable $e){
            $status_code = 500;
            $response['error_message'] = $e->getMessage();
            $response['error_type'] = 'unhandled_exception';
            $response['error_type'] = 500;
        }

        return response()->json($response, $status_code);
    }


    public function createSubject(Request $request){
        try{
            $status_code = 200;
            $teacher     = User::find($request->subject['teacher_id']);

            /*
             * Create new subject
             */
            $subject                = new Subject;
            $subject->name          = $request->subject['name'];
            $subject->nrc           = $request->subject['nrc'];
            $subject->period        = $request->subject['period'];
            $subject->key           = $request->subject['key'];
            $subject->section       = $request->subject['section'];
            $subject->schedule_json = $request->subject['schedule_json'];
            $subject->teacher()->associate($teacher);
            $subject->save();

            $response = $subject;

        }catch(\Throwable $e){
            $status_code = 500;
            $response['error_message'] = $e->getMessage();
            $response['error_type'] = 'unhandled_exception';
            $response['error_type'] = 500;
        }

        return response()->json($response, $status_code);
    }


    public function teacherSubjects($teacher_id, Request $request){
        try{
            $status_code = 200;
            $teacher     = User::find($teacher_id);

            $subjects = $teacher->subjects;

            $response = $subjects;

        }catch(\Throwable $e){
            $status_code = 500;
            $response['error_message'] = $e->getMessage();
            $response['error_type'] = 'unhandled_exception';
            $response['error_type'] = 500;
        }

        return response()->json($response, $status_code);
    }



    public function getSubject($subject_id, Request $request){
        try{
            $status_code  = 200;
            $subject      = Subject::find($subject_id);
            $response     = $subject;

        }catch(\Throwable $e){
            $status_code = 500;
            $response['error_message'] = $e->getMessage();
            $response['error_type'] = 'unhandled_exception';
            $response['error_type'] = 500;
        }

        return response()->json($response, $status_code);
    }


    public function names(Request $request){
        try{
            $status_code  = 200;
            $subjectNames = DB::table('subject_names')->select('name')->get();
            $response     = $subjectNames;

        }catch(\Throwable $e){
            $status_code = 500;
            $response['error_message'] = $e->getMessage();
            $response['error_type'] = 'unhandled_exception';
            $response['error_type'] = 500;
        }

        return response()->json($response, $status_code);
    }
}
