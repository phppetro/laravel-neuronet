<?php

$factory->define(App\Contact::class, function (Faker\Generator $faker) {
    return [
        "first_name" => $faker->name,
        "last_name" => $faker->name,
        "category_id" => factory('App\ContactCategory')->create(),
        "phone1" => $faker->name,
        "phone2" => $faker->name,
        "email" => $faker->name,
        "skype" => $faker->name,
        "address" => $faker->name,
    ];
});
