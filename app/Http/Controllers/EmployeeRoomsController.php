<?php

namespace App\Http\Controllers;

use App\Hotel;
use App\Room;
use App\Roomtype;
use App\Category;
use App\Http\Requests\StoreRoomPostRequest;

class EmployeeRoomsController extends Controller
{
    public function index(Hotel $hotel)
    {

        if($hotel->isInactive()) {
            return redirect()->route('employee.hotels.index');
        }

        $rooms = $hotel->getRooms();

        return view('employee.rooms.index', compact('hotel', 'rooms'));
    }

    public function create(Hotel $hotel)
    {
        if($hotel->isInactive()) {
            return redirect()->route('employee.hotels.index');
        }

        $roomTypes = $hotel->getRoomTypes();

        return view('employee.rooms.create', compact('hotel', 'roomTypes'));
    }

    public function edit(Hotel $hotel, Room $room)
    {
        $user = \Auth::user();
        $roomTypes = $hotel->getRoomTypes();


        if(! $hotel->isManagedBy($user) OR $room->isInactive() OR $hotel->isInactive())
        {
            return back();
        }

        return view('employee.rooms.edit', compact('hotel', 'room', 'roomTypes'));
    }

    public function update(StoreRoomPostRequest $request, Hotel $hotel, Room $room)
    {
        $user = \Auth::user();
        $roomType = Roomtype::find($request->get('room_type'));

        if(! $hotel->isManagedBy($user) OR $roomType->isInactive() OR $hotel->isInactive())
        {
            return back();
        }

        $room->room_number = $request->get('room_number');
        $room->roomtype()->associate($roomType);

        $room->save();

        return redirect(route('employee.rooms.index', ['hotel' => $hotel->id]));
    }

    public function store(StoreRoomPostRequest $request, Hotel $hotel)
    {
        $user = \Auth::user();
        $roomType = Roomtype::find($request->get('room_type'));

        if(! $hotel->isManagedBy($user) OR $roomType->isInactive() OR $hotel->isInactive())
        {
            return back();
        }

        $room = new Room([
            'room_number' => $request->get('room_number'),
            'active' => 1
        ]);

        $room->roomtype()->associate($roomType);

        $room->save();

        return redirect(route('employee.rooms.index', ['hotel' => $hotel->id]));
    }

    public function destroy(Hotel $hotel, Room $room)
    {
        $user = \Auth::user();

        if(! $hotel->isManagedBy($user))
        {
            return back();
        }

        $room->deactivate();

        return back();
    }
}
