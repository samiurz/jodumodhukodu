<?php

use Faker\Generator as Faker;

$factory->define(App\Activity::class, function (Faker $faker) {
    return [
        'name' => $faker->text(30),
        'comments' => $faker->text(30),
        'update_by'=> $faker->randomDigit
    ];
});
