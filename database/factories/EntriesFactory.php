<?php

use Faker\Generator as Faker;
use App\Models\System;

$factory->define(App\Models\Entry::class, function (Faker $faker) {

  $system = System::all()->pluck('idSystem')->toArray();

    return [
        'name' => $faker->name,
        'unitaryPrice' => $faker->randomNumber(),
        'measureUnity' => $faker->word,
        'priceSource' => $faker->word,
        'datePriceSource' => $faker->word,
        'quantity' => $faker->randomNumber(),
        'period' => $faker->randomNumber($nbDigits = 2, $strict = false),
        'integralIndicator' => $faker->boolean(),
        'total' => $faker->randomNumber(),
        'rememberToken' => str_random(10),
        'idSystem' => $faker->randomElement($system)
    ];
});
