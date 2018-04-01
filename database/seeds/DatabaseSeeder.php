<?php

use Illuminate\Database\Seeder;
use App\Models\Zone;

class DatabaseSeeder extends Seeder
{
    protected $zones = "";

    public function run()
    {
        $this->zones = Zone::all();

        $this->call([
            GlossaryTableSeeder::class,
            DepartamentsTableSeeder::class,
            UafParametersTable::class,
        ]);
        factory(App\User::class,50)->create();
        // factory(App\Models\Zone::class,160)->create();
        // factory(App\Models\CharacteristicZone::class,$zone->idZone,1)->create();
        // factory(App\Models\Municipality::class,480)->create();
        // factory(App\Models\IndicatorZone::class,480)->create();
        // factory(App\Models\System::class,500)->create();
        // factory(App\Models\Entry::class,1500)->create();
        // factory(App\Models\CharacteristicEntry::class,1500)->create();
        // factory(App\Models\Cost::class,1500)->create();
        // factory(App\Models\SystemIndicator::class,1500)->create();
        factory(App\Models\UserDepartament::class,1000)->create();

    }

}
