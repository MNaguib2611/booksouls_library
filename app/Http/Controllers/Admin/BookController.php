<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Book;
use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $allBooks = Book::all();
        return view('admin.books.index',compact('allBooks'));
    }


    /**
     * get all categories
     *
     * @return \Illuminate\Http\Response
     */
    public function getCategories(Request $request)
    {
        if($request->ajax())
        {
         $output = '';
         $query = $request->get('query');
         $data = Category::all();

         $total_row = $data->count();
         if($total_row > 0)
         {
          $output .= "<option value='0'> all </option> ";
          foreach($data as $row)
          {
               $output .= "<option value='$row->id'> $row->name</option> ";
          }
         }
         else
         {
          $output = '';;
         }
         $data = array(
          'cat'  => $output
         );
   
         echo json_encode($data);
        }
   
    }



    /**
     * Search
     *
     * @return \Illuminate\Http\Response
     */
    public function selectedData(Request $request)
    {
      
     if($request->ajax())
     {
      $output = '';
      $myCategoryID = 0;
      $order="";
      $filter=$request->get('filt');
      $myOrder= explode("/",$filter)[0];
      $myCategoryID= (int) explode("/",$filter)[1];
      $text = $request->get('text');
      
      if($myOrder=="title")
         $order="asc";
      else
         $order="DESC";

         
    
      if($myCategoryID > 0)
      {

        $selectedRows = DB::table('books')->leftJoin('reviews', 'books.id', '=','reviews.book_id' )
        ->select('books.*','books.id as myID','books.title as title', DB::raw('avg(reviews.rate) as avgRate '))
        ->where('books.category_id', '=', $myCategoryID)
        // ->where(function ($query)
        //  { 
        //    $query-> where('title', 'like', '%'.$text.'%')
        //    ->orwhere('author', 'like','%'.$text.'%');
        //   })
        ->groupBy('books.id')->orderBy($myOrder,'asc')->get();

       // $selectedRows = DB::table('books')->where('books.category_id', '=', 4)->get();
      }  
      else
      {  
        $selectedRows = DB::table('books')->leftJoin('reviews', 'books.id', '=','reviews.book_id')
          ->select('books.*','books.id as myID',
          'books.title as title', DB::raw('avg(reviews.rate) as avgRate '))
          ->where('title', 'like', '%'.$text.'%')
          ->orwhere('author', 'like','%'.$text.'%')
          ->groupBy('books.id')->orderBy($myOrder,$order)->get();

          //$selectedRows = DB::table('books')->get();
      }  
     

      $total_rows = $selectedRows->count();          
      $data = array(
        'total_rows'  => $total_rows,
        'selectedRows' => $selectedRows,
      );

      echo json_encode($data);
     }
 
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
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
        $this->validate($request,[
            'title' => 'required|min:3',
            'description' => 'required',
            'author' => 'required',
            'quantity' => 'required|min:0',
            'price' => 'required|min:0',
            'categories' => 'required',
            'cover' => 'required'
          ]);

        $book = new Book;
        $book->title=request('title'); 
        $book->description=request('description'); 
        $book->author=request('author'); 
        $book->quantity=request('quantity'); 
        $book->price=request('price');         
        $book->category_id=(Category::where('name',request('categories'))->pluck('id')->first()); 
        
        $imageName = time().'.'.request('cover')->extension();  
        request('cover')->move(public_path('imgs/books'), $imageName); 

        $book->cover = asset('/imgs/books').'/'.$imageName;

        
        $book->save();   

        return redirect('admin/books')->with('success', 'new Book add successfully');
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
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function edit(Book $book)
    {
      $myBook = Book::find($book->id);
      $allCategories=Category::get();
      return view('admin.books.edit')->with(['myBook'=> $myBook,'allCategories'=>$allCategories]);
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
        $request->validate([
            'title' => 'required|min:3',
            'description' => 'required',
            'author' => 'required',
            'quantity' => 'required|min:0',
            'price' => 'required|min:0',  
            'categories' => 'required'
          ]);
    
          $book = Book::find($book->id);
          $book->title=request('title'); 
          $book->description=request('description'); 
          $book->author=request('author'); 
          $book->quantity=request('quantity'); 
          $book->price=request('price');         
          $book->category_id=(Category::where('name',request('categories'))->pluck('id')->first()); 
        
      
        

          if(request('cover'))
          {
            $imageName = time().'.'.request('cover')->extension();  
            request('cover')->move(public_path('imgs/books'), $imageName); 
            $book->cover = asset('/imgs/books').'/'.$imageName;
          }
         
        

          $book->save();   
  
          return redirect('admin/books')->with('success', ' Book updated successfully');                           
    }

    
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function destroy(Book $book)
    {
        $myBook = Book::find($book)->first();
        $myBook->delete();
        //return response()->json(['success' => 'Record deleted successfully!']);
        return redirect('admin/books')->with('success', 'Book deleted successfully');   
    }

    public function deleteBook(Request $request){

      if($request->ajax())
        {
         $bookID = $request->input('bookID');

         $message = DB::delete('delete from books where id = ?',[$bookID]);
         
          $data = array(
            'message'  => $message
           );
     
           echo json_encode($data);
          }
      }
}
