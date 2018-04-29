<?php

use Faker\Generator as Faker;

$factory->define(App\Spares::class, function (Faker $faker) {
    return [
        'account_id' => $faker->randomDigit,
        'asset_id' => $faker->randomDigit,
        'serial' => $faker->text(30),
        'type' => $faker->text(30),
        'description' => $faker->text(30),
        'image' => $faker->text(30),
        'manufacturar_id' => $faker->randomDigit,
        'minimum_stock' => $faker->randomDigit,
        'current_stock' => $faker->randomDigit,
        'comments' => $faker->text(30),
        'update_by'=>  $faker->randomDigit
    ];
});
