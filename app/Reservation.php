<?php

namespace App;

class Reservation extends Model
{
    use DeactivateTrait;

    const STATUS_NEW = 0;
    const STATUS_CONFIRMED = 1;
    const STATUS_REJECTED = 2;
    const STATUS_CANCELLED = 3;

    public function roomtype(){
        return $this->belongsTo('App\Roomtype');
    }


    public function room(){
        return $this->belongsTo('App\Room');
    }

    public static function getAvailableRooms($startDate,$endDate,$roomtype){
        return Room::getAvailbleRooms($startDate, $endDate, $roomtype);
    }
}
