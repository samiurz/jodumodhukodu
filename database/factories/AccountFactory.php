<?php

use Faker\Generator as Faker;

$factory->define(App\Account::class, function (Faker $faker) {
    return [
        'name' => $faker->text(30),
        'email' => $faker->unique(30)->safeEmail,
        'comments' => $faker->text(30),
        'update_by'=> $faker->randomDigit
    ];
});
