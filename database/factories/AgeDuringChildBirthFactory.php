<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\AgeDuringChildBirth;
use Faker\Generator as Faker;

$factory->define(AgeDuringChildBirth::class, function (Faker $faker) {
    return [
        'age_during_child_birth' => $faker->numberBetween(10, 45),
    ];
});
