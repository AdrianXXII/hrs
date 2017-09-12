<?php

namespace App\Http\Controllers;

use App\Group;
use App\Hotel;
use App\Http\Requests\ManagerStoreUserRequest;
use App\Http\Requests\ManagerUpdateHotelPostRequest;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserManagerController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = Auth::user()->getStaff();

        return view('manager.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $hotels = Auth::user()->hotels()->where('active',true)->get();
        return view('manager.users.create', compact('hotels'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ManagerStoreUserRequest $request)
    {
        $allowed = true;
        //get Group
        $group = Group::find(Group::HOTELANGESTELLTER);

        //get Hotel
        $hotel = Hotel::where('id',$request->get('hotel_id'))
            ->where('active',true)->get();

        if(Auth::user()->hotels()->contains($hotel)){
            return redirect(route('manager.users.index'));
        }

        //Create new User
        $user = new User();
        $user->name = $request->get('name');
        $user->firstname = $request->get('firstname');
        $user->lastname = $request->get('lastname');
        $user->email = $request->get('email');
        $user->password = bcrypt($request->get('password'));
        $user->active = true;
        $group->users()->save($user);
        $user->hotels()->attach($hotel);

        return redirect(route('manager.users.index'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $staff = Auth::user()->getStaff();
        if($user->active == false || $staff == null || !$staff->contains($user))
            return redirect(route('manager.users.index'));

        $hotels = Auth::user()->hotels()->where('active',true)->get();
        return view('manager.users.edit', compact('user', 'hotels'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ManagerUpdateHotelPostRequest $request, User $user)
    {
        $staff = Auth::user()->getStaff();
        if($user->active == false || $staff == null || !$staff->contains($user))
            return redirect(route('manager.users.index'));


        //get Hotel
        $hotel = Hotel::where('id',$request->get('hotel_id'))
            ->where('active',true)->get();

        //Create new User
        $user->firstname = $request->get('firstname');
        $user->lastname = $request->get('lastname');
        $user->lastname = $request->get('email');
        $user->save();
        $user->hotels()->attach($hotel);

        return redirect(route('manager.users.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //Create new User
        $user->deactivate();

        return redirect(route('manager.users.index'));
    }
}
