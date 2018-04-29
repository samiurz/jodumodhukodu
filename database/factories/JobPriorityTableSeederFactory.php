<?php

use Faker\Generator as Faker;

$factory->define(App\JobPriority::class, function (Faker $faker) {
    return [
        'company_id' => $faker->randomDigit,
        'priority' => $faker->text(30),
        'comments' => $faker->text(30),
        'update_by'=>  $faker->randomDigit
    ];
});
