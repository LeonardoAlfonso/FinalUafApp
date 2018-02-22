<?php

use Faker\Generator as Faker;
use App\Models\Zone;

$factory->define(App\Models\System::class, function (Faker $faker) {

  $zone = Zone::all()->pluck('idZone')->toArray();

    return [
        'nameSystem' => $faker->name,
        'autor' => $faker->name,
        'jornalValue' => $faker->randomNumber(),
        'idZone' => $faker->randomElement($zone)
    ];
});
