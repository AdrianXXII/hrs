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
        foreach($rooms as $room){
            $roomtypes->push($room->roomtype);
        }
        return $roomtypes;
    }

    public static function searchByDateAndAttributes($startDate,$endDate,$attributes)
    {
        $roomtypes = self::searchByDate($startDate,$endDate);
        $roomtypes->wherein('attributes',$attributes)->whereHave('hotel',function($q) use ($attributes){
            $q->wherein('attributes',$attributes);
        })->all();
    }

    public static function searchByDateAndCategory($startDate,$endDate,$category)
    {
        $roomtypes = self::searchByDate($startDate,$endDate);
        $roomtypes->where('category_id',$category->id)->all();
    }

    public static function searchByDateAndAttributesAndCategory($startDate,$endDate,$attributes,$category)
    {
        $roomtypes = self::searchByDate($startDate,$endDate);
        $roomtypes->where('category',$category)->wherein('attributes',$attributes)->whereHave('hotel',function($q) use ($attributes){
            $q->wherein('attributes',$attributes);
        })->all();
    }
}
