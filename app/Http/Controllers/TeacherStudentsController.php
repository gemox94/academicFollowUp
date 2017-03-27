<?php

namespace App\Http\Controllers;

use App\Subject;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TeacherStudentsController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $students = User::where('role_id',3)->with('teacher_subjects')->get();
        return view('TeacherStudents.index')->with('students', $students);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('TeacherStudents.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function find(Request $request){
        $response = [];
        $status_code = 200;
        try{

            $student = User::where('key', $request->input('matricula'))->where('role_id',3)->first();
            $subjects = Subject::where('teacher_id', Auth::user()->id)->get();
            if ($student){
                $response['student'] = $student;
                $response['subjects'] = $subjects;
                $response['status_code'] = $status_code;
            }else{
                $status_code = 404;
                $response['status_code'] = $status_code;
                $response['message'] = 'Estudiante no encontrado';
            }

        }catch (\Exception $e){
            $status_code = 500;
            $response['status_code'] = $status_code;
            $response['error'] = $e;
        }

        return response()->json($response);
    }

    public function registerStudentSubject(Request $request){
        $response = [];
        $status_code = 200;

        try{
            $student = User::find($request->input('student_id'));

            $signed_up = false;
            foreach ($student->teacher_subjects as $teacher_subject) {
                if($teacher_subject->pivot->student_id == $student->id && $teacher_subject->pivot->subject_id ==$request->input('subject_id')){
                    $signed_up = true;
                    break;
                }
            }

            if($signed_up){
                $status_code = 403;
                $response['status_code'] = $status_code;
            }else{
                $subject = Subject::find($request->input('subject_id'));
                $subject->students()->attach($student->id, ['final_grade' => null]);
                $subject->save();

                $response['status_code'] = $status_code;
            }
        }catch (\Exception $e){
            $status_code = 500;
            $response['status_code'] = $status_code;
            $respose['error'] = $e;
        }
        return response()->json($response);
    }

    public function downPage(){
        return view('TeacherStudents.down');
    }

    public function studentSubjects(Request $request){
        $response = [];
        $status_code = 200;
        try{
            $student = User::where('key', $request->input('key'))->with('teacher_subjects')->first();
            if($student){
                $response['student'] = $student;
                $response['status_code'] = $status_code;
            }else{
                $status_code = 404;
                $response['status_code'] = $status_code;
            }
        }catch(\Exception $e){
            $status_code = 500;
            $response['status_code'] = $status_code;
            $response['error'] = $e;
        }
        return response()->json($response);
    }

    public function downStudent(Request $request){
        $response = [];
        $status_code = 200;
        try{
            /*$student = User::find($request->input('student_id'));
            $student->teacher_subjects->detach($request->input('subject_id'));
            $student->save();*/
            $subject = Subject::find($request->input('subject_id'));
            $subject->students()->detach($request->input('student_id'));
            $response['status_code'] = $status_code;

        }catch (\Exception $e){
            $status_code = 500;
            $response['status_code'] = $status_code;
            $response['error'] = $e;
        }

        return response()->json($response);
    }
}
