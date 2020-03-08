<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Profit;
use Faker\Generator as Faker;

$factory->define(Profit::class, function (Faker $faker) {
    return [
        'profit' =>mt_rand(100, 3500)
    ];
});
