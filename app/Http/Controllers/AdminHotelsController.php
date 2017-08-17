<?php

namespace App\Http\Controllers;

use App\Hotel;
use App\User;
use App\Group;
use App\Http\Requests\StoreHotelPostRequest;
use App\Http\Requests\UpdateHotelPostRequest;

class AdminHotelsController extends Controller
{
    public function index(Hotel $hotels)
    {
        $hotels = $hotels->all()->where('active', true);

        return view('backend.hotels.index', compact('hotels'));
    }

    public function create()
    {
        return view('backend.hotels.create');
    }

    public function edit(Hotel $hotel)
    {
        $users = User::all()->reject(function ($user) {
            return $user->group_id == Group::ADMINISTRATOR;
        });

        return view('backend.hotels.edit',compact('hotel', 'users'));
    }

    public function update(UpdateHotelPostRequest $request, Hotel $hotel)
    {

        $hotel->syncUsers($request->get('managers'));

        $hotel->name = $request->get('name');
        $hotel->description = $request->get('description');
        $hotel->stars = $request->get('stars');
        $hotel->street = $request->get('street');
        $hotel->postalcode = $request->get('postalcode');
        $hotel->area = $request->get('area');
        $hotel->telephone = $request->get('phone');
        $hotel->fax = $request->get('fax');
        $hotel->email = $request->get('email');

        $hotel->update();

        return redirect(route('backend.hotels.index'));
    }

    public function store(StoreHotelPostRequest $request)
    {

        (new Hotel([
            'name' => $request->get('name'),
            'description' => $request->get('description'),
            'stars' => $request->get('stars'),
            'street' => $request->get('street'),
            'postalcode' => $request->get('postalcode'),
            'area' => $request->get('area'),
            'telephone' => $request->get('phone'),
            'fax' => $request->get('fax'),
            'email' => $request->get('email'),
            'active' => 1
        ]))->save();

        return redirect(route('backend.hotels.index'));
    }

    public function destroy(Hotel $hotel)
    {
        $hotel->inactivate();

        return back();
    }
}