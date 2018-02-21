<?php

use Illuminate\Database\Seeder;
use App\Models\Departament;

class DepartamentsTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('departaments')->delete();
        $json = File::get("database/data/departaments.json");
        $data = json_decode($json);

        foreach ($data as $key) {
            Departament::create(array(
                'idDivipola' => $key->divipolaCod,
                'departamentName' => $key->name,
            ));
        }
    }
}
