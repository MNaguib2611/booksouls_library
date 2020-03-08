<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\User;
use App\Book;
use App\Review;
use Faker\Generator as Faker;

$factory->define(Review::class, function (Faker $faker) {
    return [
        'user_id' => User::where('isAdmin',0)->inRandomOrder() -> first() -> id ,
        'book_id' => Book::inRandomOrder() -> first() -> id,
        'comment' =>$faker ->text,
        'rate'    =>$faker -> numberBetween(1, 5)
    ];
});
