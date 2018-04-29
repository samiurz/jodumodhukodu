<?php

use Faker\Generator as Faker;

$factory->define(App\LabelName::class, function (Faker $faker) {
    return [
        'name' => $faker->text(30),
        'description' => $faker->text(30),
        'update_by'=>  $faker->randomDigit
    ];
});
