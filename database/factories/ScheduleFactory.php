<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Schedule;
use Faker\Generator as Faker;

$factory->define(Schedule::class, function (Faker $faker) {
    $roles = ['ROLE_USER', 'ROLE_MASTER', 'ROLE_ADMIN'];
    return [
        'name' => $faker->domainName,
        'visibility' => $roles[array_rand($roles)],
        'description' => $faker->text,
        'slug' => $faker->sha256
    ];
});
