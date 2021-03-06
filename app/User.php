<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Collection;

class User extends Authenticatable
{
    use Notifiable;
    use DeactivateTrait;

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

    public function getHotels()
    {
        return $this->hotels()->where('active', true)->get();
    }

    public function getRooms()
    {
        $mergedRooms = null;

        foreach($this->getHotels() as $hotel)
        {
            if($hotel->getRooms() === null)
            {
                continue;
            }
            
            if($mergedRooms == null) {
                $mergedRooms = $hotel->getRooms();

                continue;
            }
            $mergedRooms = $hotel->getRooms()->merge($mergedRooms);
        }

        if($mergedRooms === null) {
            return null;
        }

        return $mergedRooms->sortBy('room_number');
    }

    public function getStaff()
    {
        $staff = null;

        if($this->group_id != Group::HOTELMANAGER) return new Collection();

        foreach($this->hotels as $hotel){

            if($staff == null) {
                $staff = $hotel->getStaff();

                continue;
            }

            $staff = $hotel->getStaff()->merge($staff);
        }
        return $staff;
    }
}
