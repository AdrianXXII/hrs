<?php

namespace App\Http\Controllers;

use App\Group;
use App\Http\Requests\StoreUserPostRequest;
use App\Http\Requests\UpdateUserPostRequest;
use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $users = User::where('active',true)->get();
        return view('backend.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $groups = Group::all();
        return view('backend.users.create', compact('groups'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUserPostRequest $request)
    {
        //get Group
        $groupId = $request->get('groupId');
        $group = Group::find($groupId);

            //Create new User
        $user = new User();
        $user->name = $request->get('name');
        $user->firstname = $request->get('firstname');
        $user->lastname = $request->get('lastname');
        $user->email = $request->get('email');
        $user->password = bcrypt($request->get('password'));
        $user->active = true;
        $group->users()->save($user);

        return redirect(route('users.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $user = User::where('id',$id)->where('active',true)->first();
        return $user;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        if($user->active == false)
            return redirect(route('users.index'));
        $groups = Group::all();
        return view('backend.users.edit',compact('user','groups'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserPostRequest $request, User $user)
    {
        if(!$user->active){
            return redirect(route('users.index'));
        }
        //get Group
        $groupId = $request->get('groupId');
        $group = Group::find($groupId);

        //Create new User
        $user->firstname = $request->get('firstname');
        $user->lastname = $request->get('lastname');
        $user->lastname = $request->get('email');
        $group->users()->save($user);

        return redirect(route('users.index'));
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
        $user->active = false;
        $user->save();

        return redirect(route('users.index'));
    }
}
