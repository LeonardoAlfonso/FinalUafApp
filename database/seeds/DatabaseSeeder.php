<?php

use Illuminate\Database\Seeder;
use App\Models\System;

class DatabaseSeeder extends Seeder
{
    public function run()
    {

        $this->call([
            GlossaryTableSeeder::class,
            DepartamentsTableSeeder::class,
        ]);
        factory(App\User::class,50)->create();
        factory(App\Models\Zone::class,160)->create();
        factory(App\Models\CharacteristicZone::class,480)->create();
        factory(App\Models\Municipality::class,480)->create();
        factory(App\Models\IndicatorZone::class,480)->create();
        factory(App\Models\System::class,500)->create();
        factory(App\Models\Entry::class,1500)->create();
        factory(App\Models\CharacteristicEntry::class,1500)->create();
        factory(App\Models\Cost::class,1500)->create();
        factory(App\Models\SystemIndicator::class,1500)->create();
        factory(App\Models\UserDepartament::class,1000)->create();

    }

}
