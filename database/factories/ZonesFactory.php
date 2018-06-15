<?php

use Faker\Generator as Faker;
use App\Models\Departament;

$factory->define(App\Models\Zone::class, function (Faker $faker) {

  $departament = Departament::all()->pluck('idDepartament')->toArray();

    return [
        'nameZone' => $faker->name,
        'autor' => $faker->name,
        'miniMapPath' => $faker->word,
        'idDepartament' => $faker->randomElement($departament)
    ];
});
