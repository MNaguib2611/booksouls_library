<?php

namespace App\Http\Controllers\User;
use App\Http\Controllers\Controller;
use App\Book;
use App\Review;
use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Input;



class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $allBooks = Book::paginate(15);
        $favourites = Auth::user()->favourites->pluck("book_id")->toArray();
        $leases = Auth::user()->leases->pluck("book_id")->toArray();
        $categories = Category::all();
        return view('user.books.index',compact('allBooks', 'favourites', 'leases','categories'));       
    }


  

    /**
     * Display the specified resource.
     *
     * @param  \App\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function show(Book $book)
    {
        $reviews = Review::leftJoin('users', 'reviews.user_id', '=', 'users.id')
            ->select('reviews.*', 'users.name', 'users.avatar')
            ->where('book_id', $book->id)->orderBy('reviews.rate', 'desc')->get();

        $userReview = Review::leftJoin('users', 'reviews.user_id', '=', 'users.id')
            ->select('reviews.*', 'users.name', 'users.avatar')
            ->where([['book_id', $book->id], ['user_id', Auth::id()]])->get();
        
        $reviewedFlag = 0;
        if($userReview->count() > 0){
            $reviewedFlag = 1;
        }

        $book = Book::find($book->id);
        $category=Category::find($book->category_id);
        $favourites = Auth::user()->favourites->pluck("book_id")->toArray();
        return view('user.books.show', compact('book', 'favourites', 'category', 'reviews','userReview', 'reviewedFlag'));

    }

  


      /**
     * Search
     *
     * @return \Illuminate\Http\Response
     */
    public function selectedData(Request $request)
    {
        $text=request('search'); 
        $order=request('order'); 
        $category=request('category'); 
        
        if($text != "" | $order != "" | $category != 0)
        {
           
            $ascORdesc="";
            if(!$order)
            {
                $order="title";
            }
            
            if($order=="title")
                $ascORdesc="asc";
            else
                $ascORdesc="desc";

            if($category > 0)
            {
                $allBooks = DB::table('books')->leftJoin('reviews', 'books.id', '=','reviews.book_id' )
                ->select('books.*','books.id as myID','books.title as title', DB::raw('avg(reviews.rate) as avgRate '))
                ->where('books.category_id', '=', $category)
                ->where('title', 'like', '%'.$text.'%')
                ->orwhere('author', 'like','%'.$text.'%')
                ->groupBy('books.id')->orderBy($order,$ascORdesc)->paginate(15)->setPath ( '' );
                $cat=Category::find($category)->first()->name;
            }  
            else
            {  
                $allBooks = DB::table('books')->leftJoin('reviews', 'books.id', '=','reviews.book_id')
                ->select('books.*','books.id as myID',
                'books.title as title', DB::raw('avg(reviews.rate) as avgRate '))
                ->where('title', 'like', '%'.$text.'%')
                ->orwhere('author', 'like','%'.$text.'%')
                ->groupBy('books.id')->orderBy($order,$ascORdesc)->paginate(15)->setPath ( '' );
                $cat="All";
            }        

            

            $pagination = $allBooks->appends ( array (
                'text' => Request( 'text' ) ,
                'order' => Request( 'order' ) ,
                'category' => Request( 'category' )                 
                ) );

            $favourites = Auth::user()->favourites->pluck("book_id")->toArray();
            $leases = Auth::user()->leases->pluck("book_id")->toArray();
            $categories = Category::all();
        

            $selected = array("your input text is --> $text","order By --> $order","category is --> $cat");

            if (count($allBooks) > 0)
            return view('user.books.index2',compact('allBooks', 'favourites', 'leases','categories','selected'))->withQuery($text,$order,$category);    
            }

            return view('user.books.index2',compact('selected'))->withQuery($text,$order,$category);    

        }

          
       
                
            
          


    }