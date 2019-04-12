<?php

$factory->define(App\Document::class, function (Faker\Generator $faker) {
    return [
        "name" => $faker->name,
    ];
});
