<?php

namespace App\Http\Controllers\User;
use App\Http\Controllers\Controller;
use App\Book;
use App\Review;
use App\Lease;
use App\Category;
use DB;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Arr;



class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $allBooks = Book::orderBy('title')->paginate(15);
        $favourites = Auth::user()->favourites->pluck("book_id")->toArray();
        $categories = Category::all();
        return view('user.books.index',compact('allBooks', 'favourites', 'categories'));       
    }


    public function show(Book $book)
    {
        $reviews = Review::leftJoin('users', 'reviews.user_id', '=', 'users.id')
            ->select('reviews.*', 'users.name', 'users.avatar')
            ->where('book_id', $book->id)->orderBy('reviews.rate', 'desc')->get();

        $userReview = Review::leftJoin('users', 'reviews.user_id', '=', 'users.id')
            ->select('reviews.*', 'users.name', 'users.avatar')
            ->where([['book_id', $book->id], ['user_id', Auth::id()]])->first();
        $relatedBooks = Book::where([['category_id', $book->category_id], ['id', '!=', $book->id]])->get();
        if(count($relatedBooks)>10){
            $relatedBooks = $relatedBooks->random(10);
        }
        $userLease = Lease::where([['book_id', $book->id], ['user_id', Auth::id()], ['deleted_at', null]])->select('leases.*', DB::raw('DATEDIFF(end_date, created_at) as remaining'))->first();
        $book = Book::find($book->id);
        $category=Category::find($book->category_id);
        $favourites = Auth::user()->favourites->pluck("book_id")->toArray();
        return view('user.books.show', compact('book', 'favourites', 'category', 'reviews', 'userReview', 'userLease', 'relatedBooks'));
    }


    public function selectedData(Request $request)
    {
        $text=request('search'); 
        $order=request('order'); 
        $category=request('category'); 
        
        if($text != "" || $order != "" || $category != 0)
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

                $allBooks = DB::table('books')
                ->select('books.*','books.title as title','books.rate as avgRate')
                ->where('books.category_id', '=', $category)
                ->where(function($q) use ($text) {
                    $q->where('title', 'like', '%'.$text.'%')
                    ->orwhere('author', 'like','%'.$text.'%');
                }) 
                ->groupBy('books.id')->orderBy($order,$ascORdesc)->paginate(15)->setPath ( '' );
              
                $cat=Category::find($category)->name;
            }  
            else
            {  
                $allBooks = DB::table('books')
                ->select('books.*','books.title as title','books.rate as avgRate')
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
            $categories = Category::all();
        

            $selected = array("your input text is --> $text","order By --> $order","category is --> $cat");

            if (count($allBooks) > 0)
                return view('user.books.index',compact('allBooks', 'favourites','categories','selected'))->withQuery($text,$order,$category);    
        }

        $allBooks = Book::orderBy('title')->paginate(15);
        $favourites = Auth::user()->favourites->pluck("book_id")->toArray();
        $leases = Auth::user()->leases->pluck("book_id")->toArray();
        $categories = Category::all();
        return view('user.books.index',compact('allBooks', 'favourites', 'categories')); 
    }
}
