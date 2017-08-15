<?php

namespace App;

class Hotel extends Model
{
    public $timestamps = false;

    public function users()
    {
        return $this->belongsToMany('App\User', 'hotel_user');
    }

    public function reviews()
    {
        return $this->hasMany('App\Review');
    }

    public function attributes()
    {
        return $this->belongsToMany('App\Attribute', 'attribute_hotel');
    }

    public function roomtypes()
    {
        return $this->hasMany('App\Roomtype');
    }

    public function isManagedBy(User $user)
    {
        return count($this->users->where('id', $user->id));
    }
}
