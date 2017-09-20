<?php

namespace App\Http\Controllers;

use App\Attribute;
use App\Category;
use App\Room;
use App\Roomtype;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    //

    public static function search(Request $request){
        $roomtypes = new Collection();
        $ort = $request->get('ort');
        $anzahl = $request->get('anzahlPersonen');
        $from = $request->get('anreisedatum');
        $to = $request->get('abreisedatum');
        $category = Category::find($request->get('zimmerKategorie'));
        if($request->get('zusatzleistung') != null && count($request->get('zusatzleistung'))){
            $attributes = Attribute::wherein('id', $request->get('zusatzleistung'))->get();
        } else {
            $attributes = null;
        }

        $categories = Category::where('active', true)->get();
        $hotelAttributes = Attribute::all()->where('active', true)->where('hotel_atr', true);
        $roomtypes = Roomtype::searchByDateAndMore($from, $to, $attributes, $category, $ort, $anzahl);


        return view('roomtypes', compact('roomtypes', 'categories', 'hotelAttributes'));
    }
}
