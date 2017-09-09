<?php

namespace App;

class Room extends Model
{
    use DeactivateTrait;

    public $timestamps = false;

    public function roomtype()
    {
        return $this->belongsTo('App\Roomtype');
    }

    public function reservations()
    {
        return $this->hasMany('App\Reservation');
    }

    public static function getAvailbleRooms($startDate,$endDate,$roomtype)
    {
        return self::where('active',true)->where('roomtype_id', $roomtype->id)->whereDoesntHave('reservations', function($q) use ($startDate,$endDate) {
            $q->where('reservation_start','>=',$startDate)->where('reservation_end','<=',$endDate);
        })->get();
    }
}
