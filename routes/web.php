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
            Route::put('/downgrade/{admin}', 'Admin\AdminController@downgrade')->name('admin.downgrade');
            Route::get('/dashboard', 'Admin\AdminController@dashboard')->name('admin.dashboard');
            Route::Resource('/users', 'Admin\UserController')->only(['index','show','destroy']);
            Route::put('users/downgrade/{user}', 'Admin\UserController@upgrade')->name('user.upgrade');
            Route::put('users/activate/{user}', 'Admin\UserController@activate')->name('user.activate');
            Route::put('users/deactivate/{user}', 'Admin\UserController@deactivate')->name('user.deactivate');
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
            Route::get('profile',  ['as' => 'users.edit', 'uses' => 'User\ProfileController@edit']);
            Route::patch('users/{user}/update',  ['as' => 'users.update', 'uses' => 'User\ProfileController@update']);
            Route::delete('/remove-favourite', 'User\FavouriteController@removeFavourite')->name('removeFavourite');
            Route::delete('/remove-lease', 'User\LeaseController@removeLease')->name('removeLease');

    });//end of endUser middleware


        Route::get('/home', 'HomeController@index')->name('home');
       
    }); //end of active middleware

});




