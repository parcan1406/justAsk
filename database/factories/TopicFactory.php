<?php

use Faker\Generator as Faker;

$factory->define(App\Topic::class, function (Faker $faker) {
    return [
        'name' => str_random(7),
        'description' => str_random(20),
    ];
});
