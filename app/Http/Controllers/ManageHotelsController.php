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

    public function edit(Hotel $hotel)
    {
        if($hotel->isInactive()) {
            return redirect()->route('manager.hotels.index');
        }

        $user = \Auth::user();
        if(! $hotel->isManagedBy($user))
        {
            return back();
        }

        $attributes = Attribute::getHotelAttributes();
        $users = User::where('active', true)
            ->where('group_id', Group::HOTELANGESTELLTER)
            ->get();

        return view('manager.hotels.edit',compact('hotel', 'users', 'attributes'));
    }

    public function update(Hotel $hotel)
    {
        $user = \Auth::user();
        if(! $hotel->isManagedBy($user))
        {
            return back();
        }

        $staff = request()->get('staff');

        foreach ($hotel->getManagers()->toArray() as $manager)
        {
            $staff[] = $manager['id'];
        }

        $hotel->syncAttributes(request()->get('attributes'));
        $hotel->syncUsers($staff);

        $hotel->update();

        return redirect(route('manager.hotels.index'));
    }
}
