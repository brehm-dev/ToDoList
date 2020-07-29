<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Schedule;
use Faker\Generator as Faker;

$factory->define(Schedule::class, function (Faker $faker) {
    $types = ['private', 'global'];
    return [
        'owner_id' => 1,
        'name' => $faker->userName,
        'type' => $types[array_rand($types)],
        'info' => $faker->text(500)
    ];
});
