<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\HealthDetail;
use Faker\Generator as Faker;

$factory->define(HealthDetail::class, function (Faker $faker) {
    $used_contraceptive_device = $faker->boolean;
    $menopause =  $faker->boolean;
    $health_problem = $faker->boolean;

    return [
        'used_contraceptive_device' => $used_contraceptive_device,
        'type_of_contraceptive_device' => $used_contraceptive_device == 0 ? null : $faker->boolean,
        'contraceptive_device' => $used_contraceptive_device == 0 ? null : $faker->sentence,
        'age_of_first_mensuration' => $faker->randomDigit,
        'menopause' => $menopause,
        'age_of_menopause' => $menopause == 0 ? null : $faker->randomDigit,
        'have_health_problem' => $health_problem,
        'health_problem' => $health_problem == 0 ? null : $faker->sentence,
        'women_id' => $faker->unique()->numberBetween(1, App\Women::count()),
    ];
});
