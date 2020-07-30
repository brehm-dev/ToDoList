<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Schedule;
use Faker\Generator as Faker;

$factory->define(Schedule::class, function (Faker $faker) {
    $types = ['private', 'global'];
    return [
        'name' => $faker->userName,
        'type' => $types[array_rand($types)],
        'owner_id' => function () {
            return factory(\App\User::class)->create()->id;
        }
    ];
});
