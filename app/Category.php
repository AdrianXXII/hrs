<?php

namespace App;

class Category extends Model
{
    public function roomtypes()
    {
        return $this->hasMany('App\Roomtype');
    }
}
