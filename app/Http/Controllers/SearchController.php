<?php

namespace App\Http\Controllers;

use App\Category;
use App\Room;
use App\Roomtype;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    //

    public static function search($startDatum,$endDatum){
        $roomtypes = new Collection();
        $from = $startDatum;
        $to = $endDatum;
        $category = Category::find(1);
        //$category = null;

        if($category != null){
            return Roomtype::searchByDateAndCategory($from, $to, $category);
        } else {
            return Roomtype::searchByDate($from, $to);
        }

        return $roomtypes;
    }
}
