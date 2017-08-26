<?php

namespace App;

class Roomtype extends Model
{
    use DeactivateTrait;

    public $timestamps = false;

    public function hotel()
    {
        return $this->belongsTo('App\Hotel');
    }

    public function attributes()
    {
        return $this->belongsToMany('App\Attribute', 'attribute_room');
    }

    public function rooms()
    {
        return $this->hasMany('App\Room');
    }

    public function reservations()
    {
        return $this->belongsToMany('App\Reservation');
    }

    public function category()
    {
        return $this->belongsTo('App\Category');
    }
}
