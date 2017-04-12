<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Advertisement extends Model
{
    public function subject(){
        return $this->belongsTo('App\Subject');
    }
}
