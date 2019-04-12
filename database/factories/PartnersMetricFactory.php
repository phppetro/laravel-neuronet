<?php

$factory->define(App\PartnersMetric::class, function (Faker\Generator $faker) {
    return [
        "name" => $faker->name,
        "number" => $faker->randomNumber(2),
    ];
});
