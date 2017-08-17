<?php

namespace App;

class Hotel extends Model
{
    use InactivateTrait;

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

    public function addUser(User $user)
    {
        if (! $user->active OR $user->group_id == Group::ADMINISTRATOR OR $this->isManagedBy($user))
        {
            return false;
        }

        $this->users()->attach($user);

        return true;
    }

    public function syncUsers(array $usersId = null)
    {
        $this->users()->sync($usersId);
    }
}
