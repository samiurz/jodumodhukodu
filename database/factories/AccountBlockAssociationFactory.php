<?php

use Faker\Generator as Faker;

$factory->define(App\AccountBlockAssociation::class, function (Faker $faker) {
    return [
        'account_id' => $faker->randomDigit,
        'block_id' => $faker->randomDigit,
        'block_stat_id' => $faker->randomDigit,
        'comments' => $faker->text(30),
        'is_enabled'=> $faker->randomDigit,
        'created_by'=> $faker->randomDigit,
        'update_by'=>  $faker->randomDigit
    ];
});
