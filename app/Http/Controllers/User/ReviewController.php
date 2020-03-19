<?php

namespace App\Http\Controllers\User;
use App\Http\Controllers\Controller;
use App\Review;
use Illuminate\Http\Request;
use Auth;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $review = new Review;
        $review->user_id = Auth::id();
        $review->book_id = $request->book;
        $review->rate = $request->rate;
        $review->comment = $request->comment;
        $review->save();
        return ('Your review has been saved successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function show(Review $review)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function edit(Review $review)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Review $review)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function destroy(Review $review)
    {
        //
    }
    
    public function removeReview(Request $request)
    {
        Review::where([['user_id', Auth::id()], ['book_id', $request->book_id]])->first()->delete();
        return back()->with('success', 'Your review has been deleted successfully');
    }
}
