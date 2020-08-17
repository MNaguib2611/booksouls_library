<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Lease;
use App\User;
use App\Book;
use Carbon\Carbon;
use Faker\Generator as Faker;

$factory->define(Lease::class, function (Faker $faker) {
    Lease::flushEventListeners();
    $duration=mt_rand(1, 10);
    return [
        'user_id'  =>User::inRandomOrder() -> first() -> id,
        'book_id'  =>Book::inRandomOrder() -> first() -> id,
        'duration' =>$duration,
        'end_date' =>Carbon::now()->addDays($duration),
    ];
});