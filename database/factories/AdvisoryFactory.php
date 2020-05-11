<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Advisory;
use Faker\Generator as Faker;

$factory->define(Advisory::class, function (Faker $faker) {

    $title = $faker->sentence(4);

    return [
        'user_id' 		=> rand(1,30),
        'category_id' 	=> rand(1,20),
        'level_id' 	    => rand(1,3),
        'title' 		=> $title,
        'delivery'      => $faker->dateTimeBetween('now', '+1 years'),
        'price' 		=> $faker->numberBetween(10000,1000000),
        'hours' 		=> $faker->numberBetween(1,8),
        'body' 			=> $faker->text(500),
    ];
});
