<?php

namespace App;

class Newsletter extends Model
{
    use DeactivateTrait;

    public $timestamps = false;

    public function hotel(){
        return $this->belongsTo('App\Hotel');
    }
}
