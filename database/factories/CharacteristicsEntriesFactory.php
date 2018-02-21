<?php

use Faker\Generator as Faker;
use App\Models\Entry;


$factory->define(App\Models\CharacteristicEntry::class, function (Faker $faker) {

      $entry = Entry::all()->pluck('idEntry')->toArray();

        return [
            'nameCharacteristic' => $faker->name,
            'valueCharacteristic' => $faker->name,
            'idEntry' => $faker->randomElement($entry),
        ];
});
