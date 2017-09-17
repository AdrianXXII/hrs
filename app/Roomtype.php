<?php

namespace App;

use Illuminate\Database\Eloquent\Collection;

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

    public function getData()
    {
        return $this->title . ' (' . $this->category->number_of_beds . ' Bettzimmer, ' . $this->price . ' CHF)';
    }

    public function getRooms()
    {
        return $this->rooms()->where('active', true)
            ->get();
    }

    public function hasAttribute(Attribute $attribute)
    {
        return count($this->attributes()->get()->where('id', $attribute->id));
    }

    public function syncAttributes(array $attributeId = null)
    {
        $this->attributes()->sync($attributeId);
    }

    public static function searchByDate($startDate,$endDate)
    {
        $rooms = Room::searchByDate($startDate,$endDate);
        $roomtypes = new Collection();
        $lastroom = null;
        $i = 0;
        foreach($rooms as $room){
            if($lastroom != null && $room->roomtype->id == $lastroom->id){
                $lastroom->number_of_available_rooms += 1;
            } else {
                $roomtypes->push($room->roomtype);
                $lastroom = $room->roomtype;
                $lastroom->number_of_available_rooms = 1;
            }
        }
        return $roomtypes;
    }

    public static function searchByDateAndHotel($startDate,$endDate,$hotel){
        $roomtypes = self::searchByDate($startDate,$endDate);
        return $roomtypes->filter(function($value, $key) use ($hotel){
            return ($value->hotel->id == $hotel->id);
        });
    }

    public static function searchByDateAndAttributes($startDate,$endDate,$attributes){
        $roomtypes = self::searchByDate($startDate,$endDate);
        return $roomtypes->filter(function($value) use ($attributes){
            $allowed = true;
            foreach($attributes as $attribute){
                if($attribute->hotel_atr == true){
                    $allowed = ($allowed && $value->hotel->attributes()->get()->contains($attribute));
                } else {
                    $allowed = ($allowed && $value->attributes()->get()->contains($attribute));
                }
            }
            return $allowed;
        });
    }

    public static function searchByDateAndCategory($startDate,$endDate,$category)
    {
        $roomtypes = self::searchByDate($startDate,$endDate);
        return $roomtypes->filter(function($value, $key) use ($category){
            return ($value->category->id == $category->id);
        });
    }

    public static function searchByDateAndAttributesAndCategory($startDate,$endDate,$attributes,$category)
    {
        $roomtypes = self::searchByDate($startDate,$endDate);
        return $roomtypes->filter(function($value) use ($category, $attributes){
            $allowed = ($value->category->id == $category->id);
            foreach($attributes as $attribute){
                if($attribute->hotel_atr == true){
                    $allowed = ($allowed && $value->hotel->attributes()->get()->contains($attribute));
                } else {
                    $allowed = ($allowed && $value->attributes()->get()->contains($attribute));
                }
            }
            return $allowed;
        });
    }
}
