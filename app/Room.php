<?php

namespace App;

class Room extends Model
{
    use DeactivateTrait;

    public function roomtype()
    {
        return $this->belongsTo('App\Roomtype');
    }

    public function reservations()
    {
        return $this->belongsToMany('App\Reservation');
    }
}
