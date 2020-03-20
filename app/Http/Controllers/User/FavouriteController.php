<?php

namespace App\Http\Controllers\User;
use App\Http\Controllers\Controller;

use App\Favourite;
use Illuminate\Http\Request;
use Auth;


class FavouriteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $allBooks = Auth::user()->favourites()->leftJoin('books', 'favourites.book_id', '=', 'books.id')
        ->select('books.*')->orderBy('books.title')->paginate(15);
        $favourites = Auth::user()->favourites->pluck("book_id")->toArray();
        return view('user.favourites.index', compact('allBooks', 'favourites'));
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
        $favourite = new Favourite;
        $favourite->user_id = Auth::id();
        $favourite->book_id = $request->book;
        $favourite->save();
        return ('The book has been Added to your favourites!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Favourite  $favourite
     * @return \Illuminate\Http\Response
     */
    public function show(Favourite $favourite)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Favourite  $favourite
     * @return \Illuminate\Http\Response
     */
    public function edit(Favourite $favourite)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Favourite  $favourite
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Favourite $favourite)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Favourite  $favourite
     * @return \Illuminate\Http\Response
     */
    public function destroy(Favourite $favourite)
    {
        //
    }

    public function removeFavourite(Request $request){
        Favourite::where([
                    ["user_id", Auth::id()],
                    ["book_id", $request->book],
                ])->delete();
        return ('The book has been removed from your favourites!');
    
    }
}
