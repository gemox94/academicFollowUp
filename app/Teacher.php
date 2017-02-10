<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    public function cordinator(){
        return $this->hasOne('App\Cordinator','teacher_id');
    }

    public function subjects(){
        return $this->belongsToMany('App\Subject','teacher_subject','teacher_id','subject_id');
    }
}
