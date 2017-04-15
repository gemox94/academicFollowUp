<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Subject;
use App\User;
use App\SubjectName;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StatisticController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function section(Request $request)
    {
        $status_code = 200;
        $response    = [];

        try{
            $subjects = Subject::with('students.teacher_subjects')->get();

            foreach ($subjects as $subject) {
                $response[$subject->section]['subject_name']    = $subject->name;
                $response[$subject->section]['subject_nrc']     = $subject->nrc;
                $response[$subject->section]['subject_section'] = $subject->section;
                $response[$subject->section]['grades']['5']     = [];
                $response[$subject->section]['grades']['6']     = [];
                $response[$subject->section]['grades']['7']     = [];
                $response[$subject->section]['grades']['8']     = [];
                $response[$subject->section]['grades']['9']     = [];
                $response[$subject->section]['grades']['10']    = [];

                foreach ($subject->students as $student) {

                    if($student->pivot->final_grade <= 5){
                        array_push($response[$subject->section]['grades']['5'], [
                            'student'     => $student,
                            'final_grade' => $student->pivot->final_grade,
                        ]);
                    }

                    if($student->pivot->final_grade >= 6 && $student->pivot->final_grade < 7){
                        array_push($response[$subject->section]['grades']['6'], [
                            'student'     => $student,
                            'final_grade' => $student->pivot->final_grade,
                        ]);
                    }

                    if($student->pivot->final_grade >= 7 && $student->pivot->final_grade < 8){
                        array_push($response[$subject->section]['grades']['7'], [
                            'student'     => $student,
                            'final_grade' => $student->pivot->final_grade,
                        ]);
                    }

                    if($student->pivot->final_grade >= 8 && $student->pivot->final_grade < 9){
                        array_push($response[$subject->section]['grades']['8'], [
                            'student'     => $student,
                            'final_grade' => $student->pivot->final_grade,
                        ]);
                    }

                    if($student->pivot->final_grade >= 9 && $student->pivot->final_grade < 10){
                        array_push($response[$subject->section]['grades']['9'], [
                            'student'     => $student,
                            'final_grade' => $student->pivot->final_grade,
                        ]);
                    }

                    if($student->pivot->final_grade >= 10){
                        array_push($response[$subject->section]['grades']['10'], [
                            'student'     => $student,
                            'final_grade' => $student->pivot->final_grade,
                        ]);
                    }

                }
            }

        }catch(\Exception $e){

            $status_code             = 500;
            $response['status_code'] = $status_code;
            $response['error']       = $e->getMessage();

        }
        return response()->json($response);
    }


    /*
     *
     */
    public function index(Request $request)
    {
        $status_code = 200;
        $response    = [];

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


    /*
     * Subject statistics
     */
    public function subject(Request $request)
    {
        $status_code = 200;
        $response    = [];

        try{
            $subjectNames = SubjectName::get();

            foreach ($subjectNames as $subjectName){
                $response[$subjectName->name]['subject_name'] = $subjectName->name;
                $response[$subjectName->name]['grades']['5']  = [];
                $response[$subjectName->name]['grades']['6']  = [];
                $response[$subjectName->name]['grades']['7']  = [];
                $response[$subjectName->name]['grades']['8']  = [];
                $response[$subjectName->name]['grades']['9']  = [];
                $response[$subjectName->name]['grades']['10'] = [];

                $subjectsSameName = Subject::where('name', $subjectName->name)->with('students.teacher_subjects')->get();

                foreach ($subjectsSameName as $subject){

                    foreach($subject->students as $student){
                        if($student->pivot->final_grade <= 5){
                            array_push($response[$subjectName->name]['grades']['5'], [
                                'student'     => $student,
                                'final_grade' => $student->pivot->final_grade,
                            ]);
                        }

                        if($student->pivot->final_grade >= 6 && $student->pivot->final_grade < 7){
                            array_push($response[$subjectName->name]['grades']['6'], [
                                'student'     => $student,
                                'final_grade' => $student->pivot->final_grade,
                            ]);
                        }

                        if($student->pivot->final_grade >= 7 && $student->pivot->final_grade < 8){
                            array_push($response[$subjectName->name]['grades']['7'], [
                                'student'     => $student,
                                'final_grade' => $student->pivot->final_grade,
                            ]);
                        }

                        if($student->pivot->final_grade >= 8 && $student->pivot->final_grade < 9){
                            array_push($response[$subjectName->name]['grades']['8'], [
                                'student'     => $student,
                                'final_grade' => $student->pivot->final_grade,
                            ]);
                        }

                        if($student->pivot->final_grade >= 9 && $student->pivot->final_grade < 10){
                            array_push($response[$subjectName->name]['grades']['9'], [
                                'student'     => $student,
                                'final_grade' => $student->pivot->final_grade,
                            ]);
                        }

                        if($student->pivot->final_grade >= 10){
                            array_push($response[$subjectName->name]['grades']['10'], [
                                'student'     => $student,
                                'final_grade' => $student->pivot->final_grade,
                            ]);
                        }

                    }

                }
            }

        }catch(\Exception $e){

            $status_code             = 500;
            $response['status_code'] = $status_code;
            $response['error']       = $e->getMessage();

        }
        return response()->json($response);
    }
}
