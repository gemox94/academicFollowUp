<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    public function teacher(){
        return $this->belongsTo('App\User', 'teacher_id');
    }

    public function evaluations(){
        return $this->hasMany('App\Evaluation');
    }

    public function students(){
        return $this->belongsToMany('App\User', 'student_subjects', 'subject_id', 'student_id')->withPivot('final_grade');
    }

    public function advertisements(){
        return $this->hasMany('App\Advertisement');
    }
}
