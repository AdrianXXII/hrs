<?php

namespace App\Http\Controllers;

use App\Hotel;
use App\Roomtype;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SearchApiController extends Controller
{
    //
    public static function search($from, $to){
        return Roomtype::searchByDate(new Carbon($from), new Carbon($to);
    }

    public static function searchHotel(Hotel $hotel, $from, $to){
        $from = new Carbon($from);
        $to = new Carbon($to);
        $today = new Carbon();
        if($hotel->isInactive() || $from->diffInDays($today) >= 0 || $to->diffInDays($today) >= 0){
            return null;
        }
        return Roomtype::searchByDateAndHotel($from, $to, $hotel);
    }
}
