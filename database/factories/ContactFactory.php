<?php

use Faker\Generator as Faker;

$factory->define(App\Contact::class, function (Faker $faker) {
    return [
        'company_id' =>  $faker->randomDigit,
        'name' => $faker->text(30),
        'phone' => $faker->text(30),
        'links' => $faker->text(30),
        'email' => $faker->unique(30)->safeEmail,
        'password' => $faker->text(30),
        'update_by'=> $faker->randomDigit
    ];
});
