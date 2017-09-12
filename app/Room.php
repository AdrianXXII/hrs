<?php

namespace App;

use Carbon\Carbon;

class Room extends Model
{
    use DeactivateTrait;

    public $timestamps = false;

    public function roomtype()
    {
        return $this->belongsTo('App\Roomtype');
    }

    public function reservations()
    {
        return $this->hasMany('App\Reservation');
    }

    public static function getAvailbleRooms($startDate,$endDate,$roomtype)
    {
        return self::where('active',true)->where('roomtype_id', $roomtype->id)->whereDoesntHave('reservations', function($q) use ($startDate,$endDate) {
            $q->where('reservation_start','>=',$startDate)->where('reservation_end','<=',$endDate);
        })->get();
    }

    public static function getStatsProfitableRooms($reservations, $lastDays)
    {
        $relevantReservations = [];

        foreach($reservations as $reservation)
        {
            $relevantReservations[] = $reservation->id;
        }

        return \DB::table('reservations')->selectRaw('room_id, sum(price) as sum')
                                      ->where('active', true)
                                      ->where('status', Reservation::STATUS_CONFIRMED)
                                      ->where('reservation_start', '<=', Carbon::now())
                                      ->where('reservation_start', '>=', Carbon::now()->subDays($lastDays))
                                      ->whereIn('id', $relevantReservations)
                                      ->groupBy('room_id')
                                      ->orderBy('sum', 'desc')
                                      ->pluck('sum', 'room_id');
    }

    public static function getStatsRoomUsing($reservations, $lastDays)
    {
        $relevantReservations = [];

        foreach($reservations as $reservation)
        {
            $relevantReservations[] = $reservation->id;
        }

        $subQuery = \DB::table('reservations')->selectRaw('id, room_id, DATEDIFF(reservation_end, reservation_start) as days')
                                      ->where('active', true)
                                      ->where('status', Reservation::STATUS_CONFIRMED)
                                      ->where('reservation_start', '<=', Carbon::now())
                                      ->where('reservation_start', '>=', Carbon::now()->subDays($lastDays))
                                      ->whereIn('id', $relevantReservations);

        return \DB::table(\DB::raw("({$subQuery->toSql()}) as sub"))
                    ->selectRaw('room_id, sum(days) as sum')
                    ->groupBy('room_id')->mergeBindings($subQuery)->get();
    }
}
