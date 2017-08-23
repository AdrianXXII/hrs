<?php

namespace App\Http\Controllers;

use App\Hotel;

class ManageRoomtypeController extends Controller
{
    public function index(Hotel $hotel)
    {
        $roomtypes = $hotel->getRoomTypes();

        return view('manager.roomtypes.index', compact('roomtypes'));
    }

    public function edit()
    {
        dd('edit');
    }

    public function update()
    {
        dd('update');
    }
}
