<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;
use App\User;

/**
 *
 */
class CardexController extends Controller
{

    public function index($id){
        $student = User::with('teacher_subjects.evaluations')->find($id);
        return view('students.cardex')->with('student', $student);
    }
}
