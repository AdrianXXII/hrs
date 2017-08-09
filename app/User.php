<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'firstname', 'lastname', 'active'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function group(){
        return $this->belongsTo('App\Group');
    }

    public function hotels(){
        return $this->belongsToMany('App\Hotel', 'hotel_user');
    }

    public function isResponsibleFor(Hotel $hotel){
        return $this->hotels->has($hotel);
    }

    public function notResponsibleFor(Hotel $hotel){
        return !($this->isResponsibleFor($hotel));
    }

    public function inGroup(Group $group){
        return $this->group == $group;
    }
}
