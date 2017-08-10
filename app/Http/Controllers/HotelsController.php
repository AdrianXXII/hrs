<?php

namespace App\Http\Controllers;

use App\Hotel;

class HotelsController extends Controller
{
    public function index()
    {
        // show all (active) hotels
    }

    public function show(Hotel $hotel)
    {
        // show a hotel
    }

    public function create()
    {
        // create form
    }

    public function store()
    {
        // store new hotel
    }
}