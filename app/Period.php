<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Period extends Model
{
    public function coordinator(){
    	return $this->belongsTo('App\User', 'cordinator_id');
    }
}
