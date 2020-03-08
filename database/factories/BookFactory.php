<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Book;
use App\Category;
use Faker\Generator as Faker;

$factory->define(Book::class, function (Faker $faker) {
    return [
        'title'           => $faker->lastName,
        'description'     => $faker->text,
        'author'          => $faker->name,
        'quantity'        => mt_rand(0, 10),
        'price'           => mt_rand(5, 15),
        'category_id'     =>function () {
            return Category::inRandomOrder()
                -> first()
                -> id;
        },  
        'cover'           =>"https://picsum.photos/500/500",
    ];
});
