<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    protected $casts = ['evaluations.pivot.grade' => 'float'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /*
     * Role
     */
    public function role(){
        return $this->belongsTo('App\Role');
    }

    public function subjects(){
        return $this->HasMany('App\Subject', 'teacher_id');
    }

    public function periods(){
        return $this->hasMany('App\Period', 'cordinator_id');
    }

    public function teacher_subjects(){
        return $this->belongsToMany('App\Subject', 'student_subjects','student_id', 'subject_id')->withPivot('final_grade');
    }

    public function evaluations(){
        return $this->belongsToMany('App\Evaluation', 'student_evaluations', 'student_id', 'evaluation_id')->withPivot('grade');
    }

    public function hasRole($role){
        return $this->role->name == $role;
    }

    public function scopeWithRole($query, $role_name){
        return $query->whereHas('role', function($q) use(&$role_name){
            return $q->where('name', $role_name);
        });
    }
}
