<?php

use Faker\Generator as Faker;
use App\Models\System;

$factory->define(App\Models\SystemIndicator::class, function (Faker $faker) {

  $system = System::all()->pluck('idSystem')->toArray();

    return [
        'nameIndicator' => $faker->word,
        'valueIndicator' => $faker->randomNumber(),
        'idSystem' => $faker->randomElement($system)
    ];
});
