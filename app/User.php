<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'age', 'birth_date', 'gender', 'country_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'is_admin' , 'is_blocked',
    ];
    
    public function country() {
        
        return $this->belongsTo('App\Country');

    }
    
    public function posts() {
        
        return $this->hasMany('App\Post');
    }
}
