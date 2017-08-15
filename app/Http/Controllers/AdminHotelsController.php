<?php

namespace App\Http\Controllers;

use App\Hotel;
use App\User;
use App\Group;

class AdminHotelsController extends Controller
{
    public function index()
    {
        $hotels = Hotel::where('active',true)->get();
        return view('admin.hotels.index', compact('hotels'));
    }

    public function create()
    {
        return view('admin.hotels.create');
    }

    public function edit($id)
    {
        $users = User::all()->where('active', 1)
            ->where('group_id', '!=', Group::ADMINISTRATOR);

        $hotel = Hotel::where('id',$id)->where('active',true)->first();
        return view('admin.hotels.edit',compact('hotel', 'users'));
    }

    public function update()
    {
        dd(request());
    }

    public function store()
    {
        $this->validate(request(), [
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

        return redirect(route('hotels.index'));
    }
}