<?php

namespace App\Http\Controllers\User;
use App\Http\Controllers\Controller;

use App\Category;
use App\Book;
use Auth;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        foreach ($categories as $category){
            $count_list [] = $category->books()->count();
        }
        return view('user.categories.index', compact('categories', 'count_list'));
    }

    public function show(Category $category)
    {
        $books = Book::where('category_id', $category->id)->paginate(15);
        $favourites = Auth::user()->favourites->pluck("book_id")->toArray();
        $leases = Auth::user()->leases->pluck("book_id")->toArray();
        return view('user.categories.show',compact('books', 'favourites', 'leases', 'category'));
    }
}
