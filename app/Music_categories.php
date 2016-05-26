<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Music_categories extends Model
{
    public function sheet_music() {
        
        return $this->belongsToMany('App\Sheet_music', 'sheet_music_categories', 'sheet_music_id', 'music_category_id')->withTimestamps();
    }
}
