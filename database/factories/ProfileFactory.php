<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Profile;
use Faker\Generator as Faker;

$factory->define(Profile::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'lastname' => $faker->unique()->safeEmail,
        'birthday' => $faker->dateTime($max = '15/10/2001'),
        'phone' => $faker->phoneNumber,
        'address' => $faker->unique()->address,
    ];
});
