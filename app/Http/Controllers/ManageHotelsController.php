<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Hotel;
use App\Group;
use App\Attribute;
use App\Http\Requests\ManagerUpdateHotelPostRequest as UpdateHotelPostRequest;

class ManageHotelsController extends Controller
{
    public function index()
    {
        $user = \Auth::user();
        $hotels = $user->getHotels();

        return view('manager.hotels.index', compact('hotels'));
    }

    public function show(Hotel $hotel)
    {
        $user = \Auth::user();
        if(! $hotel->isManagedBy($user))
        {
            return back();
        }

        dd($hotel);
    }

    public function edit(Hotel $hotel)
    {
        $attributes = Attribute::getHotelAttributes();
        $users = User::where('active', true)
            ->where('group_id', Group::HOTELANGESTELLTER)
            ->get();

        return view('manager.hotels.edit',compact('hotel', 'users', 'attributes'));
    }

    public function update(UpdateHotelPostRequest $request, Hotel $hotel)
    {
        $hotel->syncAttributes($request->get('attributes'));

        $hotel->update();

        return redirect(route('manager.hotels.index'));
    }
}
