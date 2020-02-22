<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\User;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(User::class, function (Faker $faker) {
    return [
        'email' => $faker->unique()->safeEmail,
        'password' => bcrypt('password'),
        'dept_id' => $faker->numberBetween($min = 1, $max = 5),
        'job_id' => $faker->numberBetween($min = 1, $max = 7),
        'is_admin' => $faker->numberBetween($min = 0, $max = 1),
        'remember_token' => Str::random(10),
    ];
});
