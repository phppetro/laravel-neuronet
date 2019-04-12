<?php

$factory->define(App\ProjectsMetric::class, function (Faker\Generator $faker) {
    return [
        "name" => $faker->name,
        "funding" => $faker->randomFloat(2, 1, 100),
    ];
});
