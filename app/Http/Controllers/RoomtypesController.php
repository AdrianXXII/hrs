<?php

namespace App\Http\Controllers;

use App\Hotel;
use App\Roomtype;
use App\Category;
use App\Attribute;
use App\Http\Requests\StoreRoomtypePostRequest;

class RoomtypesController extends Controller
{
    public function index(Hotel $hotel)
    {
        if($hotel->isInactive()) {
            return redirect()->route('manager.hotels.index');
        }

        $roomtypes = $hotel->getRoomTypes();

        return view('manager.roomtypes.index', compact('hotel', 'roomtypes'));
    }

    public function create(Hotel $hotel)
    {
        if($hotel->isInactive()) {
            return redirect()->route('manager.hotels.index');
        }

        $numberOfBeds = Category::numberOfBeds();
        $categories = Category::all()->where('active', 1)->sortBy('number_of_beds');
        $attributes = Attribute::getRoomAttributes();

        return view('manager.roomtypes.create', compact('hotel', 'categories', 'numberOfBeds', 'attributes'));
    }

    public function edit($hotelid, $roomtypeid)
    {

        $user = \Auth::user();
        $hotel = Hotel::find($hotelid);
        $roomtype = Roomtype::find($roomtypeid);
        $numberOfBeds = Category::numberOfBeds();
        $categories = Category::all()->where('active', 1)->sortBy('number_of_beds');
        $attributes = Attribute::getRoomAttributes();

        if(! $hotel->isManagedBy($user) OR $roomtype->isInactive() OR Hotel::find($hotelid)->isInactive())
        {
            return back();
        }

        return view('manager.roomtypes.edit', compact('hotel', 'roomtype', 'numberOfBeds', 'categories', 'attributes'));
    }

    public function update(StoreRoomtypePostRequest $request, Hotel $hotel, Roomtype $roomtype)
    {
        $category = Category::find($request->get('category'));
        $selectedNumberOfBeds = $request->get('number_of_beds');
        if (!$category->active OR !$hotel->active OR $category->number_of_beds != $selectedNumberOfBeds)
        {
            return back();
        }

        $roomtype->title = $request->get('name');
        $roomtype->description = $request->get('description');
        $roomtype->price = $request->get('price');
        $roomtype->category()->associate($category);
        $roomtype->syncAttributes(request()->get('attributes'));

        $roomtype->save();

        return redirect(route('manager.roomtypes.index', ['hotel' => $hotel->id]));
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
        $roomtype->syncAttributes(request()->get('attributes'));

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

        $roomtype->deactivate();

        return back();
    }
}
