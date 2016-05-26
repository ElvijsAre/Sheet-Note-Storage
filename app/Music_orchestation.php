<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Music_orchestation extends Model
{
    public function music_orchestation() {
        
        return $this->belongsTo('App\Sheet_music');
    }
}
