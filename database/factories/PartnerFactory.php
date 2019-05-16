<?php
$factory->define(App\Partner::class, function (Faker\Generator $faker) {
    return [
        "name" => $faker->name,
        "type_of_institution_id" => factory('App\TypeOfInstitution')->create(),
        "country_id" => factory('App\Country')->create(),
    ];
});
