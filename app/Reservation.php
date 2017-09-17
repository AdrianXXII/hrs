<?php

namespace App;

use phpDocumentor\Reflection\Types\Integer;

class Reservation extends Model
{
    use DeactivateTrait;

    const STATUS_NEW = 0;
    const STATUS_CONFIRMED = 1;
    const STATUS_REJECTED = 2;
    const STATUS_CANCELLED = 3;

    public $timestamps = false;

    public function roomtype(){
        return $this->belongsTo('App\Roomtype');
    }


    public function room(){
        return $this->belongsTo('App\Room');
    }

    public static function getAvailableRooms($startDate,$endDate,$roomtype){
        return Room::getAvailbleRooms($startDate, $endDate, $roomtype);
    }

    public static function decodeStatus($satus_code){
        switch($satus_code){
            case SELF::STATUS_NEW:
                return "Neu";
                break;
            case SELF::STATUS_CONFIRMED:
                return "Bestätigt";
                break;
            case SELF::STATUS_REJECTED:
                return "Abgelent";
                break;
            case SELF::STATUS_CANCELLED:
                return "Abgesagt";
                break;
            default:
                return "N/A";

        }
    }

    public function getStatusText(){
        return SELF::decodeStatus($this->status);
    }
}
