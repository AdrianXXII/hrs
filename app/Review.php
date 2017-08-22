<?php

namespace App;

class Review extends Model
{
    use InactivateTrait;
    //

    public function hotel(){
        return $this->belongsTo('App\Hotel');
    }
}
