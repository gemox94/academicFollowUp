<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    public function teacher(){
        return $this->belongsTo('App\User', 'teacher_id');
    }
}
