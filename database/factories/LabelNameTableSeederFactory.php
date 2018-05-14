<?php

use Faker\Generator as Faker;

$factory->define(App\LabelName::class, function (Faker $faker) {
    return [
        'name' => $faker->text(30),
        'description' => $faker->text(30),
        'is_enabled'=> $faker->randomDigit,
        'created_by'=> $faker->randomDigit,
        'update_by'=>  $faker->randomDigit
    ];
});
