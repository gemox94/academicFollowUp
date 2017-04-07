<?php

namespace App\Http\Controllers\api;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests;
use App\User;
use App\Role;
use App\Subject;
use App\Evaluation;

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

            /*
             * Create evaluations for this subject:
             * TAREAS
             * EXAMENES
             * PARTICIPACION
             * PROYECTO
             * PRACTICAS
             * EXPOSICION
             * OTROS
             */
            $evaluations = array('examenes', 'tareas', 'participacion', 'proyecto', 'practicas', 'exposicion', 'otros');

            foreach($evaluations as $evaluation){
                $tempEvaluation             = new Evaluation;
                $tempEvaluation->name       = $evaluation;
                $tempEvaluation->percentage = 0;
                $tempEvaluation->subject()->associate($subject);
                $tempEvaluation->save();
            }

            $response = $subject;

        }catch(\Throwable $e){
            $status_code = 500;
            $response['error_message'] = $e->getMessage();
            $response['error_type'] = 'unhandled_exception';
            $response['error_type'] = 500;
        }

        return response()->json($response, $status_code);
    }



    public function updateSubject(Request $request){
        try{
            $status_code = 200;

            /*
             * Update subject
             */
            $subject                = Subject::find($request->subject['id']);
            $subject->name          = $request->subject['name'];
            $subject->nrc           = $request->subject['nrc'];
            $subject->period        = $request->subject['period'];
            $subject->key           = $request->subject['key'];
            $subject->section       = $request->subject['section'];
            $subject->schedule_json = $request->subject['schedule_json'];
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

            $subjects = $teacher->subjects()->whereNull('status')->get();

            $response = $subjects;

        }catch(\Throwable $e){
            $status_code = 500;
            $response['error_message'] = $e->getMessage();
            $response['error_type'] = 'unhandled_exception';
            $response['error_type'] = 500;
        }

        return response()->json($response, $status_code);
    }


    public function deleteSubject($subject_id, Request $request){
        try{
            $status_code     = 200;
            $subject         = Subject::find($subject_id);
            $subject->status = 'disabled';
            $subject->save();
            $response        = "ok";

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
            $subject      = Subject::with('students.evaluations', 'evaluations')->find($subject_id);

            foreach($subject->students as $student){
                /*
                 * Initialize evaluations array
                 */
                $evaluations = array();

                foreach($student->evaluations as $evaluation){
                    /*
                     * Check if this evaluation
                     * belongs to this subject
                     */
                    if($evaluation->subject_id == $subject->id){
                        array_push($evaluations, $evaluation);
                    }
                }

                /*
                 * Assign the evaluations to the student
                 */
                $student->evaluationsOfSubject = $evaluations;
            }

            $response     = $subject;

        }catch(\Throwable $e){
            $status_code = 500;
            $response['error_message'] = $e->getMessage();
            $response['error_type'] = 'unhandled_exception';
            $response['error_type'] = 500;
        }

        return response()->json($response, $status_code);
    }


    /*
     * Save the evaluations for an specific student
     * of this subject
     */
    public function updateStudentEvaluations(Request $request){
        try{
            $status_code = 200;

            /*
             * Get student and subject
             */
            $student     = User::find($request->student['id']);
            $subject     = Subject::with('evaluations')->find($request->student['evaluationsOfSubject'][0]['subject_id']);
            $evaluations = array();
            $finalGrade  = 0;

            /*
             * For each evaluation of this subject save it
             */
            foreach($request->student['evaluationsOfSubject'] as $evaluation){
                /*
                 * Get data of relation
                 */
                $grade        = $evaluation['pivot']['grade'];
                $evaluationId = $evaluation['pivot']['evaluation_id'];
                //$evaluations[$evaluationId] = array('grade' => $grade);

                $student->evaluations()->detach($evaluationId);
                $student->evaluations()->attach($evaluationId, ['grade' => $grade]);



                /*
                 * Update final grade
                 */
                $evluationPercentage = $subject->evaluations()->find($evaluationId)->percentage;
                $tempEvaluation      = ($grade * $evluationPercentage) / 100;
                /*
                 * Add to final grade
                 */
                $finalGrade += $tempEvaluation;
            }


            /*
             * Update relation with sync
             * Sync expects an array of id's as first argument
             */
            //$student->evaluations()->sync($evaluations);


            /*
             * Update the final grade
             */
// :DELETE: Sync deletes all relations
            //$finalGradeArray[$subject->id] = array('final_grade' => $finalGrade);
            //$student->teacher_subjects()->sync($finalGradeArray);
            $student->teacher_subjects()->detach($subject->id);
            $student->teacher_subjects()->attach($subject->id, ['final_grade' => $finalGrade]);

            $response = $student;

        }catch(\Throwable $e){
            $status_code = 500;
            $response['error_message'] = $e->getMessage();
            $response['error_type'] = 'unhandled_exception';
            $response['error_type'] = 500;
        }

        return response()->json($response, $status_code);
    }



    /*
     * Save the evaluations for this subject
     */
    public function saveEvaluations($subject_id, Request $request){
        try{
            $status_code = 200;
            $subject     = Subject::with('evaluations')->find($subject_id);

            /*
             * Save all evaluations for this subject
             */
            foreach($request->subject['evaluations'] as $evaluation){
                $ev             = $subject->evaluations()->where('name', $evaluation['name'])->first();
                $ev->percentage = $evaluation['percentage'];
                $ev->save();
            }

            $response['msg'] = 'save';

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
