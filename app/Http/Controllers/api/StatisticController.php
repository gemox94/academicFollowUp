<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StatisticController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $status_code = 200;
        $response = [];
        try{
            $subjects = Subject::where('teacher_id', $request->input('teacher_id'))->with('students.teacher_subjects')->get();
            foreach ($subjects as $subject) {
                $response[$subject->nrc]['subject_name'] = $subject->name;
                $response[$subject->nrc]['subject_nrc'] = $subject->nrc;
                $response[$subject->nrc]['failed'] = [];
                $response[$subject->nrc]['passed'] = [];
                $response[$subject->nrc]['e_6'] = [];
                $response[$subject->nrc]['e_7'] = [];
                $response[$subject->nrc]['e_8'] = [];
                $response[$subject->nrc]['e_9'] = [];
                $response[$subject->nrc]['e_10'] = [];
                foreach ($subject->students as $student) {

                    if($student->pivot->final_grade <= 5){
                        array_push($response[$subject->nrc]['failed'], [
                            'student' => $student,
                            'final_grade' => $student->pivot->final_grade,
                        ]);
                    }else{
                        array_push($response[$subject->nrc]['passed'], [
                            'student' => $student,
                            'final_grade' => $student->pivot->final_grade,
                        ]);
                    }

                    if($student->pivot->final_grade >= 6 && $student->pivot->final_grade < 7){
                        array_push($response[$subject->nrc]['e_6'], [
                            'student' => $student,
                            'final_grade' => $student->pivot->final_grade,
                        ]);
                    }

                    if($student->pivot->final_grade >= 7 && $student->pivot->final_grade < 8){
                        array_push($response[$subject->nrc]['e_7'], [
                            'student' => $student,
                            'final_grade' => $student->pivot->final_grade,
                        ]);
                    }

                    if($student->pivot->final_grade >= 8 && $student->pivot->final_grade < 9){
                        array_push($response[$subject->nrc]['e_8'], [
                            'student' => $student,
                            'final_grade' => $student->pivot->final_grade,
                        ]);
                    }

                    if($student->pivot->final_grade >= 9 && $student->pivot->final_grade < 10){
                        array_push($response[$subject->nrc]['e_9'], [
                            'student' => $student,
                            'final_grade' => $student->pivot->final_grade,
                        ]);
                    }

                    if($student->pivot->final_grade >= 10){
                        array_push($response[$subject->nrc]['e_10'], [
                            'student' => $student,
                            'final_grade' => $student->pivot->final_grade,
                        ]);
                    }

                }
            }
            

        }catch(\Exception $e){

            $status_code = 500;
            $response['status_code'] = $status_code;
            $response['error'] = $e;

        }
        return response()->json($response);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
}
