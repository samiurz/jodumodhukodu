<?php

use Faker\Generator as Faker;

$factory->define(App\Module::class, function (Faker $faker) {
    return [
        'block_id' => $faker->randomDigit,
        'name' => $faker->text(30),
        'comments' => $faker->text(30),
        'update_by'=>  $faker->randomDigit
    ];
});
