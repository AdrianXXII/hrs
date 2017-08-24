<?php

namespace App\Http\Controllers;

use App\Hotel;
use App\Room;
use App\Roomtype;
use App\Category;
use App\Http\Requests\StoreRoomtypePostRequest;

class RoomtypesController extends Controller
{
    public function index(Hotel $hotel)
    {
        $roomtypes = $hotel->getRoomTypes();

        return view('manager.roomtypes.index', compact('hotel', 'roomtypes'));
    }

    public function create(Hotel $hotel)
    {
        $numberOfBeds = Category::numberOfBeds();
        $categories = Category::all()->where('active', 1)->sortBy('number_of_beds');

        return view('manager.roomtypes.create', compact('hotel', 'categories', 'numberOfBeds'));
    }

    public function edit(Roomtype $roomtype)
    {
        dd('edit');
    }

    public function update(Roomtype $roomtype)
    {
        dd('update');
    }

    public function store(StoreRoomtypePostRequest $request, Hotel $hotel)
    {
        $category = Category::find($request->get('category'));
        $selectedNumberOfBeds = $request->get('number_of_beds');
        if (!$category->active OR !$hotel->active OR $category->number_of_beds != $selectedNumberOfBeds)
        {
            return back();
        }

        $roomtype = new Roomtype([
            'title' => $request->get('name'),
            'description' => $request->get('description'),
            'price' => $request->get('price'),
            'active' => 1
        ]);

        $roomtype->hotel()->associate($hotel);
        $roomtype->category()->associate($category);
        $roomtype->save();

        return redirect(route('manager.roomtypes.index', ['hotel' => $hotel->id]));
    }

    public function destroy($hotel, $roomtype)
    {
        $user = \Auth::user();
        $roomtype = Roomtype::find($roomtype);

        if(! $roomtype->hotel->isManagedBy($user))
        {
            return back();
        }

        $roomtype->inactivate();

        return back();
    }
}
