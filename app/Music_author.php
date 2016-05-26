<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Music_author extends Model
{
    public function user() {
        
        return $this->belongsTo('App\User');
    }
    
    public function country() {
        
        return $this->belongsTo('App\Country');
    }
    
    public function sheet_music() {
        
        return $this->belongsToMany('App\Sheet_music', 'sheet_music_authors', 'sheet_music_id', 'music_author_id')->withTimestamps();
    }
}
