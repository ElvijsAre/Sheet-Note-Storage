<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Music_orchestration extends Model
{
    public function music_orchestration() {
        
        return $this->belongsTo('App\Sheet_music');
    }
}
