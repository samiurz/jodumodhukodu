<?php

use Faker\Generator as Faker;

$factory->define(App\AssetImageRecord::class, function (Faker $faker) {
    return [
        'company_id' => $faker->randomDigit,
        'asset_id' => $faker->randomDigit,
        'image' => $faker->text(30),
        'description' => $faker->text(30),
        'update_by'=> $faker->randomDigit
    ];
});
