<?php

use Faker\Generator as Faker;
use App\Models\Zone;


$factory->define(App\Models\CharacteristicZone::class, function (Faker $faker) {

      $zone = Zone::all()->pluck('idZone')->toArray();

        return [
            'nameCharacteristic' => $faker->name,
            'valueCharacteristic' => $faker->name,
            'idZone' => $faker->randomElement($zone),
        ];
});
