<?php

namespace App\Http\Controllers;

use App\Hotel;
use App\Http\Requests\ReserveStoreRequest;
use App\Newsletter;
use App\Reservation;
use App\Room;
use App\Roomtype;
use Carbon\Carbon;
use Illuminate\Http\Request;

class GuestReservationController extends Controller
{
    //

    public function create(Request $request, Hotel $hotel, Roomtype $roomtype)
    {
        if($hotel->isInactive() || $roomtype->isInactive() ){
            return back();
        }
        return view('reservation', compact('hotel','roomtype'));
    }

    public function store(ReserveStoreRequest $request, Hotel $hotel, Roomtype $roomtype)
    {
        if($hotel->isInactive() || $roomtype->isInactive() ){
            return back();
        }

        $bookingDate = new Carbon();
        $endDate = new Carbon($request->get('endDatum'));
        $startDate = new Carbon($request->get('startDatum'));
        $duration = $startDate->diffInDays($endDate) + 1;
        $price = $roomtype->price * $duration;
        $rooms = Room::getAvailbleRooms($startDate, $endDate, $roomtype);
        $room = $rooms->first();

        if($room == null){
            return back()->withErrors(['von'=>'Keine Zimmer verfühgbar für diesen Zeitraum','bis'=>'Keine Zimmer verfühgbar für diesen Zeitraum'])->withInput();
        }


        $reservation = new Reservation();
        $reservation->name = $request->get('name');
        $reservation->telephone = $request->get('telephone');
        $reservation->firstname = $request->get('firstname');
        $reservation->email = $request->get('email');
        $reservation->number_of_people = $request->get('number_of_people');
        $reservation->price = $price;
        $reservation->status = Reservation::STATUS_NEW;
        $reservation->bookdate = $bookingDate;
        $reservation->reservation_start = $startDate;
        $reservation->reservation_end = $endDate;
        $reservation->active = true;

        $reservation->room()->associate($room);
        $reservation->roomtype()->associate($roomtype);
        $reservation->save();

        $newsletter = new Newsletter();
        $newsletter->name = $reservation->name;
        $newsletter->firstname = $reservation->firstname;
        $newsletter->email = $reservation->email;
        $newsletter->active = true;
        $newsletter->hotel()->associate($roomtype->hotel);
        $newsletter->save();

        return redirect(route("hotels.show", ['id' => $hotel->id]));
    }
}
