<?php

namespace App;

class Room extends Model
{
    use InactivateTrait;

    public function roomtype()
    {
        return $this->belongsTo('App\Roomtype');
    }

    public function reservations()
    {
        return $this->belongsToMany('App\Reservation');
    }
}
