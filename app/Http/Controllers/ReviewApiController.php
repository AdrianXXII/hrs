<?php

namespace App\Http\Controllers;

use App\Hotel;
use App\Review;
use Illuminate\Http\Request;

class ReviewApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Hotel $hotel)
    {
        //
        return $hotel->getReviews();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreReviewPost $request, Hotel $hotel)
    {
        //
        if($hotel->active == false || $hotel->active == false)
            return false;
        $review = new Review();
        $review->reviewer = $request->get('reviewer');
        $review->rating = $request->get('rating');
        $review->review = $request->get('review');
        $review->active = 1;
        $hotel->reviews()->save($review);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Hotel $hotel, Review $review)
    {
        //
        if($hotel->active == false || $hotel->active == false)
            return false;
        return $review;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Hotel $hotel, Review $review)
    {
        if($hotel->active == false ||$review->active == false)
            return false;
        $review->inactive();
        return true;
    }
}
