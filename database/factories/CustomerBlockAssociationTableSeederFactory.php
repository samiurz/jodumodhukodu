<?php

use Faker\Generator as Faker;

$factory->define(App\CustomerBlockAssociation::class, function (Faker $faker) {
    return [
        'company_id' => $faker->randomDigit,
        'block_id' => $faker->randomDigit,
        'comments' => $faker->text(30),
        'update_by'=> $faker->randomDigit
    ];
});
