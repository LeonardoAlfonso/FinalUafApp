<?php

use Faker\Generator as Faker;
use App\Models\System;

$factory->define(App\Models\Cost::class, function (Faker $faker) {

  $system = System::all()->pluck('idSystem')->toArray();

    return [
        'detail' => $faker->name,
        'group' => $faker->name,
        'subGroup' => $faker->word,
        'unitaryCost' => $faker->randomNumber(),
        'quantity' => $faker->randomNumber(),
        'period' => $faker->randomNumber($nbDigits = 2, $strict = false),
        'total' => $faker->randomNumber(),
        'rememberToken' => str_random(10),
        'idSystem' => $faker->randomElement($system)
    ];
});
