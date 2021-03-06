<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard');
    }

    public function coordinatorRegisterView()
    {
        return view('Auth.registerCoordinator');
    }

    public function SubjectsView(){
        return view('subjects.index');
    }

    public function newSubjectView(Request $request){
        return view('subjects.subject')->with([ 'subject_id' =>  0,
                                                'title'      => 'Nueva Materia']);
    }

    public function showSubjectView($id, Request $request) {
        return view('subjects.subject')->with(['subject_id' => $id,
                                               'title' => 'Editar Materia']);
    }

    public function evaluateStudents(){
        return view('subjects.evaluateStudents');
    }

    public function indexStatistics(){
        return view('statistics.index');
    }

    public function studentAdvertisementsView(){
        return view('students.advertisements');
    }


    public function coordinatorAdvertisementsView(){
        return view('coordinator.advertisements');
    }

    public function teacherAdvertisementsView(){
        return view('teacher.advertisements');
    }

    public function studentSubjects(){
        return view('students.subjects');
    }

    public function periodsView(){
        return view('coordinator.periods');
    }

    public function sectionStatistics(){
        return view('statistics.section');
    }

    public function subjectStatistics(){
        return view('statistics.subject');
    }

    public function academicProgrmmationView(){
        return view('coordinator.academicProgrammation');
    }

    public function studentTeachers(){
        return view('students.teachers');
    }

    public function studentInfo(){
        return view('students.info');
    }
}
