<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    public function subjects(){
        return $this->belongsToMany('App\Subject','student_subject','student_id','subject_id');
    }

    public function evaluations(){
        return $this->belongsToMany('App\Evaluation');
    }
}
