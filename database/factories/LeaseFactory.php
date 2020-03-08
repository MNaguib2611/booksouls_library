<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Lease;
use App\User;
use App\Book;
use Faker\Generator as Faker;

$factory->define(Lease::class, function (Faker $faker) {
    return [
        'user_id'  =>User::inRandomOrder() -> first() -> id,
        'book_id'  =>Book::inRandomOrder() -> first() -> id,
        'duration' =>mt_rand(1, 10)
    ];
});
