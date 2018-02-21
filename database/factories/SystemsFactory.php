<?php

use Faker\Generator as Faker;
use App\Models\Zone;

$factory->define(App\Models\System::class, function (Faker $faker) {

  $zone = Zone::all()->pluck('idZone')->toArray();

    return [
        'nameSystem' => $faker->name,
        'autor' => $faker->name,
        'uafMinimum' => $faker->randomNumber(),
        'uafMaximum' => $faker->randomNumber(),
        'uafIntegralMinimum' => $faker->randomNumber(),
        'uafIntegralMaximum' => $faker->randomNumber(),
        'jornalValue' => $faker->randomNumber(),
        'idZone' => $faker->randomElement($zone)
    ];
});
