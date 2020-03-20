<?php

namespace App\Http\Controllers\User;
use App\Http\Controllers\Controller;

use App\Lease;
use App\Book;
use Illuminate\Http\Request;
use App\Http\Requests\LeaseRequest;
use Auth;
use DB;
use Carbon\Carbon;


class LeaseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $allBooks = Auth::user()->leases()->leftJoin('books', 'leases.book_id', '=', 'books.id')
        ->select('books.*', DB::raw('DATEDIFF(leases.end_date, leases.created_at) as remaining'))->orderBy('books.title')->paginate(15);
        $favourites = Auth::user()->favourites->pluck("book_id")->toArray();
        return view('user.leases.index', compact('allBooks', 'favourites'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    //    return view('user.leases.create');
    }
    public function createWithBook(Book $book)
    {
       return view('user.leases.create',["book"=>$book]);
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(LeaseRequest $request)
    {
        //check available copies 
        $availableCopies=Book::find($request->book)->quantity;
        if ($availableCopies==0) {
            return back()->withErrors('No copies available of this book currently.');
        }
        if (count(Auth::user()->leases) > 4) {
            return back()->withErrors('You currently have 5 books,return one to be able to lease a new one!');
        }
        if (Lease::where('user_id',Auth::id())->where('book_id',$request->book)->count()>0) {
            return back()->withErrors('You already have a copy of this book currently.');
        }
     
        
        //check if he had the book for in past three days
        $previousLeases=Lease::onlyTrashed()->where('user_id',Auth::id())->where('book_id',$request->book)->where( 'created_at', '>', Carbon::now()->subDays(3))->count();
        
        if ($previousLeases>0 && $availableCopies<4) {
            return back()->withErrors('You need to wait at least 3 days before borrowing the same book again');
        }
       
        $lease = new Lease;
        $lease->user_id = Auth::id();
        $lease->book_id = $request->book;
        $lease->duration = $request->days;
        $lease->save();
        
        return redirect('books')->with('success','You have Leased this book successfully');;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Lease  $lease
     * @return \Illuminate\Http\Response
     */
    public function show(Lease $lease)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Lease  $lease
     * @return \Illuminate\Http\Response
     */
    public function destroy(Lease $lease)
    {
        //
    }

    public function removeLease(Request $request){
        Lease::where([["user_id", Auth::id()],["book_id", $request->book_id]])->first()->delete();
        return ('We hope that you had fun with the book, please take a moment of your time to review it!');
    }
}
