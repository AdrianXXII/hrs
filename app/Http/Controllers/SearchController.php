<?php

namespace App\Http\Controllers;

use App\Attribute;
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
        $category = Category::find(4);
        $attributes = [
            Attribute::find(14),
            Attribute::find(1),
            Attribute::find(17)
        ];
        //$attributes = null;
        //$category = null;

        if($category != null && $attributes != null){
            $roomtypes = Roomtype::searchByDateAndAttributesAndCategory($from, $to, $attributes, $category);
        } elseif($category != null){
            $roomtypes = Roomtype::searchByDateAndCategory($from, $to, $category);
        } elseif($attributes != null) {
            $roomtypes = Roomtype::searchByDateAndAttributes($from, $to, $attributes);
        }else {
            $roomtypes = Roomtype::searchByDate($from, $to);
        }

        return $roomtypes;
    }
}
