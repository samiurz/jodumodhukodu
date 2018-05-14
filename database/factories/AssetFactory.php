<?php

use Faker\Generator as Faker;

$factory->define(App\Asset::class, function (Faker $faker) {
    return [
        'company_id' => $faker->randomDigit,
        'asset_model_id' => $faker->randomDigit,
        'name' => $faker->text(30),
        'serial' => $faker->randomDigit,
        'label_id' => $faker->randomDigit,
        'label_value' => $faker->randomDigit,
        'description' => $faker->text(30),
        'manufacturer_id' => $faker->randomDigit,
        'quality_id' => $faker->randomDigit,
        'cost' => $faker->randomDigit,
        'asset_location_id' => $faker->randomDigit,
        'comments' => $faker->text(30),
        'image' => $faker->text(30),
        'asset_status_id'=> $faker->randomDigit,
        'minimum_stock'=> $faker->randomDigit,
        'current_stock'=> $faker->randomDigit,
        'is_enabled'=> $faker->randomDigit,
        'created_by'=> $faker->randomDigit,
        'update_by'=> $faker->randomDigit
    ];
});
