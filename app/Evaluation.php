<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Evaluation extends Model
{
    public function students(){
        return $this->belongsToMany('App\Student','student_evaluation','evaluation_id','student_id');
    }

}
