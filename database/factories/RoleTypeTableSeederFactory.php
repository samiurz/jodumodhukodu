<?php

use Faker\Generator as Faker;

$factory->define(App\RoleType::class, function (Faker $faker) {
    return [
        'name' => $faker->text(30),
        'comments' => $faker->text(30),
        'is_enabled'=> $faker->randomDigit,
        'created_by'=> $faker->randomDigit,
        'update_by'=>  $faker->randomDigit
    ];
});
