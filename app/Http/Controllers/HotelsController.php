<?php

namespace App\Http\Controllers;

use App\Hotel;
use App\Category;
use App\Roomtype;
use App\Attribute;

class HotelsController extends Controller
{
    public function index(Hotel $hotels)
    {
        $hotels = Hotel::whereHas('roomtypes', function ($roomtype) {
            $roomtype->whereHas('rooms', function($room) {
                $room->where('active', true);
            });
        })->where('active', true)->get();

        $categories = Category::where('active', true)->get();
        $hotelAttributes = Attribute::all()->where('active', true)->where('hotel_atr', true);
        $roomAttributes = Attribute::all()->where('active', true)->where('hotel_atr', false);

        return view('hotels', compact('hotels', 'categories', 'hotelAttributes', 'roomAttributes'));
    }

    public function show(Hotel $hotel)
    {
        if(request()->get('startDatum')) {
            $startDatum = new \Carbon\Carbon(request()->get('startDatum'));
        }

        if(request()->get('endDatum')) {
            $endDatum = new \Carbon\Carbon(request()->get('endDatum'));
        }

        if($hotel->isInactive())
        {
            return back();
        }

        if(!isset($startDatum) OR !isset($endDatum) OR $startDatum >= $endDatum) {
            $roomTypes = $hotel->getRoomTypes();
            $filtered = false;
            return view('rooms', compact('hotel', 'roomTypes', 'filtered'));
        }

        //dd(Roomtype::searchByDateAndHotel($startDatum, $endDatum, $hotel));
        $roomTypes = Roomtype::searchByDateAndHotel($startDatum, $endDatum, $hotel);
        $filtered = true;
        return view('rooms', compact('hotel', 'roomTypes', 'filtered'));
    }
}