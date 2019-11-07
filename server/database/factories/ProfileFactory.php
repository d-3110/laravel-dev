<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Profile;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(Profile::class, function (Faker $faker) {
    return [
        'user_id' => 1,
        'name' => $faker->name,
        'gender' => $faker->numberBetween($min = 0, $max = 1),
        'birthday' => $faker->dateTimeThisCentury,
        'favorite_food' => $faker->word,
        'hated_food' => $faker->word,
        'personality_1' => $faker->numberBetween($min = 1, $max = 5),
        'personality_2' => $faker->numberBetween($min = 1, $max = 5),
        'personality_3' => $faker->numberBetween($min = 1, $max = 5),
        'personality_4' => $faker->numberBetween($min = 1, $max = 5),
        'personality_5' => $faker->numberBetween($min = 1, $max = 5),
        'personality_6' => $faker->numberBetween($min = 1, $max = 5),
        'age_1' => $faker->numberBetween($min = 1, $max = 5),
        'age_2' => $faker->numberBetween($min = 1, $max = 5),
        'age_3' => $faker->numberBetween($min = 1, $max = 5),
        'age_4' => $faker->numberBetween($min = 1, $max = 5),
        'age_5' => $faker->numberBetween($min = 1, $max = 5),
        'age_6' => $faker->numberBetween($min = 1, $max = 5),
    ];
});
