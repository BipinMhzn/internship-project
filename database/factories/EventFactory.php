<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Event;
use Faker\Generator as Faker;

$factory->define(Event::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'place' => $faker->address,
        'date' => $faker->date('Y-m-d'),
        'latitude' => $faker->latitude(-90, 90),
        'longitude' => $faker->longitude(-180, 180),
        'objective' => $faker->paragraph($nbSentences = 6,  $variableNbSentence = true),
        'prepared_by' => $faker->name,
        'checked_by' => $faker->name,
        'approved_by' => $faker->name
    ];
});
