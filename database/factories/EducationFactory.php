<?php
$factory->define(App\Education::class, function (Faker\Generator $faker) {
    return [
        "name" => $faker->name,
    ];
});
