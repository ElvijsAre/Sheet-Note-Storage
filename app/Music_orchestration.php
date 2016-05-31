<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Music_orchestration extends Model
{
    public function sheet_music() {
        
        return $this->belongsTo('App\Sheet_music');
    }
}
