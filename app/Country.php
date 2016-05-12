<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'countries';
    
    
    public function user() {
        
        return $this->hasMany('App\User');
    }
    
    public function music_author() {
        
        return $this->hasMany('App\Music_author');
    }
}
