<?php

namespace App\Http\Controllers;

use App\Hotel;

class HotelsController extends Controller
{
    public function index(Hotel $hotels)
    {
        $hotels = Hotel::whereHas('roomtypes', function ($roomtype) {
            $roomtype->whereHas('rooms', function($room) {
                $room->where('active', true);
            });
        })->where('active', true)->get();

        return view('hotels', compact('hotels'));
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