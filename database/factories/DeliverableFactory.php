<?php

$factory->define(App\Deliverable::class, function (Faker\Generator $faker) {
    return [
        "label" => $faker->name,
        "title" => $faker->name,
        "wp_id" => factory('App\WorkPackage')->create(),
        "project_id" => factory('App\Project')->create(),
        "link" => $faker->name,
    ];
});
