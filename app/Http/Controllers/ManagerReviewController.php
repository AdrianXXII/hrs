<?php

namespace App\Http\Controllers;

use App\Hotel;
use App\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ManagerReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Hotel $hotel)
    {
        //
        if($hotel->active != 1 || !Auth::user()->hotels->contains($hotel)){
            return back();
        }


        return view('manager.reviews.index', compact('hotel'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Hotel $hotel, Review $review)
    {
        //
        if(!Auth::user()->hotels->contains($review->hotel)){
            return back();
        }
        $review->deactivate();
        return back();
    }
}
