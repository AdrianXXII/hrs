<?php

namespace App;

class Review extends Model
{
    use DeactivateTrait;
    //

    public function hotel(){
        return $this->belongsTo('App\Hotel');
    }
}
