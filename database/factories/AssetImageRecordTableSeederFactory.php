<?php

use Faker\Generator as Faker;

$factory->define(App\AssetImageRecord::class, function (Faker $faker) {
    return [
        'company_id' => $faker->randomDigit,
        'asset_id' => $faker->randomDigit,
        'image' => $faker->text(30),
        'description' => $faker->text(30),
        'is_enabled'=> $faker->randomDigit,
        'created_by'=> $faker->randomDigit,
        'update_by'=> $faker->randomDigit
    ];
});
