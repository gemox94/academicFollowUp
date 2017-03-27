<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Evaluation extends Model
{
    protected $casts = ['percentage' => 'float'];

    public function subject(){
        return $this->belongsTo('App\Subject');
    }
}
