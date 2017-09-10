<?php

namespace App;

class Newsletter extends Model
{
    use DeactivateTrait;

    public function hotel(){
        return $this->belongsTo('App\Hotel');
    }
}
