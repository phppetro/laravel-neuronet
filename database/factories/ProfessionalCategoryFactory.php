<?php
$factory->define(App\ProfessionalCategory::class, function (Faker\Generator $faker) {
    return [
        "name" => $faker->name,
    ];
});
