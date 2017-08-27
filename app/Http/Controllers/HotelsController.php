<?php

namespace App\Http\Controllers;

use App\Hotel;

class HotelsController extends Controller
{
    public function index(Hotel $hotels)
    {
        $hotels = $hotels->all()->where('active', true);

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