<?php

use Faker\Generator as Faker;
use App\Models\Zone;

$factory->define(App\Models\Municipality::class, function (Faker $faker) {

    $zone = Zone::all()->pluck('idZone')->toArray();

    return [
        'name' => $faker->name,
        'idZone' => $faker->randomElement($zone)
    ];
});
