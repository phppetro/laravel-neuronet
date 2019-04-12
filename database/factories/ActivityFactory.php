<?php

$factory->define(App\Activity::class, function (Faker\Generator $faker) {
    return [
        "user_id" => factory('App\User')->create(),
        "date" => $faker->date("d-m-Y", $max = 'now'),
        "body" => $faker->name,
    ];
});
