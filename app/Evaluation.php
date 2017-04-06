<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Evaluation extends Model
{
    protected $casts = ['percentage' => 'float'];

    public function subject(){
        return $this->belongsTo('App\Subject');
    }

    public function students(){
        return $this->belongsToMany('App\User', 'student_evaluations', 'evaluation_id', 'student_id')->withPivot('grade');
    }
}
