<?php

namespace App;

class Group extends Model
{
    const ADMINISTRATOR = 1;
    const HOTELMANAGER = 2;
    const HOTELANGESTELLTER = 3;
    //
    public function users(){
        return $this->hasMany('App\User');
    }
}
