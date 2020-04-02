<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\MarriageDetail;
use Faker\Generator as Faker;

$factory->define(MarriageDetail::class, function (Faker $faker) {
    return [
        'age_of_marriage' => $faker->numberBetween(10,20),
        'number_of_years_of_marriage' => $faker->numberBetween(1,90),
        'number_of_sons' => $faker->numberBetween(0,5),
        'number_of_daughters' => $faker->numberBetween(0,5),
        'number_of_others' => $faker->numberBetween(0,5),
        'women_id' => $faker->unique()->numberBetween(1, App\Women::count()),
    ];
});
