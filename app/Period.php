<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Period extends Model
{

	public function subjects()
	{
		return $this->hasMany('App\Subject', 'period_id');
	}

    public function coordinator(){
    	return $this->belongsTo('App\User', 'cordinator_id');
    }
}
