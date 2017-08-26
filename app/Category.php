<?php

namespace App;

class Category extends Model
{
    use DeactivateTrait;

    public $timestamps = false;

    public static function numberOfBeds()
    {
        $result = static::selectRaw('number_of_beds as Anzahl')
            ->where('active', 1)
            ->groupBy('Anzahl')
            ->orderByRaw('Anzahl')
            ->get()
            ->toArray();

        $arr = [];
        foreach($result as $row)
        {
            $arr[] = $row['Anzahl'];
        }

        return $arr;
    }

    public function roomtypes()
    {
        return $this->hasMany('App\Roomtype');
    }
}
