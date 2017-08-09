<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

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
