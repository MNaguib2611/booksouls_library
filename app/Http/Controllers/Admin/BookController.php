<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Book;
use App\Category;
use Illuminate\Http\Request;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $allBooks = Book::latest()->paginate(3);
        $allBooks = Book::all();
        
        //return view('admin.books.index',compact('allBooks'))->with('i',(request()->input('page',1)-1)*5);
        return view('admin.books.index',compact('allBooks'));
       
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $allCategories = Category::all();
        return view('admin.books.create',compact('allCategories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //  return $request->all();

        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'author' => 'required',
            'quantity' => 'required',
            'price' => 'required',
            'categories' => 'required',
            'cover' => 'required'
          ]);
        
          //Book::create($request->all());
        $book =new Book;
        $book->title=request('title'); 
        $book->description=request('description'); 
        $book->author=request('author'); 
        $book->quantity=request('quantity'); 
        $book->price=request('price');         
        $book->category_id=(Category::where('name',request('categories'))->pluck('id')->first()); 
        $book->cover=request('cover');      
        $book->save();   

        return redirect('admin/books')
                         ->with('success', 'new Book add successfully');
                         

        // return $request->all();
       
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function show(Book $book)
    {
        $myBook = Book::find($book->id);
        $myCategory=Category::find($book->category_id);

        //return $myBook;
         return view('admin.books.show')->with(['myBook'=> $myBook,'myCategory'=>$myCategory]);

       //return "show";

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function edit(Book $book)
    {
  
        $myBook = Book::find($book)->first();
        $allCategories=Category::get();

        return view('admin.books.edit')->with(['myBook'=> $myBook,'allCategories'=>$allCategories]);


        //return "hi";
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Book $book)
    {
        //

        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'author' => 'required',
            'quantity' => 'required',
            'price' => 'required',
            'categories' => 'required',
            'cover' => 'required'
          ]);
    
          $book = Book::find($book)->first();
          $book->title=request('title'); 
          $book->description=request('description'); 
          $book->author=request('author'); 
          $book->quantity=request('quantity'); 
          $book->price=request('price');         
          $book->category_id=(Category::where('name',request('categories'))->pluck('id')->first()); 
          $book->cover=request('cover');      
          $book->save();   
  
          return redirect('admin/books')
                           ->with('success', ' Book updated successfully');
                           
  
        //return $request->all();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function destroy(Book $book)
    {
        //

       
        $myBook = Book::find($book)->first();
        // $myBook = Book::findOrFail($book);
        $myBook->delete();
        return redirect('admin/books')->with('success', 'Book deleted successfully');
          //return "hi";
   
    }
}
