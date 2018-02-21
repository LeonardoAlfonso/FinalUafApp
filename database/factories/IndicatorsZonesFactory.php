<?php

use Faker\Generator as Faker;
use App\Models\Zone;


$factory->define(App\Models\IndicatorZone::class, function (Faker $faker) {

      $zone = Zone::all()->pluck('idZone')->toArray();

        return [
            'nameIndicator' => $faker->name,
            'valueIndicator' => $faker->name,
            'idZone' => $faker->randomElement($zone),
        ];
});
