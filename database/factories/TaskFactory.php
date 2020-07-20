<?php


use App\Task;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

/** @var Factory $factory */
$factory->define(Task::class, function (Faker $faker) {
    return [
        'creator_user_id' => factory(\App\User::class)
    ];
});
