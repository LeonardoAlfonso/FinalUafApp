<?php

use Illuminate\Database\Seeder;
use App\Models\Municipality;
use App\Models\Departament;

class MunicipalitiesTableSeeder extends Seeder
{

    public function run()
    {
        $departaments = Departament::all();
        $json = File::get("database/data/departaments.json");
        $data = json_decode($json);

        foreach($departaments as $departament)
        {
            foreach($data as $key)
            {
                if($departament->idDivipola == $key->divipolaCod)
                {
                    foreach($key->municipalities as $municipality)
                    {
                        Municipality::create(array(
                            'nameMunicipality' => $municipality,
                            'idDepartament' => $departament->idDepartament,
                        ));
                    }
                }
            }
        }
    }

}
