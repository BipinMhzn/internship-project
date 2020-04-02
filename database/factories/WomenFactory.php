<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Women;
use Faker\Generator as Faker;

$factory->define(Women::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'date_of_birth' => $faker->date(),
        'contact' => $faker->phoneNumber,
        'temporary_address' => $faker->streetAddress,
        'permanent_address' => $faker->streetAddress,
        'survey_date' => $faker->date()
    ];
});
