<?php

use Faker\Generator as Faker;

$factory->define(App\Contact::class, function (Faker $faker) {
    return [
        'company_id' => $faker->text(30),
        'contact_name' => $faker->text(30),
        'phone' => $faker->text(30),
        'links' => $faker->text(30),
        'email' => $faker->unique(30)->safeEmail,
        'password' => $faker->text(30),
        'update_by'=> $faker->text(30)
    ];
});
