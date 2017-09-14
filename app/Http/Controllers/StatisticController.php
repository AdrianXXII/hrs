<?php

namespace App\Http\Controllers;

use App\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class StatisticController extends Controller
{
    public function index()
    {        
        $timeRange = request()->get('timerange');
        
        if($timeRange === null OR $timeRange < 30 OR $timeRange > 365)
        {
            $timeRange = 30;
        }

        $user = \Auth::user();

        if($user->getRooms()->count() === 0)
        {
            $noRoomAvailable = true;
            return view('manager.statistic.index', compact('noRoomAvailable', 'timeRange'));
        }

        $statsProfitableRooms = Room::getStatsProfitableRooms($this->getReservations($user->getRooms()), $timeRange, $user);
        $statsUsingRoom = Room::getStatsRoomUsing($this->getReservations($user->getRooms()), $timeRange, $user);
        $statsNonSeller = Room::getNonSeller($this->getReservations($user->getRooms()), $timeRange, $user);

        return view('manager.statistic.index', compact('statsProfitableRooms', 'statsUsingRoom', 'statsNonSeller', 'timeRange'));
    
    }

    public function getReservations($rooms)
    {
        $mergedReservations = null;

        foreach($rooms as $room) {
            if($mergedReservations == null) {
                $mergedReservations = $room->reservations;

                continue;
            }

            $mergedReservations = $room->reservations->merge($mergedReservations);
        }

        return $mergedReservations;
    }
}
