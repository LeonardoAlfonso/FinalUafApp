<?php

use Faker\Generator as Faker;
use App\User;
use App\Models\Departament;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(App\Models\UserDepartament::class, function (Faker $faker) {

  $departaments = Departament::all()->pluck('idDepartament')->toArray();
  $users = User::all()->pluck('idUser')->toArray();

    return [
        'idDepartament' => $faker->randomElement($departaments),
        'idUser' => $faker->randomElement($users),
    ];
});
