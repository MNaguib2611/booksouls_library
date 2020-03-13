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
        // $allBooks = Book::latest()->paginate(3);
        $allBooks = Book::all();
        
        //return view('admin.books.index',compact('allBooks'))->with('i',(request()->input('page',1)-1)*5);
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
     * get avrage rate
     *
     * @return \Illuminate\Http\Response
     */
    public function getAvrage(Request $request)
    {
        if($request->ajax())
        {
         $output = '';
         $query = $request->get('query');
         
         


        $getavrage = DB::table('books')->leftJoin('reviews','books.id' , '=', 'reviews.book_id')
        ->select('books.*','books.id as myID','reviews.*', DB::raw('avg(rate) as rate '))
        ->groupBy('books.title')->get()->sortByDESC('rate'); 
         
        $total_row = $getavrage->count();
         
         if($total_row > 0)
         {
          foreach($getavrage as $row)
          {
              $rate;
              if($row->rate)
              {
                $rate=$row->rate;
              }
              else
              {
                $rate=0;
              }
               $output .= "<tr>
               <td class='align-middle'>$row->myID </td>
               <td class='align-middle'>$row->title</td>
               <td class='align-middle'>$rate</td>
               
               <td class='align-middle'>$row->author</td>
               <td class='align-middle'>$row->cover</td>
               <td class='align-middle'> <a href=\"books/{$row->myID}\"> <button class=\"btn btn-primary\">Show</button></a></td>
               <td class='align-middle'> <a href=\"books/{$row->myID}/edit\"> <button class=\"btn btn-success\">Update</button></a> </td>
               <td class='align-middle'>
              
           
               <form action=\"/admin/books/{$row->book_id}\" method='POST'>
               <input type='hidden' name='_method' value='DELETE'>
               <input type='hidden' name='_token' value='".  csrf_token() ."'>
               <button class=\"btn btn-danger\" type=\"submit\" >Delete</button>
               </form>
   
               </td>
           
               </tr>";
   
               
          }
         }
         else
         {
          $output = '
          <tr>
           <td align="center" colspan="5">No Data Found</td>
          </tr>
          ';
         }
         $data = array(
          'table_data'  => $output,
         );
   
         echo json_encode($data);
        }
    

    }

    /**
     * Search
     *
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
     if($request->ajax())
     {
      $output = '';
      $query = $request->get('query');
      if($query != '')
      {
        $data = Book::where('title', 'like', '%'.$query.'%')->orWhere('author', 'like', '%'.$query.'%')->orderBy('title')->get();       
      }
      else
      {
        $data=Book::all()->sortBy('title');
      }
      $total_row = $data->count();
      if($total_row > 0)
      {
       foreach($data as $row)
       {
            $output .= "<tr>
            <td class='align-middle'>$row->title</td>
            <td class='align-middle'>$row->author</td>
            <td class='align-middle'>$row->cover</td>
            <td class='align-middle'> <a href=\"books/{$row->id}\"> <button class=\"btn btn-primary\">Show</button></a></td>
            <td class='align-middle'> <a href=\"books/{$row->id}/edit\"> <button class=\"btn btn-success\">Update</button></a> </td>
            <td class='align-middle'>
           
        
            <form action=\"/admin/books/{$row->id}\" method='POST'>
            <input type='hidden' name='_method' value='DELETE'>
            <input type='hidden' name='_token' value='".  csrf_token() ."'>
            <button class=\"btn btn-danger\" type=\"submit\" >Delete</button>
            </form>

            </td>
        
            </tr>";

            
       }
      }
      else
      {
       $output = '
       <tr>
        <td align="center" colspan="5">No Data Found</td>
       </tr>
       ';
      }
      $data = array(
       'table_data'  => $output,
       'total_data'  => $total_row
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
      $myOrder = $request->get('orderBy');
      $myCategoryID = $request->get('category');
      $text = $request->get('text');
      if($text != '')
      {
        if($myCategoryID == 0)
        {
          $data = DB::table('books')->leftJoin('reviews','books.id' , '=', 'reviews.book_id')
          ->select('books.*','books.id as myID','books.created_at as creation','reviews.*', DB::raw('avg(rate) as rate '))
          ->where('title', 'like', '%'.$text.'%')
          ->orWhere('author', 'like', '%'.$text.'%')
          ->groupBy('books.title')->get()->sortBy($myOrder);
        }  
        else
        {
          $data = DB::table('books')->leftJoin('reviews','books.id' , '=', 'reviews.book_id')
          ->select('books.*','books.id as myID','books.created_at as creation','reviews.*', DB::raw('avg(rate) as rate '))
          ->where('category_id', '=', $myCategoryID)
          ->where(function ($query) {
            $query->where('title', 'like', '%'.$text.'%')
            ->orWhere('author', 'like', '%'.$text.'%');
           })
          ->groupBy('books.title')->get()->sortBy($myOrder);
        
        
        }     
      }
      else
      {
        if($myCategoryID == 0)
        {        
          $data = DB::table('books')->leftJoin('reviews','books.id' , '=', 'reviews.book_id')
          ->select('books.*','books.id as myID','books.created_at as creation','reviews.*', DB::raw('avg(rate) as rate '))
          ->groupBy('books.title')->get()->sortBy($myOrder);
        
        }  
        else
        {
          $data = DB::table('books')->leftJoin('reviews','books.id' , '=', 'reviews.book_id')
          ->select('books.*','books.id as myID','books.created_at as creation','reviews.*', DB::raw('avg(rate) as rate '))
          ->where('category_id', '=', $myCategoryID)
          ->groupBy('books.title')->get()->sortBy($myOrder);
        
        } 
     }
      $total_row=0;
      try{
          $total_row = $data->count();
      }
      catch (Exception $e) {
          $total_row=0;    
      }

      if($total_row > 0)
      {
        $output .= "<tr> <td> $total_row </td> <td> ".$myOrder.$myCategoryID .$text  ."</td> </tr>";
       foreach($data as $row)
       {
         if($row->rate==null)
         {
           $rate=0;
         }
         else
         {
          $rate=$row->rate;
         }
            $output .= "<tr>
            <td class='align-middle'>$row->title</td>
            <td class='align-middle'>$row->author</td>
            <td class='align-middle'>$rate</td>
            <td class='align-middle'>$row->creation</td>
            <td class='align-middle'>$row->category_id</td>
            <td class='align-middle'>$row->cover</td>
            <td class='align-middle'> <a href=\"books/{$row->myID}\"> <button class=\"btn btn-primary\">Show</button></a></td>
            <td class='align-middle'> <a href=\"books/{$row->myID}/edit\"> <button class=\"btn btn-success\">Update</button></a> </td>
            <td class='align-middle'>
           
            
        

            <form action=".route('books.destroy',[$row->myID])." method=\"POST\">
 @method('DELETE')
 @csrf
 <button type=\"submit\">Delete</button>               
</form>

            </td>
        
            </tr>";

            
       }
      }
      else
      {
       $output = '
       <tr>
        <td align="center" colspan="5">No Data Found</td>
       </tr>
       ';
      }
      
      $data = array(
      // 'table_data'  => "<td> ".$myOrder.$myCategoryID .$text  ."</td>"
      'table_data'  => $output,
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
