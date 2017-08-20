<?php

namespace App;

class Category extends Model
{
    use InactivateTrait;

    public $timestamps = false;

    public function roomtypes()
    {
        return $this->hasMany('App\Roomtype');
    }
}
