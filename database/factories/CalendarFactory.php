<?php

$factory->define(App\Calendar::class, function (Faker\Generator $faker) {
    return [
        "date" => $faker->date("d-m-Y H:i:s", $max = 'now'),
        "title" => $faker->name,
    ];
});
