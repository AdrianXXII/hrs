<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReservationStoreRequest;
use App\Http\Requests\ReservationUpdateRequest;
use App\Reservation;
use App\Room;
use App\Roomtype;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EmployeeReservationController extends Controller
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
        })->orderBy('reservation_start')->get();
        return view('employee.reservations.index', compact('reservations','hotels'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //
        if($request->get('endDatum') == null || $request->get('startDatum') == null || $request->get('roomtype') == null){
            // return "EndDatum; " + $request->get('endDatum') + ", StartDatum: " + $request->get('startDatum') + ", Roomtype: "+$request->get('roomtype');//
            return back()->withErrors(['rooms' => 'Sie müssen ein Zeitraum und Zimmerart angeben']);
        }

        $endDatum = new Carbon($request->get('endDatum'));
        $startDatum = new Carbon($request->get('startDatum'));
        $roomtype = Roomtype::find($request->get('roomtype'));
        $rooms = Reservation::getAvailableRooms($startDatum, $endDatum, $roomtype);

        if ($rooms == null || $rooms->count() == 0 ){
            //return $rooms;//
            return back()->withErrors(['rooms' => 'Keine Zimmer sind verfügbar für diese Zimmerart und Datum.']);
        }

        return view('employee.reservations.create', compact('roomtype','startDatum','endDatum','rooms'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ReservationStoreRequest $request)
    {
        //
        $bookingDate = new Carbon();
        $endDate = new Carbon($request->get('endDatum'));
        $startDate = new Carbon($request->get('startDatum'));
        $roomtype = Roomtype::find($request->get('roomtypeId'));
        $room = Room::find($request->get('roomId'));

        if($roomtype != null){
            $rooms = Room::getAvailbleRooms($startDate, $endDate, $roomtype);
            if(!$rooms->contains($room)){
                return back()
                    ->withErrors(['roomId' => 'Das Zimmer ist nicht mehr verfügbar.'])
                    ->withInput();
            }
        } else {
            return back()
                ->withErrors(['roomId' => 'Keine Zimmer sind verfügbar.'])
                ->withInput();
        }


        $reservation = new Reservation();
        $reservation->name = $request->get('name');
        $reservation->telephone = $request->get('telephone');
        $reservation->firstname = $request->get('firstname');
        $reservation->email = $request->get('email');
        $reservation->price = $request->get('price');
        $reservation->status = Reservation::STATUS_NEW;
        $reservation->bookdate = $bookingDate;
        $reservation->reservation_start = $startDate;
        $reservation->reservation_end = $endDate;
        $reservation->active = true;

        $reservation->room()->associate($room);
        $reservation->roomtype()->associate($roomtype);
        $reservation->save();

        $newsletters = Newsletter::WHERE('email',$request->get('email'))->get();

        if($newsletters == null || $newsletters->count()){
            $newsletter = new Newsletter();
            $newsletter->name = $reservation->name;
            $newsletter->firstname = $reservation->firstname;
            $newsletter->email = $reservation->email;
            $newsletter->active = true;
            $newletter->save();
        }

        return redirect(route('employee.reservations.index'));
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
        return view('employee.reservations.edit', compact('hotel','rooms','reservation'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ReservationUpdateRequest $request, Reservation $reservation)
    {
        //
        if($reservation->active == false){
            return redirect(route('employee.reservations.index'));
        }
        $room = Room::find($request->get('roomId'));
        if($reservation->roomtype != null){
            $rooms = Room::getAvailbleRooms($reservation->reservation_start, $reservation->reservation_end, $reservation->roomtype);
            if(!$rooms->contains($room) && $room != $reservation->room){
                return back()
                    ->withErrors(['roomId' => 'Das Zimmer ist nicht mehr verfügbar.'])
                    ->withInput();
            }
        }

        $reservation->price = $request->get('price');
        $reservation->status = $request->get('status');
        $reservation->room()->associate($room);
        $reservation->save();
        return redirect(route('employee.reservations.index'));
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
        return redirect(route('employee.reservations.index'));
    }
}
