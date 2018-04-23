<?php

use Faker\Generator as Faker;

$factory->define(App\Company::class, function (Faker $faker) {
    return [
        'account_id' => $faker->text(30),
        'company_name' => $faker->text(30),
        'is_customer' => $faker->text(30),
        'links' => $faker->text(30),
        'email' => $faker->unique(30)->safeEmail,
        'address' => $faker->text(30),
        'update_by'=> $faker->text(30)
    ];
});
