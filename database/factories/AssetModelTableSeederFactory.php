<?php

use Faker\Generator as Faker;

$factory->define(App\AssetModel::class, function (Faker $faker) {
    return [
        'company_id' => $faker->randomDigit,
        'model_type_id' => $faker->randomDigit,
        'name' => $faker->text(30),
        'image' => $faker->text(30),
        'rent' => $faker->randomDigit,
        'frequency' => $faker->randomDigit,
        'minimum_stock' => $faker->randomDigit,
        'current_stock' => $faker->randomDigit,
        'comments' => $faker->text(30),
        'update_by'=> $faker->randomDigit
    ];
});
