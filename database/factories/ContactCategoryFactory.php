<?php

$factory->define(App\ContactCategory::class, function (Faker\Generator $faker) {
    return [
        "name" => $faker->name,
    ];
});
