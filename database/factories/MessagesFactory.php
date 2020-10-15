<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\Message;
use App\Model;
use Faker\Generator as Faker;

$factory->define(Message::class, function (Faker $faker) {
    return [
        'body' => $faker->word,
        'group_id' => 1,
        'user_id' => $faker->numberBetween($min = 1, $max = 2)
    ];
});
