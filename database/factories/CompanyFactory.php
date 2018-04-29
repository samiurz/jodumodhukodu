<?php

use Faker\Generator as Faker;

$factory->define(App\Company::class, function (Faker $faker) {
    return [
        'account_id' => $faker->randomDigit,
        'name' => $faker->text(30),
        'is_customer' => $faker->randomDigit,
        'links' => $faker->text(30),
        'email' => $faker->unique(30)->safeEmail,
        'address' => $faker->text(30),
        'comments' => $faker->text(30),
        'update_by'=> $faker->randomDigit
    ];
});
