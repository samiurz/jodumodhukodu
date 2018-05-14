<?php

use Faker\Generator as Faker;

$factory->define(App\ModelType::class, function (Faker $faker) {
    return [
        'company_id' => $faker->randomDigit,
        'make' => $faker->text(30),
        'type' => $faker->text(30),
        'comments' => $faker->text(30),
        'is_enabled'=> $faker->randomDigit,
        'created_by'=> $faker->randomDigit,
        'update_by'=>  $faker->randomDigit
    ];
});
