<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Favourite;
use App\User;
use App\Book;
use Faker\Generator as Faker;

$factory->define(Favourite::class, function (Faker $faker) {
    return [
        'user_id'  => User::inRandomOrder() -> first() -> id,
        'book_id'  => Book::inRandomOrder() -> first() -> id
    ];
});
