<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\ChildMarriage;
use Faker\Generator as Faker;

$factory->define(ChildMarriage::class, function (Faker $faker) {
    $know_child_marriage = $faker->boolean;
    $know_marriage_laws = $faker->boolean;

    return [
        'know_child_marriage' => $know_child_marriage,
        'child_marriage' => $know_child_marriage == 0 ? null : $faker->sentence,
        'girl_marry_age' => $faker->sentence,
        'boy_marry_age' => $faker->sentence,
        'first_child_age' => $faker->sentence,
        'know_marriage_laws' => $know_marriage_laws,
        'marriage_laws' => $know_marriage_laws == 0 ? null : $faker->sentence,
        'women_id' => $faker->unique()->numberBetween(1, App\Women::count()),
    ];
});
