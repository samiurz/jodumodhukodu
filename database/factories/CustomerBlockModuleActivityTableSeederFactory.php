<?php

use Faker\Generator as Faker;

$factory->define(App\CustomerBlockModuleActivity::class, function (Faker $faker) {
    return [
        'contact_id' => $faker->randomDigit,
        'customer_block_id' => $faker->randomDigit,
        'module_id' => $faker->randomDigit,
        'activity_id' => $faker->randomDigit,
        'comments' => $faker->text(30),
        'update_by'=> $faker->randomDigit
    ];
});
