<?php

use Faker\Generator as Faker;

$factory->define(App\JobPriority::class, function (Faker $faker) {
    return [
        'company_id' => $faker->randomDigit,
        'priority' => $faker->text(30),
        'comments' => $faker->text(30),
        'is_enabled'=> $faker->randomDigit,
        'created_by'=> $faker->randomDigit,
        'update_by'=>  $faker->randomDigit
    ];
});
