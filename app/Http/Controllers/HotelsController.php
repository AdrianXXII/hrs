<?php

namespace App\Http\Controllers;

use App\Hotel;
use App\Category;
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
        if($hotel->isInactive())
        {
            return back();
        }

        return view('rooms', compact('hotel'));
    }
}