<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Participant;
use App\Event;
use Faker\Generator as Faker;

$factory->define(Participant::class, function (Faker $faker) {
    $sex = $faker->randomElement(['male', 'female', 'other']);
    $event_id = Event::all('id');

    return [
        'name' => $faker->name,
        'sex' => $sex,
        'contact' => $faker->phoneNumber,
        'photo' => $faker->unique()->imageUrl($width = 640, $height = 480, 'cats', true, 'Faker', true),
        'event_id' => $faker->randomElement($event_id)
    ];
});
