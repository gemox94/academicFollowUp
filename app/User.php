<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

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

        public function hasRole($role){
        return $this->role->name == $role;
    }

    public function scopeWithRole($query, $role_name){
        return $query->whereHas('role', function($q) use(&$role_name){
            return $q->where('name', $role_name);
        });
    }
}
