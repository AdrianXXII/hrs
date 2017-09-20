<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Hotel;
use App\Group;
use App\Attribute;
use App\Http\Requests\ManagerUpdateHotelPostRequest as UpdateHotelPostRequest;

class EmployeeHotelsController extends Controller
{
    public function index()
    {
        $user = \Auth::user();
        $hotels = $user->getHotels();

        return view('employee.hotels.index', compact('hotels'));
    }
}
