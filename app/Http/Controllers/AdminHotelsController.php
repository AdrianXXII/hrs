<?php

namespace App\Http\Controllers;

use App\Hotel;
use App\User;
use App\Group;
use Illuminate\Http\Request;

class AdminHotelsController extends Controller
{
    public function index(Hotel $hotels)
    {
        $hotels = $hotels->all()->where('active', true);

        return view('admin.hotels.index', compact('hotels'));
    }

    public function create()
    {
        return view('admin.hotels.create');
    }

    public function edit(Hotel $hotel)
    {
        $users = User::all()->reject(function ($user) {
            return $user->group_id == Group::ADMINISTRATOR;
        });

        $hotel->where('active',true)->first();
        return view('admin.hotels.edit',compact('hotel', 'users'));
    }

    public function update(Hotel $hotel, Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'description' => 'required',
            'stars' => 'required|integer|between:1,5',
            'street' => 'required',
            'postalcode' => 'required',
            'area' => 'required',
            'phone' => 'required',
            'fax' => 'required',
            'email' => 'required|email'
        ]);

        $hotel->syncUsers($request->managers);
        //foreach($request->managers as $managerid)
        //{
        //    $user = User::find($managerid);
        //    $hotel->addUser($user);
        //}

        $hotel->name = request('name');
        $hotel->description = request('description');
        $hotel->stars = request('stars');
        $hotel->street = request('street');
        $hotel->postalcode = request('postalcode');
        $hotel->area = request('area');
        $hotel->telephone = request('phone');
        $hotel->fax = request('fax');
        $hotel->email = request('email');

        $hotel->update();

        return redirect(route('admin.hotels.index'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'description' => 'required',
            'stars' => 'required|integer|between:1,5',
            'street' => 'required',
            'postalcode' => 'required',
            'area' => 'required',
            'phone' => 'required',
            'fax' => 'required',
            'email' => 'required|email'
        ]);

        (new Hotel([
            'name' => request('name'),
            'description' => request('description'),
            'stars' => request('stars'),
            'street' => request('street'),
            'postalcode' => request('postalcode'),
            'area' => request('area'),
            'telephone' => request('phone'),
            'fax' => request('fax'),
            'email' => request('email'),
            'active' => 1
        ]))->save();

        return redirect(route('admin.hotels.index'));
    }

    public function destroy(Hotel $hotel)
    {
        $hotel->inactivate();

        return back();
    }
}