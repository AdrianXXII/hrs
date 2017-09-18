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
        $to = $request->get('abreiseatum');
        $category = Category::find($request->get('zimmerKategorie'));
        $attributes = Attribute::wherein('id', $request->get('zusatzleistung'))->get();

        $roomtypes = Roomtype::searchByDateAndMore($from, $to, $attributes, $category, $ort, $anzahl);


        return $roomtypes;
    }
}
