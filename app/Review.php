<?php

namespace App;

class Review extends Model
{
    use DeactivateTrait;
    //

    public $timestamps = false;

    public function hotel(){
        return $this->belongsTo('App\Hotel');
    }
}
