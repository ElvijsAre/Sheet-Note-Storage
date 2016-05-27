<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sheet_music extends Model
{
    public function user() {
        
        return $this->belongsTo('App\User');
    }
    
    public function music_author() {
        
        return $this->belongsToMany('App\Music_author', 'sheet_music_authors', 'sheet_music_id', 'music_author_id')->withTimestamps();
    }
    
    public function music_categories() {
        
        return $this->belongsToMany('App\Music_categories', 'sheet_music_categories', 'sheet_music_id', 'music_category_id')->withTimestamps();
    }
    public function music_orchestration() {
        
        return $this->hasMany('App\Music_orchestration');
    }
}
