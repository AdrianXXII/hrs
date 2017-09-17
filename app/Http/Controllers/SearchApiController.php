<?php

namespace App\Http\Controllers;

use App\Hotel;
use App\Roomtype;
use Illuminate\Http\Request;

class SearchApiController extends Controller
{
    //
    public static function search($from, $to){
        return Roomtype::searchByDate($from, $to);
    }

    public static function searchHotel(Hotel $hotel, $from, $to){
        if($hotel->isInactive()){
            return null;
        }
        return Roomtype::searchByDateAndHotel($from, $to, $hotel);
    }
}
