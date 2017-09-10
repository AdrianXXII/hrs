<?php

namespace App\Http\Controllers;

use App\Reservation;
use App\Room;
use App\Roomtype;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReservationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $hotels = Auth::user()->hotels;
        $reservations = Reservation::where('active',true)->whereHas('roomtype',function($q){
            $q->whereHas('hotel', function($q1){
                $q1->whereHas('users', function($q2){
                    $q2->where('id', Auth::id());
                });
            });
        })->get();
        return view('backend.reservations.index', compact('reservations','hotels'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Roomtype $roomtype)
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $bookingDate = new Carbon();
        $endDate = new Carbon($request->get('endDatum'));
        $startDate = new Carbon($request->get('startDatum'));
        $roomtype = Roomtype::find($request->get('roomtypeId'));
        $room = Room::getAvailbleRooms($startDate, $endDate, $request->get('roomtype'))->first();

        $reservation = new Reservation();
        $reservation->name = $request->get('name');
        $reservation->firstname = $request->get('firstname');
        $reservation->email = $request->get('email');
        $reservation->price = $request->get('price');
        $reservation->stauts = Reservation::STATUS_NEW;
        $reservation->bookdate = $bookingDate;
        $reservation->reservation_start = $startDate;
        $reservation->reservation_end = $endDate;

        $reservation->room()->associate($room);
        $reservation->roomtype()->associate($roomtype);
        $reservation->save();
        return redirect(route('manager.reservations.index'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Reservation $reservation)
    {
        //
        $rooms = Reservation::getAvailableRooms($reservation->reservation_start, $reservation->reservation_end, $reservation->roomtype);
        $rooms->push($reservation->room);
        $hotel = $reservation->roomtype->hotel;
        return view('backend.reservations.edit', compact('hotel','rooms','reservation'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Reservation $reservation)
    {
        //
        if($reservation->active == false){
            return redirect(route('manager.reservations.index'));
        }
        $room = Room::find($request->get('roomId'));

        $reservation->status = $request->get('status');
        $reservation->room()->associate($room);
        $reservation->save();
        return redirect(route('manager.reservations.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Reservation $reservation)
    {
        //
        $reservation->deactivate();
        return redirect(route('manager.reservations.index'));
    }
}
