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
        'period' => $faker->randomNumber(),
        'integralIndicator' => $faker->boolean(),
        'idSystem' => $faker->randomElement($system)
    ];
});
