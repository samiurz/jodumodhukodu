<?php

use Faker\Generator as Faker;

$factory->define(App\Asset::class, function (Faker $faker) {
    return [
        'company_id' => $faker->randomDigit,
        'model_id' => $faker->randomDigit,
        'name' => $faker->text(30),
        'label_id' => $faker->randomDigit,
        'label_value' => $faker->randomDigit,
        'description' => $faker->text(30),
        'quality' => $faker->text(30),
        'cost' => $faker->randomDigit,
        'status' => $faker->text(30),
        'comments' => $faker->text(30),
        'update_by'=> $faker->randomDigit
    ];
});
