<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {

        $this->call([
            GlossaryTableSeeder::class,
            DepartamentsTableSeeder::class,
        ]);
        factory(App\Models\Zone::class,200)->create();
        factory(App\Models\CharacteristicZone::class,600)->create();
        factory(App\Models\Municipality::class,1000)->create();
        factory(App\Models\IndicatorZone::class,600)->create();
        factory(App\Models\System::class,2000)->create();
        factory(App\Models\Entry::class,2000)->create();
        factory(App\Models\CharacteristicEntry::class,1000)->create();
        factory(App\Models\Cost::class,2000)->create();
    }
    
}
