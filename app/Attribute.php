<?php

namespace App;

class Attribute extends Model
{
    use InactivateTrait;

    // Timestamp ausstellen
    public $timestamps = false;

    protected $fillable = [
        'description', 'hotel_atr', 'active'
    ];

    /**
     * Deactivate Attribute
     * @return bool
     */
    public function inactivate(){
        $this->active = false;
        return $this->save();
    }

    /**
     * Gets the hotel attributes
     * @return mixed
     */
    public static function getHotelAttributes(){
        return SELF::where('hotel_atr',true)->get();
    }

    /**
     * Gets the room attributes
     * @return mixed
     */
    public static function getRoomAttributes(){
        return SELF::where('hotel_atr',false)->get();
    }
}
