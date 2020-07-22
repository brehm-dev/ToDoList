<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Schedule;
use App\ToDo;
use App\User;
use Faker\Generator as Faker;

$factory->define(ToDo::class, function (Faker $faker) {
    return [
        'creator_user_id' => $faker->randomElement(User::all()->modelKeys()),
        'schedule_id' => $faker->randomElement(Schedule::all()->modelKeys()),
        'title' => $faker->text(100),
        'description' => $faker->realText(),

    ];
});
