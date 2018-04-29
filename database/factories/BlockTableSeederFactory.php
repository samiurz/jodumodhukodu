<?php

use Faker\Generator as Faker;

$factory->define(App\Block::class, function (Faker $faker) {
    return [
        'name' => $faker->text(30),
        'comments' => $faker->text(30),
        'update_by'=> $faker->randomDigit
    ];
});