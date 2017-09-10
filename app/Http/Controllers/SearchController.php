<?php

namespace App\Http\Controllers;

use App\Roomtype;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    //

    public static function search(Request $request){
        $roomtypes = new Collection();
        $from = $request->get('');
        $to = $request->get('');
        $category = $request->get('');

        if($category != null){
            $roomtypes = new Collection($from, $to);
        } else {
            $roomtypes = Roomtype::search($from, $to);
        }

        return $roomtypes;
    }
}
