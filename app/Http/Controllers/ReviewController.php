<?php

namespace App\Http\Controllers;

use App\Hotel;
use App\Http\Requests\StoreReviewPost;
use App\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreReviewPost $request, Hotel $hotel)
    {
        $review = new Review();
        $review->hotel()->associate($hotel);
        $review->rating = $request->get('rating');
        $review->reviewer = $request->get('reviewer');
        $review->review = $request->get('review');
        $review->active = true;
        $review->save();

        return redirect(route('hotels.show',['id' =>$hotel->id]));
    }
}
