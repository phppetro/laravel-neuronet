<?php

$factory->define(App\Deliverable::class, function (Faker\Generator $faker) {
    return [
        "label" => $faker->name,
        "title" => $faker->name,
        "project_id" => factory('App\Project')->create(),
        "link" => $faker->name,
    ];
});
