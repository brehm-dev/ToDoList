<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Procedure;
use Faker\Generator as Faker;

$factory->define(Procedure::class, function (Faker $faker) {
    $states = ['active', 'pause', 'finish'];
    return [
        'content_type' => 'todo',
        'content' => $faker->text(100),
        'state' => $states[array_rand($states)],
        'schedule_id' => function () {
            return factory(\App\Schedule::class)->create()->id;
        }
    ];
});
