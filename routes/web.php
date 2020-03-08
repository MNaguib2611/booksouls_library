<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();


//route that could be seen by logged in  users & admins
Route::group(['middleware' => 'auth'], function () {
    //if users are not active -> they will not continue further
    Route::group(['middleware' => 'active'], function () {
    
    //admin routes   ->only viewed by admins
    Route::group([
        'prefix' => "admin", //all admin routes will start with /admin
        'middleware' => 'admin'
        ],
        function () {
            Route::Resource('/admins', 'Admin\AdminController');
            Route::get('/dashboard', 'Admin\AdminController@dashboard')->name('admin.dashboard');
            Route::Resource('/users', 'Admin\AdminController');
            Route::Resource('/books', 'Admin\BookController');
            Route::Resource('/categories', 'Admin\CategoryController');
            Route::Resource('/leases', 'Admin\LeaseController');
            Route::Resource('/profits', 'Admin\ProfitController')->only(['index','store']);
    });//end of admin middleware


    //user routes  ->only viewed by users
    Route::group([
        'middleware' => 'endUser'],
        function () {
            Route::Resource('/books', 'User\BookController');
            Route::Resource('/leases', 'User\LeaseController');
            Route::Resource('/favourites', 'User\FavouriteController');
            Route::Resource('/reviews', 'User\ReviewController');

    });//end of endUser middleware


        Route::get('/home', 'HomeController@index')->name('home');
       
    }); //end of active middleware

});




